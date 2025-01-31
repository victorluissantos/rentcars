<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\Locadora;

class LocadoraController extends Controller
{

    // Método de pesquisa para buscar veículos de locadoras ativas
    public function pesquisa()
    {
        // Buscar locadoras que tenham uma URL de API cadastrada
        $locadoras = Locadora::whereNotNull('url_api')->get();

        $veiculosDisponiveis = [];

        foreach ($locadoras as $locadora) {
            try {
                // Fazer a requisição à API da locadora
                $response = Http::get($locadora->url_api);

                if ($response->successful()) {
                    $veiculos = $response->json();

                    // Adicionar informações da locadora nos veículos
                    foreach ($veiculos as &$veiculo) {
                        $veiculo['locadora'] = [
                            'id' => $locadora->id,
                            'nome' => $locadora->nome,
                        ];
                    }

                    $veiculosDisponiveis = array_merge($veiculosDisponiveis, $veiculos);
                }
            } catch (\Exception $e) {
                // Logar a exceção com todos os detalhes
                Log::error('Erro ao acessar a API da locadora', [
                    'locadora_id' => $locadora->id,
                    'url_api' => $locadora->url_api,
                    'mensagem' => $e->getMessage(),
                    'codigo' => $e->getCode(),
                    'pista' => $e->getTraceAsString(), // Exibe a pilha de rastreamento
                ]);
                
                // Retornar um erro com a mensagem de exceção
                return response()->json([
                    'erro' => 'Houve um erro ao buscar os veículos',
                    'detalhes' => $e->getMessage(),
                ], 500);
            }
        }

        return response()->json(['veiculos' => $veiculosDisponiveis]);
    }

    public function index()
    {
        return response()->json(Locadora::all());
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string',
            'cnpj' => 'required|string|unique:locadoras',
            'url_api' => 'required|url',
        ]);

        // Cria a locadora no banco de dados
        $locadora = Locadora::create($request->all());

        // Chama a API externa da locadora para obter a lista de veículos
        $response = Http::get($locadora->url_api);

        if ($response->successful()) {
            // A API retornou com sucesso
            $veiculos = $response->json(); // Retorna a lista de veículos

            // Combina os dados da locadora com os veículos e retorna no formato desejado
            $result = [
                'locadora' => $locadora,
                'veiculos' => $veiculos
            ];

            return response()->json($result, 201);
        } else {
            // Caso a API não tenha retornado corretamente
            return response()->json(['error' => 'Falha ao consultar a API da locadora'], 500);
        }
    }

    public function show($id)
    {
        $locadora = Locadora::find($id);

        if (!$locadora) {
            return response()->json(['message' => 'Locadora não encontrada'], 404);
        }

        return response()->json($locadora);
    }

    public function update(Request $request, $id)
    {
        $locadora = Locadora::find($id);

        if (!$locadora) {
            return response()->json(['message' => 'Locadora não encontrada'], 404);
        }

        $locadora->update($request->all());

        return response()->json($locadora);
    }

    public function destroy($id)
    {
        $locadora = Locadora::find($id);

        if (!$locadora) {
            return response()->json(['message' => 'Locadora não encontrada'], 404);
        }

        $locadora->delete();

        return response()->json(['message' => 'Locadora excluída com sucesso']);
    }
}
