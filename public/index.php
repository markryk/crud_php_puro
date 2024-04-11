<?php
    //1ª página a ser criada

    ini_set('display_errors', 1);

    include '../vendor/autoload.php';

    use App\Controller\RestauranteController; //chama o arq. em questão (RestauranteController.php), necessário à página
    use App\Controller\ProdutoController; //chama o arq. ProdutoController.php

    //route
    //$url = $_SERVER['REQUEST_URI']; //retorna uma '/' (na URL)
    $url = explode('?', $_SERVER['REQUEST_URI'])[0]; //retorna o que há antes de '?'
    //echo $url;

    //include '../Connection.php';
    //include '../src/Controller/AbstractController.php';
    //include '../src/Controller/RestauranteController.php';

    //router
    echo match ($url) {
        '/' => load('inicio'),
        '/restaurantes'=> (new RestauranteController)->list(),
        '/restaurantes/mostrar'=> (new RestauranteController)->show(),
        '/restaurantes/adicionar'=> (new RestauranteController)->add(),
        '/restaurantes/editar' => (new RestauranteController)->edit(),
        '/restaurantes/excluir' => (new RestauranteController)->remove(),
        //'/restaurantes/pdf' => (new RestauranteController)->pdf(),

        '/produtos' => (new ProdutoController)->list(),
        '/produtos/mostrar'=> (new RestauranteController)->show(),
        '/produtos/adicionar' => (new ProdutoController)->add(), 
        '/produtos/editar' => (new ProdutoController)->edit(), 
        '/produtos/excluir' => (new ProdutoController)->remove(),

        default => load('erro')
    };

    //Essa função é onde se carrega a estrutura da página (cabeçalho, menu, conteudo da página, rodapé) 
    function load(string $view): void {
        //desenvolver cada página
        include "../src/Views/_templates/head.phtml";        
        include "../src/Views/_components/menu.phtml";

        include "../src/Views/{$view}.phtml";
    
        include "../src/Views/_templates/footer.phtml";
    }
    //(Essa função também está na pág. AbstractController.php)
?>