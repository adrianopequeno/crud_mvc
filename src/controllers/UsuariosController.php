<?php
namespace src\controllers;

use \core\Controller;
use \src\models\Usuario;

class UsuariosController extends Controller {

    public function add() {
      $this->render('add');
    }

    public function addAction() {
      $name = filter_input(INPUT_POST, 'name');
      $email = filter_input(INPUT_POST, 'email');

      if ($name && $email) {
        // buscando usuário por e-mail
        $data = Usuario::select()->where('email', $email)->execute();

        if (count($data) === 0) {
          # Insere novo usuário
          Usuario::insert([
            'nome' => $name,
            'email' => $email
          ])->execute();

          #redirect para home = /
          $this->redirect('/');
        }
      }
      // redirect para /novo
      $this->redirect('/novo');
    }

    public function edit($args) {
      // $usuario = Usuario::select()->where('id', $args['id'])->one();
      $usuario = Usuario::select()->find($args['id']);

      $this->render('edit', [
        'usuario' => $usuario
      ]); // chamando a view edit com os dados do usuário para edição
    }
    public function editAction($args) {
      $name = filter_input(INPUT_POST, 'name');
      $email = filter_input(INPUT_POST, 'email');

      if ($name && $email) {
      
        // atualizando dados do usuário
        Usuario::update()
          ->set('nome', $name)
          ->set('email', $email)
          ->where('id', $args['id'])
        ->execute();

        $this->redirect('/'); // HOME
      }

      $this->redirect('/usuario'.$args['id'].'/editar');
    }

    public function del($args) {
      // Deletando um usuário pelo id
      Usuario::delete()
        ->where('id', $args['id'])
      ->execute();

      $this->redirect('/'); // redirect para a Home
    }

}