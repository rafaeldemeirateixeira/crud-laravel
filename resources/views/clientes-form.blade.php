@extends('layout')

@section('extra-js')
<script>
    $(document).ready(function () {

    });
</script>
@stop

@section('content')
<h2>Registro de clientes</h2>
<form action="" method="POST">
    @include('clientes-form-create')
</form>
@stop