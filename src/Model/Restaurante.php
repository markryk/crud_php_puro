<?php
	declare(strict_types=1);

	namespace App\Model; //onde o arq. em questão (Restaurante.php) está localizado (App == src)

	use App\Connection\DefaultConnection; //chama o arq. em questão (DefaultConnection.php), necessário à página

	//include '../Connection/DefaultConnection.php';

	class Restaurante extends AbstractModel {
		public const TABLE = 'tb_restaurantes';

		private string $nome;
		private string $endereco;

		public function __construct(string $nome, string $endereco)
		{
			$this->nome = strip_tags($nome);
			$this->endereco = strip_tags($endereco);
		}

		public static function all(): array {
			return parent::select(self::TABLE);
		}

		public static function qtde(): int {
			return parent::count(self::TABLE);
		}

		public static function findOne(int $id): array {
			return parent::find(self::TABLE, $id);
		}

		//Esse código não dá certo (-cód001-)
		/*public static function save(): array {
			return parent::insert(self::TABLE);
		}*/

		public function save(): void {
			$con = (new DefaultConnection())->abrir();

			$result = $con->prepare("INSERT INTO tb_restaurantes(nome, endereco) VALUES (:nome, :endereco)");
			$result->execute([':nome' => $this->nome, ':endereco' => $this->endereco]);
		}

		public static function update(int $id, string $nome, string $endereco): void {
			$con = (new DefaultConnection())->abrir();
			
			$result = $con->prepare("UPDATE tb_restaurantes SET nome=:nome, endereco=:endereco WHERE id={$id}");
			$result->execute([':nome' => $nome, ':endereco'=> $endereco]);
		}

		public static function remove (int $id): void {
			parent::delete(self::TABLE, $id);
		}
	}


?>