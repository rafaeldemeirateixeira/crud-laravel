@extends('layout')

@section('content')
<h2>Registro de clientes</h2>
<form action="" method="POST">
    @include('clientes-form-create')
</form>
@stop