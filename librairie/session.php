<?php
	//ajouter le blocage du compte pour plus de 5 tentatives

	require_once('librairie/connectDBClass.php');
	require_once('helper/userDao.php');
	
	class Session {
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
				$co = new ConnectDB();
				$pdo = $co->connectBase();
				$userDao = new UserDAO();
				$user = $userDao->findUserByLog($pdo, $this->loginUser, $mdp);
				if($user != null){
					$_SESSION['user'] = serialize($this);
					$retour = 1;
				}
				unset($pdo);
			}
			return $retour;
		}
		
		public function changerMdp($mdp){
			$connect = new ConnectBase();
			$pdo = $connect->connectBase();
			$pdo->exec("UPDATE USER SET mdpUser = ".$pdo->quote($mdp)." WHERE loginUser = ".$pdo->quote($this->loginUser).";");
			unset($pdo);
		}
	}