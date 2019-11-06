<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContatoCliente;

class ContatoClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($IdCliente)
    {
        $Contatos = ContatoCliente::where([
                ['IdCliente', $IdCliente],
                ['BolAtivo', true]
            ])->get();

        return response()->json($Contatos);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($IdCliente, $id)
    {
        try {
            $Contato = ContatoCliente::where([
                    ['IdContato', $id],
                    ['IdCliente', $IdCliente]
                ])
                ->update(['BolAtivo' => false]);

            if ($Contato) {
                return response()->json([
                    'status' => 1,
                    'message' => 'Contato removido com sucesso',
                    'error' => ''
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => 0,
                'message' => 'Não foi possível remover o contato do cliente',
                'error' => $e->getMessage()
            ]);
        }
    }
}
