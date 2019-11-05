@extends('layout')

@section('extra-js')
<script>
    $(document).ready(function () {

    });
</script>
@stop

@section('content')
<div class="row">
    <div class="col-sm-8">
        <h2>Lista de clientes</h2>
        <p>#/ lista</p>
    </div>
    <div class="col-sm-4">
        <button class="btn btn-success float-right"><i class="fa fa-file-text-o"></i> Registrar cliente</button>
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
                <tr>
                    <td>1</td>
                    <td>Doe</td>
                    <td>05/11/2019</td>
                    <td>
                        <div class="dropdown">
                            <button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown"></button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="#">Editar</a>
                                <a class="dropdown-item" href="#">Contatos</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Delete</a>
                            </div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@stop