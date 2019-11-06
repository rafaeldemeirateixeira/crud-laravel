<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $primaryKey = 'IdCliente';
    
    protected $table = 'Clientes';

    protected $fillable = ['BolAtivo'];

    /**
     * Relacionamento dos contatos do cliente
     */
    public function contatos()
    {   
        return $this->belongsTo('App\Models\ContatoCliente', 'IdCliente', 'IdCliente');
    }
}
