<?php
	class connectDB {
		//attributs
		private $host = '127.0.0.1';
		private $base = 'tz_project';
		private $user = 'tz_user';
		private $password = 'tz_pwd';
		private static $pdoInstance = null;
		//méthodes
		//constructeur
		private function __construct(){
			$this->pdoInstance = new PDO('mysql:host='.$this->host.';dbname='.$this->base,$this->user,$this->password);
		}
		//connexion à une base
		//retourne un objet PDO
		public static function getInstance(){
			if(is_null(self::$pdoInstance)){
				self::$pdoInstance = new connectDB();
			}
			return self::$pdoInstance;
		}
	}