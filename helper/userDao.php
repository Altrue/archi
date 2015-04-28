<?php
	require_once('librairie/DAOClass.php');
	require_once('librairie/connectDBClass.php');
	require_once('class/user.php');
	
	class UserDao extends DAOClass {
		
		public function __construct(){
			$this->tableName = "USER";
		}
		
		//sélectionne un utilisateur par son login et mdp si besoin, retourne null ou un objet user
		public function findUserByLog($pdo, $log, $mdp = null){
			$user = null;
			if($mdp == null){
				$pdostat = $this->query($pdo, "SELECT * FROM USER WHERE loginUser = ".$pdo->quote($log).";");
			}
			else{
				$pdostat = $this->query($pdo, "SELECT * FROM USER WHERE loginUser = ".$pdo->quote($log)." AND mdpUser = ".$pdo->quote($mdp).";");
			}
			if($pdostat != null){
				$res = $pdostat->fetch();
				$user = new User($res['id'], $res['loginUser']);
				$pdostat->closeCursor();
			}
			return $user;
		}
		
		//sélectionne un utilisateur par son id, retourne null ou un objet user
		public function findUserById($pdo, $id){
			$user = null;
			$pdostat = $this->findById($pdo, $id);
			if($pdostat != null){
				$res = $pdostat->fetch();
				$user = new User($res['id'], $res['loginUser']);
				$pdostat->closeCursor();
			}
			return $user;
		}
		
		//sélectionne tous les utilisateurs, retourne un tableau de user ou null
		public function findAllUser($pdo){
			$tabUser = null;
			$pdostat = $this->findAll($pdo);
			if($pdostat != null){
				while($res = $pdostat->fetch()){
					$tabUser[] = new User($res['id'], $res['loginUser']);
				}
				$pdostat->closeCursor();
			}
			return $tabUser;
		}
		
		//insert un user
		public function insertUser($pdo, $user){
			$fields = array(
				'login' => $user->getLoginUser()
			);
			$this->insert($pdo, $fields);
		}
		
		//delete un user
		public function deleteUser($pdo, $user){
			$this->delete($pdo, $user->getId());
		}
	}