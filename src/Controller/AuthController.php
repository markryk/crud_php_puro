<?php
    declare(strict_types=1);
    namespace App\Controller;

    use App\Model\AbstractModel;
    use App\Security\AuthSecurity;

    class AuthController extends AbstractController {
        public function login(): void {
            if ($_POST || !empty($_POST)) {
                $result = AbstractModel::db()->prepare(
                    "SELECT * FROM tb_usuarios WHERE email='{$_POST['email']}'"
                );
                $result->execute();
    
                $dados = $result->fetchObject();
    
                if ($dados === false) {
                    echo "Usuário não encontrado";
                    $this->load('auth/login', exibirMenu: false);
                    return;
                }
    
                if (password_verify($_POST['senha'], $dados->senha) === false) {
                    echo "Senha incorreta";
                    $this->load('auth/login', exibirMenu: false);
                    return;
                }
    
                //se chegou aqui é pq logou
                $today = date('Y-m-d H:i:s');
                AbstractModel::db()->prepare(
                    "UPDATE tb_usuarios SET updated_at='{$today}' WHERE id='{$dados->id}'"
                )->execute();
    
                AuthSecurity::setUser($dados->nome);
                header('location: /');
            }
            //Carrega o arq. login.phtml que está dentro da pasta views/auth
            $this->load('auth/login', exibirMenu: false);
        }
    
        public function logout(): void {
            AuthSecurity::disconnect();
            header('location: /');
        }
    }
?>