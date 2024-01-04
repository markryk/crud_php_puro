<?php
	declare(strict_types=1);

	namespace App\Connection; //onde o arq. em questão (DefaultConnection.php) está localizado (App == src)

	use PDO;

	class DefaultConnection {

		//variáveis de ambiente
		public const HOST = 'localhost';
		public const USER = 'root';
		public const PASS = '';
		public const DB = 'db_restaurante';

		public function abrir(): PDO {
			$conexao = new PDO('mysql:host='.self::HOST.';dbname='.self::DB, self::USER, self::PASS);
			return $conexao;
		}
	}
?>