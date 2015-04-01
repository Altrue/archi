<?php
	require_once('/librairie/DAOClass.php');
	require_once('/librairie/connectDBClass.php');
	require_once('/class/user.php');
	
	class userDao extends DAOClass {
		
		private function __construct(){
			$this->tableName = "USER";
		}
		
		public static function getInstance(){
			if(is_null(self::$instance)){
				self::$instance = new userDao();
			}
			return self::$instance;
		}
		
		//sélectionne un utilisateur par son id, retourne null ou un objet user
		public function findUserById($id){
			$user = null;
			$pdostat = $this->findById($id);
			if($pdostat != null){
				$res = $pdostat->fetch();
				$user = new user($res['id'], $res['loginUser']);
				$pdostat->closeCursor();
			}
			return $user;
		}
		
		//sélectionne tous les utilisateurs, retourne un tableau de user ou null
		public function findAllUser(){
			$tabUser = null;
			$pdostat = $this->findAll();
			if($pdostat != null){
				while($res = $pdostat->fetch()){
					$tabUser[] = new user($res['id'], $res['loginUser']);
				}
				$pdostat->closeCursor();
			}
			return $tabUser;
		}
		
		//insert un user
		public function insertUser($user){
			$fields = array(
				'login' => $user->getLoginUser()
			);
			$this->insert($fields);
		}
		
		//delete un user
		public function deleteUser($user){
			$this->delete($user->getId());
		}
	}