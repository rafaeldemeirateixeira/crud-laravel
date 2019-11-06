@section('extra-js')
<script>
    function deleteContato(_this) {
        $(_this).parents('tr').remove();
    }

    $(document).ready(function () {
        $('#add-contact').click(function(){
            var tr = `<tr>
                <td>
                    <input type="text" class="form-control" name="TipoContato[]" placeholder="Tipo de contato. [Telefone, Celular, Email, etc...]">
                </td>
                <td>
                    <input type="text" class="form-control" name="DescContato[]" placeholder="Contato">
                </td>
                <td width="5%">
                    <button type="button" class="btn btn-danger float-right" onclick="deleteContato(this)">
                        <i class="fa fa-trash"></i>
                    </button>
                </td>
            </tr>`;

            $('#table-contact tbody:last').append(tr);
        });
    });
</script>
@stop

@csrf
<div class="row">
    <div class="col-sm-12">
        <div class="form-group">
            <label for="RazaoSocial">Razão Social:</label>
            <input type="text" class="form-control" 
                id="RazaoSocial" name="RazaoSocial" 
                value="{{ old('RazaoSocial') }}" placeholder="Razão Social">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <a id="add-contact" href="javascript:void(0);" class="btn btn-default">+ Adicionar novo contato</a>
    </div>
    <div class="col-sm-12">
        <table id="table-contact" class="table">
            <tbody>
                @if (old('TipoContato'))
                    @foreach(old('TipoContato') as $key => $tipo)
                        <tr>
                            <td>
                                <input type="text" class="form-control" 
                                    name="TipoContato[]" value="{{ old('TipoContato')[$key] }}"
                                    placeholder="Tipo de contato. [Telefone, Celular, Email, etc...]">
                            </td>
                            <td>
                                <input type="text" class="form-control" 
                                    name="DescContato[]" value="{{ old('DescContato')[$key] }}"
                                    placeholder="Contato">
                            </td>
                            <td width="5%">
                                <button type="button" class="btn btn-danger float-right" onclick="deleteContato(this)">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <a href="{{ route('clientes.index') }}" class="btn btn-warning"><i class="fa fa-chevron-left"></i> Voltar</a>
        <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i> Registrar</button>
    </div>
</div>