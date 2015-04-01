<?php
	require_once('/librairie/DAOClass.php');
	require_once('/librairie/connectDBClass.php');
	require_once('/class/timeZone.php');
	
	class tzDao extends DAOClass {
		
		private function __construct(){
			$this->tableName = "TIMEZONE";
		}
		
		public static function getInstance(){
			if(is_null(self::$instance)){
				self::$instance = new tzDao();
			}
			return self::$instance;
		}
		
		//sélectionne un utilisateur par son id, retourne null ou un objet user
		public function findTzById($id){
			$tz = null;
			$pdostat = $this->findById($id);
			if($pdostat != null){
				$pdostat->setFetchMode (PDO::FETCH_CLASS, 'timeZone', array('id','libelle','gtm'));
				$tz = $pdostat->fetch();
				$pdostat->closeCursor();
			}
			return $tz;
		}
		
		//sélectionne tous les utilisateurs, retourne un tableau de user ou null
		public function findAllTz(){
			$tabTz = null;
			$pdostat = $this->findAll();
			if($pdostat != null){
				$pdostat->setFetchMode (PDO::FETCH_CLASS, 'timeZone', array('id','libelle','gtm'));
				while($tz = $pdostat->fetch()){
					$tabTz[] = $tz;
				}
				$pdostat->closeCursor();
			}
			return $tabTz;
		}
		
		//insert un user
		public function insertTz($tz){
			$fields = array(
				'libelle' => $tz->getLibelle(),
				'gtm' => $tz->getGtm()
			);
			$this->insert($fields);
		}
		
		//delete un user
		public function deleteTz($tz){
			$this->delete($tz->getId());
		}
	}