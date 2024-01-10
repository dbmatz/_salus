<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Parametro;
use App\Models\Emocao;
use App\Models\Remedio;
use App\Models\UsuarioParametro;
use App\Models\UsuarioEmocao;
use App\Models\UsuarioRemedio;
use Illuminate\Support\Facades\DB;
use Khill\Lavacharts\Laravel\LavachartsFacade as Lava;
use Khill\Lavacharts\Lavacharts;
use Khill\Lavacharts\DataTables\Formats\DateFormat;
use Carbon\Carbon;
use Auth;
use Exception;
use Error;

class DiaController extends Controller
{
    public function create(Request $request)
    {
        if (empty($request->dia)) {
            $dia = date('Y-m-d');
        } else {
            $dia = $request->dia;
        }

        $usuario_emocao = UsuarioEmocao::where('dia', $dia)
            ->where('usuario_id', Auth::user()->id)
            ->first();

        if (!empty($usuario_emocao)) {
            return redirect()->route('dia-edit', ['id' => $usuario_emocao->id]);
        }

        $emocoes = Emocao::all();

        $parametros = Parametro::all()->where('usuario_id', Auth::user()->id);

        $remedios = Remedio::all()->where('usuario_id', Auth::user()->id);

        return view('create-dia', [
            'emocoes' => $emocoes,
            'parametros' => $parametros,
            'remedios' => $remedios,
            'dia' => $dia,
        ]);
    }

    public function store(Request $request)
    {
        if (!empty($request->avaliacao)) {
            $resposta = (new UsuarioParametoController())->store($request);
            if ($resposta == 1) {
                return redirect()
                    ->route('index')
                    ->withErrors('Não foi possível salvar o registro. Tente novamente mais tarde!');
            }
        }

        if (!empty($request->status)) {
            $resposta = (new UsuarioRemedioController())->store($request);
            if ($resposta == 1) {
                return redirect()
                    ->route('index')
                    ->withErrors('Não foi possível salvar o registro. Tente novamente mais tarde!');
            }
        }

        $resposta = (new UsuarioEmocaoController())->store($request);
        if ($resposta == 1) {
            return redirect()
                ->route('index')
                ->withErrors('Não foi possível salvar o registro. Tente novamente mais tarde!');
        }

        return redirect()
            ->route('index')
            ->with('status', 'Registro salvo!');
    }

    public function edit($id)
    {
        $usuario_emocao = UsuarioEmocao::where('id', $id)->first();
        $dia = $usuario_emocao->dia;
        $emocoes = Emocao::all();

        $usuario_parametro = UsuarioParametro::all()
            ->where('dia', $dia)
            ->where('usuario_id', Auth::user()->id);
        $parametros = Parametro::all()->where('usuario_id', Auth::user()->id);

        $usuario_remedio = UsuarioRemedio::all()
            ->where('dia', $dia)
            ->where('usuario_id', Auth::user()->id);
        $remedios = Remedio::all()->where('usuario_id', Auth::user()->id);

        return view('edit-dia', [
            'emocoes' => $emocoes,
            'parametros' => $parametros,
            'remedios' => $remedios,
            'usuario_emocao' => $usuario_emocao,
            'usuario_parametros' => $usuario_parametro,
            'usuario_remedios' => $usuario_remedio,
            'dia' => $dia,
        ]);
    }

    public function update(Request $request)
    {
        if (!empty($request->emocao_id)) {
            $resposta = (new UsuarioEmocaoController())->store($request); 
            if ($resposta == 1) {
                return redirect()
                    ->route('index')
                    ->withErrors('Não foi possível alterar o registro. Tente novamente mais tarde!');
            }
        }

        if (!empty($request->status)) {
            $resposta = (new UsuarioRemedioController())->store($request); 
            if ($resposta == 1) {
                return redirect()
                    ->route('index')
                    ->withErrors('Não foi possível salvar o registro. Tente novamente mais tarde!');
            }
        }

        if (!empty($request->avaliacao)) {
            $resposta = (new UsuarioParametoController())->store($request); 
            if ($resposta == 1) {
                return redirect()
                    ->route('index')
                    ->withErrors('Não foi possível salvar o registro. Tente novamente mais tarde!');
            }
        }

        return redirect()
            ->route('index')
            ->with('status', 'Dia alterado!');
    }

    public function relatorio(Request $request)
    {
        //dd($request);
        $data_inicial = date('Y-m-d', strtotime($request->data_inicial));
        $data_final = date('Y-m-d', strtotime($request->data_final));

        $relatorio['lava'] = $lava = new Lavacharts();

        $parametros = DB::table('parametros')
            ->where('usuario_id', Auth::user()->id)
            ->orderBy('id', 'asc')
            ->get();
        $remedios = Remedio::all()->where('usuario_id', Auth::user()->id);

        $relatorio = (new DiaController())->graficoPizza($relatorio, $data_inicial, $data_final, $remedios);
        $relatorio = (new DiaController())->graficoDias($data_inicial, $data_final, $relatorio);
        $relatorio = (new DiaController())->graficoParametro($relatorio, $data_final, $data_inicial, $parametros);

        return view('relatorio', [
            'data_inicial' => $data_inicial,
            'data_final' => $data_final,
            'lava' => $relatorio['lava'],
            'graficos_pizza' => $relatorio['graficos_pizza'],
            'parametros' => $parametros,
            'remedios' => $remedios,
            'emocoes_map' => $relatorio['emocoes_map'],
            'graficos_parametro' => $relatorio['graficos_parametro'],
        ]);
    }

