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
                $valor_float = (float)$_POST['valor'];
                $prod = new Produto($_POST['descricao'], $valor_float);
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
            $id = (int)$_GET['id']; //busca o id que está na URL (via arq. listar.phtml)

            if(!empty($_POST)){
                $valor = (float)$_POST['valor'];
                Produto::update($id, $_POST['descricao'], $valor);

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