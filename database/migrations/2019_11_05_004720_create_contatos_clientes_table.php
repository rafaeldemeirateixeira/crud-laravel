<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContatosClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ContatosClientes', function (Blueprint $table) {
            $table->increments('IdContato');
            $table->integer('IdCliente')->unsigned();
            $table->foreign('IdCliente')->references('IdCliente')->on('Clientes');
            $table->string('TipoContato');
            $table->string('DescContato');
            $table->integer('BolAtivo')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ContatosClientes');
    }
}
