<?php
	require_once('librairie/DAOClass.php');
	require_once('librairie/connectDBClass.php');
	require_once('dao/tzDao.php');
	require_once('model/user.php');
	
	class ZoneUserDao extends DAOClass {
		
		public function __construct(){
			$this->tableName = "ZONEUSER";
		}
		
		//ajoute toutes les zones du user � sa collection (r�initialis� au pr�alable)
		public function findByUser($pdo, &$user){
			$pdostat = $this->query($pdo, "SELECT * FROM ZONEUSER WHERE idUser = ".$user->getId().";");
			if($pdostat != null){
				$user->setListTz(array());
				$tzDao = new TzDao();
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
		
		//v�rifie si la zone est s�lectionn�e par l'utilisateur
		public function exist($pdo, $tz){
			$retour = false;
			$pdostat = $this->query($pdo, "SELECT * FROM ZONEUSER WHERE idZone = ".$tz->getId().";");
			if($pdostat != null){
				$retour = true;
			}
			return $retour;
		}
	}