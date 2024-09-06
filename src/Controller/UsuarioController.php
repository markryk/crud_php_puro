<?php
    declare(strict_types=1);
    namespace App\Controller;

    use App\Model\Usuario;

    class UsuarioController extends AbstractController {
        public function list(): void {
            //Aqui vai chamar o arq. list.phtml que está na pasta views/usuario e o método all() do model Usuario
            $this->load('usuario/list', Usuario::all());
        }

        public function add(): void {
            if (empty($_POST)) {
                //Se não houver dados, inserir o arq. add.phtml que está em views/usuario
                $this->load('usuario/add');
                return;
            }
    
            $usuario = new Usuario();
            $usuario->setNome($_POST['nome']);
            $usuario->setEmail($_POST['email']);
            $usuario->setSenha($_POST['senha']);

            //Deixar esse trecho comentado, por enquanto
            //Supõe-se que esse trecho seja para evitar o cadastro de usuário já existente no bd
            /*$e = $_POST['email'];
            echo $e; echo "<br>";
            if ($usuario->findEmail('tb_usuarios', $e)) {
                echo "Existe o email no bd"; echo "<br>";
                $usuario->findEmail('tb_usuarios', $e);
            } else {
                echo "Não existe"; echo "<br>";
            }

            echo "<pre>";
            var_dump($usuario->findEmail('tb_usuarios', $e));
            echo "</pre>";

            /////////////////////////////////////////////////

            if ($usuario->find('tb_usuarios', 1)) {
                echo "Existe o email no bd"; echo "<br>";
            } else {
                echo "Não existe"; echo "<br>";
            }

            echo "<pre>";
            var_dump($usuario->find('tb_usuarios', 1));
            echo "</pre>";

            die();*/
    
            $usuario->save();
    
            header('location: /usuarios');
        }

        public function edit(): void {
            $id = (int)$_GET['id']; //busca o id que está na URL (via arq. listar.phtml)

            if(!empty($_POST)){
                Usuario::update($id, $_POST['nome'], $_POST['email'], $_POST['senha']);

                header('location: /usuarios'); //onde vão ser mostrados os dados atualizados (método list())
            }

            $dados = Usuario::findOne($id);

            //primeiro método a ser chamado é esse
            $this->load('usuario/edit', $dados);
        }

        public function remove(): void {
            Usuario::remove((int)$_GET['id']);

            header('location: /usuarios');
        }
    }
?>