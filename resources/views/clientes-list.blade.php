@extends('layout')

@section('extra-js')
<script>
    function removeClient(id) {
        swal.fire('Aguarde...');
        swal.showLoading();

        $.ajax({
            type: "POST",
            url: `/clientes/${id}`,
            data: {
                _method: 'DELETE',
                _token: $("input[name='_token']").val()
            },
            dataType: "json",
            success: function (response) {
                swal.close();

                if (response.status == 1) {
                    swal.fire('Ok!', response.message);
                } else {
                    swal.fire('Ops!', response.message);
                }
            }
        });
    }

    function showContactsClient(IdCliente) {
        $.ajax({
            type: "GET",
            url: `/cliente/${IdCliente}/contatos`,
            dataType: "json",
            success: function (response) {
                var total = response.length;
                var tr;

                $('#modal-table tbody').empty();

                for (let i = 0; i < total; i++) {
                    tr += `<tr>
                        <td>${response[i].TipoContato}</td>
                        <td>${response[i].DescContato}</td>
                    </tr>`;    
                }

                $('#modal-table tbody:last').prepend(tr);
                
                swal.close();
                $('#modal-contacts').modal('show');

            }
        });
    }

    $(document).ready(function () {
        $('.remove-client').click(function () {
            removeClient($(this).data('id'));
        });

        $('.show-contacts').click(function(){
            swal.fire('Aguarde...');
            swal.showLoading();

            showContactsClient($(this).data('id'));
        });
    });
</script>
@stop

@section('content')
@csrf
<div class="row">
    <div class="col-sm-8">
        <h2>Lista de clientes</h2>
        <p>#/ lista</p>
    </div>
    <div class="col-sm-4">
        <a href="{{ route('clientes.create') }}" class="btn btn-success float-right"><i class="fa fa-file-text-o"></i> Registrar cliente</a>
    </div>
    <div class="col-sm-12">
        <table class="table">
            <thead>
                <tr>
                    <th>ID Cliente</th>
                    <th>Razão Social</th>
                    <th>Data de Cadastro</th>
                    <th width="5%">#</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($Clientes as $Cliente)
                    <tr>
                        <td>{{ $Cliente->IdCliente }}</td>
                        <td>{{ $Cliente->RazaoSocial }}</td>
                        <td>{{ Carbon\Carbon::parse($Cliente->DataCadastro)->format('d/m/Y') }}</td>
                        <td>
                            <div class="dropdown dropleft">
                                <button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown"></button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{ route('clientes.edit', [$Cliente->IdCliente]) }}">Editar</a>
                                    <a class="dropdown-item show-contacts" data-id="{{ $Cliente->IdCliente }}" href="javascript:void(0);">Contatos</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item remove-client" data-id="{{ $Cliente->IdCliente }}" href="javascript:void(0);">Delete</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">Nenhum registro de cliente foi encontrado.</td>    
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="modal-contacts">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Contatos do cliente</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            
            <!-- Modal body -->
            <div class="modal-body">
                <table id="modal-table" class="table">
                    <thead>
                        <th>Tipo</th>
                        <th>Contato</th>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
            
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>
@stop