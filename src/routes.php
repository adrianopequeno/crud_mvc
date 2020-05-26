<?php
use core\Router;

$router = new Router();

// Rota de leitura dos usuários
$router->get('/', 'HomeController@index');

// Rotas de Add novo usuário
$router->get('/novo', 'UsuariosController@add');
$router->post('/novo', 'UsuariosController@addAction');

// Rotas de edição de usuário
$router->get('/usuario/{id}/editar', 'UsuariosController@edit');
$router->post('/usuario/{id}/editar', 'UsuariosController@editAction');

// Rota de excluir usuário
$router->get('/usuario/{id}/excluir', 'UsuariosController@del');