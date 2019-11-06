<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContatoCliente extends Model
{
    protected $primaryKey = 'IdContato';

    protected $table = 'ContatosClientes';

    protected $fillable = ['BolAtivo'];
}
