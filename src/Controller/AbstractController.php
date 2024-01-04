<?php
    declare(strict_types=1);

    namespace App\Controller; //onde o arq. em questão (AbstractController.php) está localizado (App == src)

    use App\Connection\DefaultConnection; //chama o arq. em questão (DefaultConnection.php), necessário à página

    abstract class AbstractController {
        //Essa função é onde se carrega a estrutura da página (cabeçalho, menu, conteudo da página, rodapé)    
        public function load(string $view, array $dados = []): void {
            //esse "array $dados = []" vai ser usado no arq. "listar.phtml"
            //desenvolver cada página
            include "../src/Views/_templates/head.phtml";        
            include "../src/Views/_components/menu.phtml";

            include "../src/Views/{$view}.phtml";
    
            include "../src/Views/_templates/footer.phtml";
        }

        /*public function conexao (): \PDO {
            return (new DefaultConnection)->abrir();
        }*/
    }
?>