<?php
	class ConnectDB {
		//attributs
		private $pdoInstance;
		//méthodes
		//constructeur
		public function __construct(){
			$myIniFile = parse_ini_file ("config/config.ini",TRUE);
			$this->pdoInstance = new PDO('mysql:host='.$myIniFile['host'].';dbname='.$myIniFile['base'],$myIniFile['user'],$myIniFile['password']);
		}
		//connexion à une base
		//retourne un objet PDO
		public function connectBase(){
			return $this->pdoInstance;
		}
	}