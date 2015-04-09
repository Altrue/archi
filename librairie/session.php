<?php
	//ajouter le blocage du compte pour plus de 5 tentatives

	require_once('connectDBClass.php');
	require_once('../helper/userDao.php');
	
	class session {
		//attribut
		private $loginUser;

		//m�thode
		//get
		public function getLoginUser(){
			return $this->loginUser;
		}
		
		//constructeur
		public function __construct($login){
			$this->loginUser = $login;
		}
		
		//cr�er une session si $mdp est bien associ� au login de la session
		//retourne 0 si �chec, 1 si ok et 2 si compte bloqu�
		public function connectUtilisateur($mdp){
			$retour = 0;
			if(!empty($this->loginUser) && !empty($mdp)){
				$co = new connectDB();
				$pdo = $co->connectBase();
				$userDao = new userDAO();
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
			$pdo = connectDB::getInstance();
			$pdo->exec("UPDATE USER SET mdpUser = ".$pdo->quote($mdp)." WHERE loginUser = ".$pdo->quote($this->loginUser).";");
			unset($pdo);
		}
	}