<?php
	//Cria um arquivo DefaultConnection.php, copia essas informações e coloca as informações do banco de dados
	declare(strict_types=1);

	namespace App\Connection; //onde o arq. em questão (DefaultConnection.php) está localizado (App == src)

	use PDO;

	class DefaultConnection {

		//variáveis de ambiente
		public const HOST = 'localhost';
		public const USER = '';
		public const PASS = '';
		public const DB = '';

		public function abrir(): PDO {
			$conexao = new PDO('mysql:host='.self::HOST.';dbname='.self::DB, self::USER, self::PASS);
			return $conexao;
		}
	}
?>