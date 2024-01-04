<?php
    declare(strict_types=1);

    namespace App\Model;

    use App\Connection\DefaultConnection;
    //use App\Model\AbstractModel;

    class Produto extends AbstractModel {
        public const TABLE = 'tb_produtos';

        private string $descricao;
        private float $valor;

        public function __construct(string $descricao, float $valor) {
			$this->descricao = strip_tags($descricao);
			//$this->valor = strip_tags($valor);
            $this->valor = $valor;
		}

        public static function all(): array {
			return parent::select(self::TABLE);
		}

        public static function findOne(int $id): array {
			return parent::find(self::TABLE, $id);
		}

        public static function qtde() {
            return parent::count(self::TABLE);
        }

        public function save(): void {
            $con = (new DefaultConnection())->abrir();

            $result = $con->prepare("INSERT INTO tb_produtos (descricao, valor) VALUES (:descricao, :valor");
            $result->execute([':descricao' => $this->descricao, ':valor' => $this->valor]);
        }

        public static function update(int $id, string $descricao, string $valor): void {
			$con = (new DefaultConnection())->abrir();
			
			$result = $con->prepare("UPDATE tb_produtos SET descricao=:descricao, valor=:valor WHERE id={$id}");
			$result->execute([':descricao' => $descricao, ':valor'=> $valor]);
		}

        public static function remove (int $id): void {
			parent::delete(self::TABLE, $id);
		}
    }
?>