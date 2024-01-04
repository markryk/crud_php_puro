<?php
	declare(strict_types=1);

	namespace App\Model; //onde o arq. em questão (AbstractModel.php) está localizado (App == src)

	use App\Connection\DefaultConnection; //chama o arq. em questão (DefaultConnection.php), necessário à página
	use PDO;

	//include '../Connection/DefaultConnection.php';

	abstract class AbstractModel {
		//função para abrir a conexão com o db
		public static function db(): PDO {
			return (new DefaultConnection)->abrir();
		}

		public static function count(string $table): int {
			$resultado = self::db()->prepare("SELECT COUNT(*) AS qtd FROM {$table}");
			$resultado->execute();

			return $resultado->fetch()['qtd'];
		}

		public static function select(string $table): array {
			$resultado = self::db()->prepare("SELECT * FROM {$table}");
			$resultado->execute();

			return $resultado->fetchAll();
		}

		public static function find(string $table, int $id): array {
			$con = (new DefaultConnection)->abrir();

			$result = $con->prepare("SELECT * FROM {$table} WHERE id={$id}");
			$result->execute();

			return $result->fetch();
		}

		public static function delete(string $table, int $id): void {
			$con = (new DefaultConnection)->abrir();

			$result = $con->prepare("DELETE FROM {$table} WHERE id={$id}");
        	$result->execute();
		}

		//Esse código não dá certo (-cód001-)
		/*public static function insert(string $table): array {
			$resultado = self::db()->prepare("INSERT INTO tb_restaurantes(nome, endereco) VALUES (:nome, :endereco)");
			$resultado->execute([':nome' => $this->nome, ':endereco' => $this->endereco]);
		}*/
	}
?>