<?php
    declare(strict_types=1);

    namespace App\Controller; //onde o arq. em questão (RestauranteController.php) está localizado (App == src)

    use App\Model\Restaurante; //chama o arq. em questão (Restaurante.php), necessário à página

    /*foreach ($_SERVER as $parm => $value) {
        echo "<pre> $parm = '$value'\n </pre>";
    }*/
    //echo $_SERVER['SCRIPT_FILENAME'];
    //echo dirname(__DIR__);
    //include $_SERVER['SCRIPT_FILENAME'].'/Model/Restaurante.php';
    //include '../Model/Restaurante.php';

    class RestauranteController extends AbstractController {
        public function list(): void {
            $this->load('restaurante/list', Restaurante::all());
        }

        public function add(): void {
            //será aberto o form, depois de preenchido, será rodado esse código (como se fosse o segundo método)
            if (!empty($_POST)) {
                $rest = new Restaurante($_POST['nome'], $_POST['endereco']);
                $rest->save(); //método save() está no Model Restaurante

                header('location: /restaurantes'); //onde vão ser mostrados os dados inseridos (método list())
            }

            //primeiro método a ser chamado é esse
            $this->load('restaurante/add');
        }

        public function show(): void {
            $id = (int)$_GET['id']; //busca o id que está na URL (via arq. listar.phtml)

            $dados = Restaurante::findOne($id);

            //primeiro método a ser chamado é esse
            $this->load('restaurante/show', $dados);
        }

        /*public function save(): void {
            $this->load('restaurante/salvar');
        }*/

        public function edit(): void {
            $id = (int)$_GET['id']; //busca o id que está na URL (via arq. listar.phtml)

            if(!empty($_POST)){
                Restaurante::update($id, $_POST['nome'], $_POST['endereco']);

                header('location: /restaurantes'); //onde vão ser mostrados os dados atualizados (método list())
            }

            $dados = Restaurante::findOne($id);

            //primeiro método a ser chamado é esse
            $this->load('restaurante/edit', $dados);
        }

        /*public function edit(): void
        {
            echo "Passou por aqui";
        }*/

        public function remove(): void {
            Restaurante::remove((int)$_GET['id']);

            header('location: /restaurantes');
        }
    }

    /*class RestaurantController {
        public function list(): void {
            $this->load('restaurante/listar');
        }
    }*/
?>