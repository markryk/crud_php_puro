<?php
    declare(strict_types=1);

    namespace App\Controller;

    use App\Model\Produto;

    class ProdutoController extends AbstractController {
        public function list(): void {
            $this->load('produto/list', Produto::all());
        }

        public function add(): void {

            if (!empty($_POST)) {
                //$_POST['valor'] = (float) $_POST['valor'];
                //$valor_decimal = number_format($_POST['valor'], 2, '.', ',');
                //$prod = new Produto($_POST['descricao'], $valor);
                $prod = new Produto($_POST['descricao'], $_POST['valor']);
                /*var_dump($_POST['descricao']);
                echo $_POST['valor'];
                echo gettype($_POST['descricao']);
                echo gettype($_POST['valor']);
                echo "Alguma coisa";*/
                //echo gettype($_POST['valor']);
                $prod->save(); //método save() está no Model Produto
                header('location: /produtos');//onde vão ser mostrados os dados inseridos (método list())
            }

            //primeiro método a ser chamado é esse
            $this->load('produto/add');
        }

        public function show(): void {
            $id = (int)$_GET['id']; //busca o id que está na URL (via arq. listar.phtml)

            $dados = Produto::findOne($id);

            //primeiro método a ser chamado é esse
            $this->load('produto/show', $dados);
        }

        public function edit(): void {
            //echo gettype($_GET['id']);
            $id = (int)$_GET['id']; //busca o id que está na URL (via arq. listar.phtml)
            //echo gettype((int)$_GET['id']);

            if(!empty($_POST)){
                Produto::update($id, $_POST['descricao'], $_POST['valor']);

                header('location: /produtos'); //onde vão ser mostrados os dados atualizados (método list())
            }

            $dados = Produto::findOne($id);

            $this->load('produto/edit', $dados);
        }

        public function remove(): void {
            Produto::remove((int)$_GET['id']);

            header('location: /produtos');
        }
    }
?>