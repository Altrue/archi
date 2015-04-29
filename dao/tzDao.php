<?php
	require_once('librairie/DAOClass.php');
	require_once('librairie/connectDBClass.php');
	require_once('model/timeZone.php');
	
	class TzDao extends DAOClass {
		
		public function __construct(){
			$this->tableName = "TIMEZONE";
		}
		
		//sélectionne une tz par son id, retourne null ou un objet tz
		public function findTzById($pdo, $id){
			$tz = null;
			$pdostat = $this->findById($pdo, $id);
			if($pdostat != null){
				$pdostat->setFetchMode (PDO::FETCH_CLASS, 'TimeZone');
				$tz = $pdostat->fetch();
				$pdostat->closeCursor();
			}
			return $tz;
		}
		
		//sélectionne toutes les tz, retourne un tableau de tz ou null
		public function findAllTz($pdo){
			$tabTz = null;
			$pdostat = $this->findAll($pdo);
			if($pdostat != null){
				$pdostat->setFetchMode (PDO::FETCH_CLASS, 'TimeZone');
				while($tz = $pdostat->fetch()){
					$tabTz[] = $tz;
				}
				$pdostat->closeCursor();
			}
			return $tabTz;
		}
		
		//sélectionne toutes les tz dont le libelle contient la chaine recherchée
		public function findAllBySearch($pdo, $locationString){
			$tabTz = null;
			$pdostat = $this->query($pdo, "SELECT * FROM TIMEZONE WHERE LOCATE(".$pdo->quote($locationString).",LOWER(libelle)) != 0;");
			if($pdostat != null){
				$pdostat->setFetchMode (PDO::FETCH_CLASS, 'TimeZone');
				while($tz = $pdostat->fetch()){
					$tabTz[] = $tz;
				}
				$pdostat->closeCursor();
			}
			return $tabTz;
		}
		
		//insert une tz
		public function insertTz($pdo, $tz){
			$fields = array(
				'libelle' => $tz->getLibelle(),
			);
			$this->insert($pdo, $fields);
		}
		
		//delete une tz
		public function deleteTz($pdo, $tz){
			$this->delete($pdo, $tz->getId());
		}
	}