<?php
	require_once('../librairie/DAOClass.php');
	require_once('../librairie/connectDBClass.php');
	require_once('../helper/tzDao.php');
	require_once('../class/user.php');
	
	class zoneUserDao extends DAOClass {
		
		public function __construct(){
			$this->tableName = "ZONEUSER";
		}
		
		//ajoute toutes les zones du user à sa collection (réinitialisé au préalable)
		public function findByUser($pdo, &$user){
			$pdostat = $this->query($pdo, "SELECT * FROM ZONEUSER WHERE idUser = ".$user->getId().";");
			if($pdostat != null){
				$user->setListTz(array());
				$tzDao = new tzDao();
				while($res = $pdostat->fetch()){
					$tz = $tzDao->findTzById($pdo, $res['idZone']);
					$user->addTz($tz);
				}
				$pdostat->closeCursor();
			}
		}
		
		//insert un enregistrement
		public function insertZone($pdo, &$user, $tz){
			$fields = array(
				'idUser' => $user->getId(),
				'idZone' => $tz->getId()
			);
			$this->insert($pdo, $fields);
			$user->addTz($tz);
		}
		
		//delete un enregistrement
		public function deleteZone($pdo, &$user, $tz){
			$this->execute($pdo, "DELETE FROM ZONEUSER WHERE idUser = ".$user->getId()." AND idZone = ".$tz->getId().";");
			$user->deleteTz($tz);
		}
	}