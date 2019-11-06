@if ($errors->any())
<div class="alert alert-danger">
    @foreach ($errors->all() as $error)
        <div>{{ $error }}</div>
    @endforeach
</div>

@elseif (!empty($messages))
<div class="alert alert-warning">
    @foreach ($messages as $message)
        <div>{{ $message }}</div>
    @endforeach
</div>

@elseif (Session::has('success'))
<div class="alert alert-success" role="alert">
    {!! Session::get('success') !!}
</div>

@elseif (Session::has('info'))
<div class="alert alert-info">
    {!! Session::get('info') !!}
</div>

@elseif (Session::has('error'))
<div class="alert alert-danger">
    {!! Session::get('error') !!}
</div>
@endif