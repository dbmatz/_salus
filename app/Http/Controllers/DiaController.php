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
                    ->withErrors('usuario_parametro naõ salvo');
            }
        }

        if (!empty($request->status)) {
            $resposta = (new UsuarioRemedioController())->store($request);
            if ($resposta == 1) {
                return redirect()
                    ->route('index')
                    ->withErrors('usuario_remedio naõ salvo');
            }
        }

        $resposta = (new UsuarioEmocaoController())->store($request);
        if ($resposta == 1) {
            return redirect()
                ->route('index')
                ->withErrors('usuario_emocao naõ salvo');
        }

        return redirect()
            ->route('index')
            ->with('status', 'dia salvo');
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
            $resposta = (new UsuarioEmocaoController())->store($request); //funcionando
            if ($resposta == 1) {
                return redirect()
                    ->route('index')
                    ->withErrors('usuario_emocao naõ salvo');
            }
        }

        if (!empty($request->status)) {
            $resposta = (new UsuarioRemedioController())->store($request); //funcionando
            if ($resposta == 1) {
                return redirect()
                    ->route('index')
                    ->withErrors('usuario_remedio naõ salvo');
            }
        }

        if (!empty($request->avaliacao)) {
            $resposta = (new UsuarioParametoController())->store($request); //funcionando
            if ($resposta == 1) {
                return redirect()
                    ->route('index')
                    ->withErrors('usuario_parametro naõ salvo');
            }
        }

        return redirect()
            ->route('index')
            ->with('status', 'dia alterado');
    }

    public function relatorio(Request $request)
    {
        //dd($request);
        /*$data_inicial = date('Y-m-d', strtotime($request->data_inicial));
        $data_final = date('Y-m-d', strtotime($request->data_final));

        $usuario_remedios = DB::table('usuario_remedios')
            ->where('usuario_id', Auth::user()->id)
            ->where('dia', '<=', $data_final)
            ->where('dia', '>=', $data_inicial)
            ->get();

        $usuario_parametros = DB::table('usuario_parametros')
            ->where('usuario_id', Auth::user()->id)
            ->where('dia', '<=', $data_final)
            ->where('dia', '>=', $data_inicial)
            ->get();

        $usuario_emocoes = DB::table('usuario_emocaos')
            ->where('usuario_id', Auth::user()->id)
            ->where('dia', '<=', $data_final)
            ->where('dia', '>=', $data_inicial)
            ->get();

        foreach ($usuario_remedios as $us_rem) {
            $remedios_map[$us_rem->remedio_id] = [0, 0, 0]; //cria um mapa de arrays, a chave corresponde ao id do remédio
        }

        foreach ($usuario_remedios as $us_rem) {
            $remedio = $remedios_map[$us_rem->remedio_id]; //pega o array pelo id do remedio
            $remedio[2]++; //incrementa em 1 o index do array q vai ser usado para ver quantos dias esse remédio foi tomado
            if ($us_rem->status == 1) {
                $remedio[1]++; //se tiver tomado (verdadeiro) incrementa o array no index de valor 1
            } else {
                $remedio[0]++; //se não tiver tomado (falso) incrementa o array no index de valor 0
            }
            $remedios_map[$us_rem->remedio_id] = $remedio; //insere o array, agora com os valores, de volta no map de acordo com id do remedio
        }

        foreach ($usuario_emocoes as $us_emo) {
            $emocoes_map[$us_emo->emocao_id] = [0]; //cria um mapa de arrays, a chave corresponde ao id da emocao
        }

        foreach ($usuario_emocoes as $us_emo) {
            $emocao = $emocoes_map[$us_emo->emocao_id]; //pega o array pelo id da emocao
            $emocao[0]++; //incrementa em 1 o index do array q vai ser usado para ver quantos dias esse emocao foi selecionada
            array_push($emocao, $us_emo->dia); //adiciona no array os dias que essa emoção foi marcada
            $emocoes_map[$us_emo->emocao_id] = $emocao; //insere o array, agora com os valores, de volta no map de acordo com id do remedio
        }*/
        $lava = new Lavacharts();

        // Criação do objeto DataTable
        $data = $lava->DataTable();

        $data
            ->addDateColumn('Day of Month')
            ->addNumberColumn('Projected')
            ->addNumberColumn('Official');

        // Dados aleatórios para exemplo
        for ($a = 1; $a < 30; $a++) {
            $rowData = ["2017-4-$a", rand(800, 1000), rand(800, 1000)];
            $data->addRow($rowData);
        }

        // Criação do gráfico de linhas
        $lava->LineChart('Stocks', $data, [
            'title' => 'Stock Market Trends',
            'animation' => [
                'startup' => true,
                'easing' => 'inAndOut',
            ],
            'colors' => ['blue', '#F4C1D8'],
        ]);
        $parametros = Parametro::all()->where('usuario_id', Auth::user()->id);

    $remedios = Remedio::all()->where('usuario_id', Auth::user()->id);

        // Não é necessário chamar LineChart novamente

        // Passa a instância principal do Lavacharts para a view
        return view('relatorio', ['lava' => $lava, 'parametros' => $parametros, 'remedios' => $remedios]);
    }
}
