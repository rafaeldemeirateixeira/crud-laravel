@section('extra-js')
<script>
    function deleteContato(IdContato, IdCliente, _this) {
        swal.fire('Aguarde...');
        swal.showLoading();

        $.ajax({
            type: "POST",
            url: `/cliente/${IdCliente}/contatos/${IdContato}`,
            data: {
                _method: 'DELETE',
                _token: $("input[name='_token']").val()
            },
            dataType: "json",
            success: function (response) {
                swal.close();
                if (response.status == 1) {
                    swal.fire('Ok!', response.message);
                    $(_this).parents('tr').remove();
                } else {
                    swal.fire('Ops!', response.message);
                }
            }
        });
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
                    <button type="button" class="btn btn-danger float-right" onclick="deleteContato(0, 0, this)">
                        <i class="fa fa-trash"></i>
                    </button>
                </td>
            </tr>`;

            $('#table-contact tbody:last').prepend(tr);
        });
    });
</script>
@stop

@csrf
@method('PATCH')
<div class="row">
    <div class="col-sm-12">
        <div class="form-group">
            <label for="RazaoSocial">Razão Social:</label>
            <input type="RazaoSocial" class="form-control" 
                id="RazaoSocial" name="RazaoSocial" 
                value="{{ old('RazaoSocial') === null ? $Cliente->RazaoSocial : old('RazaoSocial') }}" placeholder="Razão Social">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <a id="add-contact" href="javascript:void(0);" class="btn btn-default">+ Adicionar contato</a>
    </div>
    <div class="col-sm-12">
        <table id="table-contact" class="table">
            <tbody>
                @foreach($ContatoCliente as $key => $Contato)
                    <tr>
                        <td>
                            <input type="text" class="form-control" 
                                name="TipoContato[]" value="{{ $Contato->TipoContato }}"
                                placeholder="Tipo de contato. [Telefone, Celular, Email, etc...]">
                        </td>
                        <td>
                            <input type="text" class="form-control" 
                                name="DescContato[]" value="{{ $Contato->DescContato }}"
                                placeholder="Contato">
                        </td>
                        <td width="5%">
                            <button type="button" class="btn btn-danger float-right" onclick="deleteContato({{ $Contato->IdContato }}, {{ $Contato->IdCliente }}, this)">
                                <i class="fa fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <a href="{{ route('clientes.index') }}" class="btn btn-warning"><i class="fa fa-chevron-left"></i> Voltar</a>
        <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i> Alterar</button>
    </div>
</div>