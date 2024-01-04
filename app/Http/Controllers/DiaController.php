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
        $data_inicial = date('Y-m-d', strtotime($request->data_inicial));
        $data_final = date('Y-m-d', strtotime($request->data_final));

        $parametros = Parametro::all()->where('usuario_id', Auth::user()->id);

        $remedios = Remedio::all()->where('usuario_id', Auth::user()->id);

        /*$usuario_parametros = DB::table('usuario_parametros')
            ->where('usuario_id', Auth::user()->id)
            ->where('dia', '<=', $data_final)
            ->where('dia', '>=', $data_inicial)
            ->get();

        $usuario_emocoes = DB::table('usuario_emocaos')
            ->where('usuario_id', Auth::user()->id)
            ->where('dia', '<=', $data_final)
            ->where('dia', '>=', $data_inicial)
            ->get();

        foreach ($usuario_emocoes as $us_emo) {
            $emocoes_map[$us_emo->emocao_id] = [0]; //cria um mapa de arrays, a chave corresponde ao id da emocao
        }

        foreach ($usuario_emocoes as $us_emo) {
            $emocao = $emocoes_map[$us_emo->emocao_id]; //pega o array pelo id da emocao
            $emocao[0]++; //incrementa em 1 o index do array q vai ser usado para ver quantos dias esse emocao foi selecionada
            array_push($emocao, $us_emo->dia); //adiciona no array os dias que essa emoção foi marcada
            $emocoes_map[$us_emo->emocao_id] = $emocao; //insere o array, agora com os valores, de volta no map de acordo com id do remedio
        }*/

        $lava = new Lavacharts(); // See note below for Laravel

        $usuario_remedios = DB::table('usuario_remedios')
            ->where('usuario_id', Auth::user()->id)
            ->where('dia', '<=', $data_final)
            ->where('dia', '>=', $data_inicial)
            ->get();

        $remedio_ids = $usuario_remedios
            ->pluck('remedio_id')
            ->unique()
            ->toArray();

        $remedios = DB::table('remedios')
            ->whereIn('id', $remedio_ids)
            ->get()
            ->keyBy('id');

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

        $graphs_name = [];

        foreach ($remedios_map as $remedio_array) {
            $data = Lava::DataTable();
            $data->addStringColumn('Remédios')->addNumberColumn('Tomou');

            $data->addRows([['Tomou', $remedio_array[1]], ['Não tomou', $remedio_array[0]]]);

            if (!in_array($remedio_array[3], $graphs_name)) {
                $lava->PieChart($remedio_array[3], $data, [
                    'title' => $remedio_array[3],
                    'pieSliceText' => 'value',
                ]);

                array_push($graphs_name, $remedio_array[3]);
            }
        }

        return view('relatorio', ['lava' => $lava, 'nome_graficos' => $graphs_name, 'parametros' => $parametros, 'remedios' => $remedios]);
    }
}
