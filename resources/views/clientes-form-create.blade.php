@section('extra-js')
<script>
    function deleteContato(_this) {
        console.log('Remove');
        $(_this).parents('tr').remove();
    }

    $(document).ready(function () {
        $('#add-contact').click(function(){
            var tr = `<tr>
                <td>
                    <input type="text" class="form-control" placeholder="Tipo de contato. [Telefone, Celular, Email, etc...]">
                </td>
                <td>
                    <input type="text" class="form-control" placeholder="Contato">
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

<div class="row">
    <div class="col-sm-12">
        <div class="form-group">
            <label for="email">Razão Social:</label>
            <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <a id="add-contact" href="javascript:void(0);" class="btn btn-default">+ Adicionar novo contato</a>
    </div>
    <div class="col-sm-12">
        <table id="table-contact" class="table">
            <tbody></tbody>
        </table>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <a href="#" class="btn btn-warning"><i class="fa fa-chevron-left"></i> Voltar</a>
        <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i> Registrar</button>
    </div>
</div>