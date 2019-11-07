<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\ContatoCliente;
use Illuminate\Support\Facades\DB;

class ClientesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Clientes = Cliente::where('BolAtivo', true)->get();

        return view('clientes-list', compact('Clientes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('clientes-form', [
            'title' => 'Registrar cliente',
            'method' => route('clientes.store'),
            'template' => 'clientes-form-create'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'RazaoSocial' => ['required', 'string']
        ]);
        
        DB::beginTransaction();

        try {
            $Cliente = new Cliente();
            $Cliente->RazaoSocial = $request->input('RazaoSocial');
            $Cliente->DataCadastro = now();
            $Cliente->save();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('clientes.create')
                ->withErrors('Não foi possível registrar o cliente ' . $e->getMessage())
                ->withInput();
        }

        try {
            if (isset($request->TipoContato) && isset($request->DescContato)) {
                foreach ($request->TipoContato as $key => $TipoContato) {
                    $ContatoCliente = new ContatoCliente();
                    $ContatoCliente->IdCliente = $Cliente->IdCliente;
                    $ContatoCliente->TipoContato = $TipoContato;
                    $ContatoCliente->DescContato = $request->input('DescContato')[$key];
                    $ContatoCliente->save();
                }
            }
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('clientes.create')
                ->withErrors('Não foi possível registrar o contato do cliente ' . $e->getMessage())
                ->withInput();
        }

        DB::commit();

        return redirect()->route('clientes.index')
            ->with(['success' => 'Cliente registrado com sucesso']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $Cliente = Cliente::where([
                ['IdCliente', $id],
                ['BolAtivo', true]
            ])
            ->first();

        if (is_null($Cliente)) {
            return redirect()->route('clientes.index')
                ->withErrors('O cliente informado não foi encontrado ou foi desativado');
        }

        $ContatoCliente = $Cliente->contatos()
            ->where('BolAtivo', true)
            ->get();

        return view('clientes-form', [
            'title' => 'Alterar cliente #' . $id,
            'method' => route('clientes.update', [$id]),
            'template' => 'clientes-form-edit',
            'Cliente' => $Cliente,
            'ContatoCliente' => $ContatoCliente
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'RazaoSocial' => ['required', 'string']
        ]);

        DB::beginTransaction();

        try {
            $Cliente = Cliente::find($id);
            $Cliente->RazaoSocial = $request->input('RazaoSocial');
            $Cliente->save();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('clientes.edit', [$id])
                ->withErrors('Não foi possível alterar os dados do cliente ' . $e->getMessage())
                ->withInput();
        }

        try {
            if (isset($request->TipoContato) && isset($request->DescContato)) {

                ContatoCliente::where('IdCliente', $id)->update(['BolAtivo' => false]);

                foreach ($request->TipoContato as $key => $TipoContato) {
                    $ContatoCliente = new ContatoCliente();
                    $ContatoCliente->IdCliente = $Cliente->IdCliente;
                    $ContatoCliente->TipoContato = $TipoContato;
                    $ContatoCliente->DescContato = $request->input('DescContato')[$key];
                    $ContatoCliente->save();
                }
            }
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('clientes.edit', [$id])
                ->withErrors('Não foi possível alterar os dados de contato do cliente ' . $e->getMessage())
                ->withInput();
        }

        DB::commit();

        return redirect()->route('clientes.index')
            ->with(['success' => 'Cliente alterado com sucesso']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Cliente = Cliente::find($id)
            ->where([
                ['IdCliente', $id],
                ['BolAtivo', true]
            ])->first();

        if ($Cliente == null) {
            return response()->json([
                'status' => 0,
                'message' => 'O cliente informado não foi encontrado ou já foi removido.',
                'error' => ''
            ]);
        }

        DB::beginTransaction();

        try {
            $Cliente->contatos()
                ->where([
                    ['BolAtivo', true]
                ])
                ->update([
                    'BolAtivo' => false
                ]);
            
            $Cliente->update(['BolAtivo' => false ]);
            
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'status' => 0,
                'message' => 'Não foi possível remover o cliente selecionado',
                'error' => $e->getMessage()
            ]);
        }

        DB::commit();

        return response()->json([
            'status' => 1,
            'message' => 'Cliente removido com sucesso',
            'error' => ''
        ]);
    }
}
