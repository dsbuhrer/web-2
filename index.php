<?php

require_once "./bootstrap.php";

use App\ClassLoader;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\LancamentoController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PagamentoController;
use App\Http\Middlewares\Auth;
use Pecee\SimpleRouter\SimpleRouter as Router;

error_reporting(E_ERROR | E_PARSE);

Router::setCustomClassLoader(new ClassLoader());

Router::redirect('/', 'login');
Router::get('/login', [LoginController::class, 'loginPagina'])->name('login');
Router::post('/login', [LoginController::class, 'login']);
Router::get('/logout', [LoginController::class, 'logout']);

Router::group(['middleware' => Auth::class], function () {

    Router::get('/inicio', [IndexController::class, 'indexPagina']);

    Router::get('/categorias', [CategoriaController::class, 'listPagina']);
    Router::get('/categorias/criar', [CategoriaController::class, 'createPagina']);
    Router::get('/categorias/editar/{id}', [CategoriaController::class, 'updatePagina']);
    Router::get('/categorias/excluir/{id}', [CategoriaController::class, 'deletePagina']);
    Router::post('/categorias/criar', [CategoriaController::class, 'create']);
    Router::post('/categorias/editar/{id}', [CategoriaController::class, 'update']);
    Router::post('/categorias/excluir/{id}', [CategoriaController::class, 'delete']);
    
    Router::get('/pagamentos', [PagamentoController::class, 'listPagina']);
    Router::get('/pagamentos/criar', [PagamentoController::class, 'createPagina']);
    Router::get('/pagamentos/editar/{id}', [PagamentoController::class, 'updatePagina']);
    Router::get('/pagamentos/excluir/{id}', [PagamentoController::class, 'deletePagina']);
    Router::post('/pagamentos/criar', [PagamentoController::class, 'create']);
    Router::post('/pagamentos/editar/{id}', [PagamentoController::class, 'update']);
    Router::post('/pagamentos/excluir/{id}', [PagamentoController::class, 'delete']);
    
    Router::get('/lancamentos', [LancamentoController::class, 'listPagina']);
    Router::get('/lancamentos/criar', [LancamentoController::class, 'createPagina']);
    Router::get('/lancamentos/editar/{id}', [LancamentoController::class, 'updatePagina']);
    Router::get('/lancamentos/excluir/{id}', [LancamentoController::class, 'deletePagina']);
    Router::post('/lancamentos/criar', [LancamentoController::class, 'create']);
    Router::post('/lancamentos/editar/{id}', [LancamentoController::class, 'update']);
    Router::post('/lancamentos/excluir/{id}', [LancamentoController::class, 'delete']);
});

Router::start();
