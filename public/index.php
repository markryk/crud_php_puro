<?php
    //1ª página a ser criada

    ini_set('display_errors', 1);

    include '../vendor/autoload.php';

    use App\Controller\InicioController;
    use App\Controller\RestauranteController; //chama o arq. em questão (RestauranteController.php), necessário à página
    use App\Controller\ProdutoController; //chama o arq. ProdutoController.php
    use App\Controller\AuthController;
    use App\Controller\UsuarioController;
    use App\Security\AuthSecurity;

    session_start();
    date_default_timezone_set('America/Fortaleza');

    //route
    //$url = $_SERVER['REQUEST_URI']; //retorna uma '/' (na URL)
    $url = explode('?', $_SERVER['REQUEST_URI'])[0]; //retorna o que há antes de '?'
    //echo $url;

    //Aqui é a tela de login, para não ver ela, comentar esse trecho
    //Se não houver nenhum usuário logado, já inicia na tela de login
    if (AuthSecurity::getUser() === null) {
        echo match($url) {
            default => (new AuthController)->login(),
        };
    
        exit;
    }

    //include '../Connection.php';
    //include '../src/Controller/AbstractController.php';
    //include '../src/Controller/RestauranteController.php';

    //Rotas para restaurantes e produtos
    echo match ($url) {
        '/' => (new InicioController)->list(),
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

        '/usuarios' => (new UsuarioController)->list(),
        '/usuarios/cadastro' => (new UsuarioController)->add(),
        '/usuarios/editar' => (new UsuarioController)->edit(), 
        '/usuarios/excluir' => (new UsuarioController)->remove(),

        '/logout' => (new AuthController)->logout(),

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