    public function graficoParametro($relatorio, $data_final, $data_inicial, $parametros)
    {
        $usuario_parametros = DB::table('usuario_parametros')
            ->where('usuario_id', Auth::user()->id)
            ->where('dia', '<=', $data_final)
            ->where('dia', '>=', $data_inicial)
            ->orderBy('dia')
            ->get();

        foreach ($parametros as $parametro) {
            $parametros_map[$parametro->id] = [];
        }

        foreach ($usuario_parametros as $us_par) {
            $array = $parametros_map[$us_par->parametro_id];
            $parametro = $parametros->firstWhere('id', $us_par->parametro_id);
            array_push($array, $parametro->nome);
            array_push($array, $us_par->dia);
            array_push($array, $us_par->avaliacao);
            $parametros_map[$us_par->parametro_id] = $array;
        }

        $graficos_parametro = [];

        foreach ($parametros_map as $parametro) {
            $data_parametro = $relatorio['lava']->DataTable();
            $parametro_objeto = $parametros->firstWhere('nome', $parametro[0]);
            $data_parametro->addDateColumn('Data')->addNumberColumn($parametro_objeto->nome);

            for ($i = 0; $i < count($parametro); $i = $i + 3) {
                $data_parametro->addRow([Carbon::createFromFormat('Y-m-d', $parametro[$i + 1]), $parametro[$i + 2]]);
            }

            if (!in_array($parametro[0], $graficos_parametro)) {
                $relatorio['lava']->LineChart($parametro_objeto->nome, $data_parametro, [
                    'title' => $parametro_objeto->nome,
                ]);

                array_push($graficos_parametro, $parametro_objeto->nome);
            }
        }

        $relatorio['graficos_parametro'] = $graficos_parametro;
        return $relatorio;
    }

    public function graficoDias($data_inicial, $data_final, $relatorio)
    {
        $usuario_emocoes = DB::table('usuario_emocaos')
            ->where('usuario_id', Auth::user()->id)
            ->where('dia', '<=', $data_final)
            ->where('dia', '>=', $data_inicial)
            ->get();

        $emocoes = Emocao::all();
        $emocoes_map = [];

        $sales = $relatorio['lava']->DataTable();
        $sales->addDateColumn('Date')->addNumberColumn('Orders');

        foreach ($usuario_emocoes as $us_emo) {
            $emocao = $emocoes->firstWhere('id', $us_emo->emocao_id);

            $emocoes_map[$emocao->id] = $emocoes_map[$emocao->id] ?? [
                'id' => $emocao->id,
                'nome' => $emocao->nome,
                'image' => $emocao->imagem,
                'qtd' => 1,
            ];

            $emocoes_map[$emocao->id]['qtd']++;
            $sales->addRow([$us_emo->dia, 1]);
        }

        $relatorio['emocoes_map'] = $emocoes_map;

        $relatorio['lava']->CalendarChart('Dias preenchidos', $sales, [
            'title' => 'Dias preenchidos',
            'unusedMonthOutlineColor' => [
                'stroke' => '#ECECEC',
                'strokeOpacity' => 0.75,
                'strokeWidth' => 1,
            ],
            'dayOfWeekLabel' => [
                'color' => '#4f5b0d',
                'fontSize' => 16,
                'italic' => true,
            ],
            'noDataPattern' => [
                'color' => '#DDD',
            ],
            'colorAxis' => [
                'colors' => ['#5DC460', 'black'],
            ],
        ]);

        return $relatorio;
    }

    public function graficoPizza($relatorio, $data_inicial, $data_final, $remedios)
    {
        $usuario_remedios = DB::table('usuario_remedios')
            ->where('usuario_id', Auth::user()->id)
            ->where('dia', '<=', $data_final)
            ->where('dia', '>=', $data_inicial)
            ->get();

        $remedios_map = [];

        foreach ($usuario_remedios as $us_rem) {
            $remedio = $remedios_map[$us_rem->remedio_id] ?? [0, 0, 0, null];

            $remedio[2]++;
            $remedio[1] += $us_rem->status == 1;
            $remedio[0] += $us_rem->status == 0;
            $objeto_remedio = $remedios->firstWhere('id', $us_rem->remedio_id);
            $remedio[3] = $objeto_remedio->nome;

            $remedios_map[$us_rem->remedio_id] = $remedio;
        }

        $graficos_pizza = [];

        foreach ($remedios_map as $remedio_array) {
            $data = $relatorio['lava']->DataTable();
            $data->addStringColumn('Remédios')->addNumberColumn('Tomou');

            $data->addRows([['Tomou', $remedio_array[1]], ['Não tomou', $remedio_array[0]]]);

            if (!in_array($remedio_array[3], $graficos_pizza)) {
                $relatorio['lava']->PieChart($remedio_array[3], $data, [
                    'title' => $remedio_array[3],
                    'pieSliceText' => 'value',
                ]);

                array_push($graficos_pizza, $remedio_array[3]);
            }
        }
        $relatorio['graficos_pizza'] = $graficos_pizza;

        return $relatorio;
    }
}
