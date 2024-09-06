<?php
    declare(strict_types=1);

    namespace App\Model;
    use App\Connection\DefaultConnection;
    
    //class Usuario extends AbstractModel implements ModelInterface
    class Usuario extends AbstractModel
    {
        public const TABLE = 'tb_usuarios';
    
        private int $id;
        private string $nome;
        private string $email;
        private string $senha;
    
        public function getId(): int
        {
            return $this->id;
        }
    
        public function getNome(): string
        {
            return $this->nome;
        }
    
        public function setNome(string $nome): void
        {
            $this->nome = ucwords(strtolower($nome));
        }
    
        public function getEmail(): string
        {
            return $this->email;
        }
    
        public function setEmail(string $email): void
        {
            $this->email = str_replace(' ', '', strtolower($email));
        }
    
        public function setSenha(string $senha): void
        {
            $this->senha = password_hash($senha, PASSWORD_ARGON2I);
        }
    
        public static function all(): array
        {
            return parent::select(self::TABLE);
        }
    
        public function save(): void
        {
            $table = self::TABLE;
    
            $today = date('Y-m-d H:i:s');

            //var_dump($usuario);
            /*echo $_POST['email']; echo "<br>";
            $e = $_POST['email'];
            $email = parent::db()->prepare("SELECT email FROM {$table} WHERE email = $e");
            if ($email) echo "Tem"; echo "<br>";
            var_dump($email); echo "<br>";*/

            
    
            $result = parent::db()->prepare(
                "INSERT INTO {$table} (nome, email, senha, created_at) 
                VALUES ('{$this->nome}', '{$this->email}', '{$this->senha}', '{$today}')"
            );
            //var_dump($result);
            $result->execute();
        }
    
        public static function count(): int
        {
            return 0;
        }
    
        public static function findOne(int $id): array
        {
            //return new \stdClass();
            return parent::find(self::TABLE, $id);
        }

        public static function update(int $id, string $nome, string $email, string $senha): void {
            $con = (new DefaultConnection())->abrir();
			
			$result = $con->prepare("UPDATE tb_usuarios SET nome=:nome, email=:email, senha=:senha WHERE id={$id}");
			$result->execute([':nome' => $nome, ':email'=> $email, ':senha' => $senha]);
        }

        public static function remove (int $id): void {
            parent::delete(self::TABLE, $id);
        }
    }
?>