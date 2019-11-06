<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('clientes.index');
});

Route::resource('clientes', 'Admin\ClientesController')->except([
    'show'
]);
Route::resource('cliente/{IdCliente}/contatos', 'Admin\ContatoClienteController')->only([
    'index', 'destroy'
]);