@extends('layout')

@section('content')
<h2>{{ $title }}</h2>
<form action="{{ $method }}" method="POST">
    @include($template)
</form>
@stop