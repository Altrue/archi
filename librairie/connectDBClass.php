<?php
	class connectDB {
		//attributs
		private static $pdoInstance = null;
		//méthodes
		//constructeur
		private function __construct(){
			$myIniFile = parse_ini_file ("/config/conf.ini",TRUE);
			$this->pdoInstance = new PDO('mysql:host='.$myIniFile['host'].';dbname='.$myIniFile['base'],$myIniFile['user'],$myIniFile['password']);
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