<?php
	require_once('/librairie/DAOClass.php');
	require_once('/librairie/connectDBClass.php');
	require_once('/helper/tzDao.php');
	require_once('/class/user.php');
	
	class zoneUserDao extends DAOClass {
		
		private function __construct(){
			$this->tableName = "ZONEUSER";
		}
		
		public static function getInstance(){
			if(is_null(self::$instance)){
				self::$instance = new zoneUserDao();
			}
			return self::$instance;
		}
		
		//ajoute toutes les zones du user à sa collection (réinitialisé au préalable)
		public function findByUser(&$user){
			$pdostat = $this->query("SELECT * FROM ZONEUSER WHERE idUser = ".$user->getId().";");
			if($pdostat != null){
				$user->setListObjet(array());
				$tzDao = tzDao::getInstance();
				while($res = $pdostat->fetch()){
					$tz = $tzDao->findTzById($res['idZone']);
					$user->addTz($tz);
				}
				$pdostat->closeCursor();
			}
		}
		
		//insert un enregistrement
		public function insertZone(&$user, $tz){
			$fields = array(
				'idUser' => $user->getId(),
				'idZone' => $tz->getId()
			);
			$this->insert($fields);
			$user->addTz($tz);
		}
		
		//delete un enregistrement
		public function deleteZone(&$user, $tz){
			$this->execute("DELETE FROM ZONEUSER WHERE idUser = ".$user->getId()." AND idZone = ".$tz->getId().";");
			$user->deleteTz($tz);
		}
	}