<?php
	require_once('librairie/connectDBClass.php');

	abstract class DAOClass {
	
		protected $tableName;
		
		//éxécute une requete SELECT et renvoi le résultat pdostatement ou null
		public function query($pdo,$request){
			$pdostat = $pdo->query($request);
			if($pdostat->rowCount() == 0){
				$pdostat = null;
			}
			return $pdostat;
		}
		
		//éxécute une requete DELETE, INSERT, UPDATE
		public function execute($pdo, $request){
			$pdo->exec($request);
		}
		
		//renvoi un outil pdostatement ou null si 0 résultat
		public function findById($pdo, $id){
			$pdostat = $pdo->query("SELECT * FROM ".$this->tableName." WHERE id = ".$id.";");
			if($pdostat->rowCount() == 0){
				$pdostat = null;
			}
			return $pdostat;
		}
		
		//renvoi un outil pdostatement ou null si 0 résultat
		public function findAll($pdo){
			$pdostat = $pdo->query("SELECT * FROM ".$this->tableName.";");
			if($pdostat->rowCount() != 0){
				$pdostat = null;
			}
			return $pdostat;
		}
		
		//insert le tableau de donnée qui doit être de la forme $t['column']=value_column
		public function insert($pdo, $fields){
			$keyRequest = "";
			$valRequest = "";
			foreach($fields as $key => &$value){
				$keyRequest = $keyRequest.",".$key;
				if(is_string($value)){
					$value = $pdo->quote($value);
				}
				$valRequest = $valRequest.",".$value;
			}
			$keyRequest = substr($keyRequest, 1);
			$valRequest = substr($valRequest, 1);
			$pdo->exec("INSERT INTO ".$this->tableName." (".$keyRequest.") VALUES(".$valRequest.");");
		}
		
		//met à jour un enregistrement
		public function update($pdo, $fields, $id){
			$request = "";
			foreach($fields as $key => &$value){
				$request = $request.",".$key."=";
				if(is_string($value)){
					$value = $pdo->quote($value);
				}
				$request = $request.$value;
			}
			$request = substr($request, 1);
			$pdo->exec("UPDATE ".$this->tableName." SET ".$request." WHERE id = ".$id.";");
		}
		
		//supprime un enregistrement
		public function delete($pdo, $id){
			$pdo->exec("DELETE FROM ".$this->tableName." WHERE id = ".$id.";");
		}
	}