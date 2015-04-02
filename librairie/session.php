<?php
	//ajouter le blocage du compte pour plus de 5 tentatives

	require_once('connectDBClass.php');
	class session {
		//attribut
		private $loginUser;

		//méthode
		//get
		public function getLoginUser(){
			return $this->loginUser;
		}
		
		//constructeur
		public function __construct($login){
			$this->loginUser = $login;
		}
		
		//créer une session si $mdp est bien associé au login de la session
		//retourne 0 si échec, 1 si ok et 2 si compte bloqué
		public function connectUtilisateur($mdp){
			$retour = 0;
			if(!empty($this->loginUser) && !empty($mdp)){
				$co = new connectDB();
				$pdo = $co->connectBase();
				$pdostat = $pdo->query("SELECT mdpUser FROM USER WHERE loginUser=".$pdo->quote($this->loginUser).";");
				if($pdostat->rowCount() == 1){
					$res = $pdostat->fetch();
					if($res['mdpUser'] == $mdp){
						$_SESSION['user'] = serialize($this);
						$retour = 1;
					}
				}
				$pdostat->closeCursor();
				unset($pdo);
			}
			return $retour;
		}
		public function changerMdp($mdp){
			$pdo = connectDB::getInstance();
			$pdo->exec("UPDATE USER SET mdpUser = ".$pdo->quote($mdp)." WHERE loginUser = ".$pdo->quote($this->loginUser).";");
			unset($pdo);
		}
	}