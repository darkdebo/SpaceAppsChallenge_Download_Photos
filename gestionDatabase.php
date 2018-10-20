<?php	
	require_once 'loginMysql.php';

	class Database {
		// Instancia de la clase
		private static $db = null;

		// Instancia de PDO
		private static $pdo;

		final private function __construct() {
			try {
				// Crear nueva conexión PDO
				self::getDb();
			} catch (PDOException $e) {
				// Control de excepciones
			}
		}

		// Retorna la única instancia de la clase
		public static function getInstance() {
			if (self::$db == null) {
				self::$db = new self();
			}
			
			return self::$db;
		}

		// Crear una nueva conexión PDO basada en los datos de conexión
		public function getDb() {
			if (self::$pdo == null) {
				self::$pdo = new PDO(
					'mysql:dbname=' . DATABASE .
					';host=' . HOSTNAME .					
					';port:63343;',
					USERNAME,
					PASSWORD,
					array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
				);

				// Habilitar excepciones
				self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);				
			}

			return self::$pdo;
		}
		
		// Evita la clonación del objeto
		final protected function __clone() {
			
		}

		function _destructor() {
			self::$pdo = null;
		}
	}
?>
