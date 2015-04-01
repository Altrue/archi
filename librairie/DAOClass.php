<?php
	require_once('/librairie/connectDBClass.php');

	abstract class DAOClass {
	
		protected $tableName;
		protected static $instance;
		
		//éxécute une requete SELECT et renvoi le résultat pdostatement ou null
		public function query($request){
			$res = null;
			$pdo = connectDB::getInstance();
			$pdostat = $pdo->query($request);
			if($pdostat->columnCount() != 0){
				$res = $pdostat;
			}
			$pdostat->closeCursor();
			unset($pdo);
			return $res;
		}
		
		//éxécute une requete DELETE, INSERT, UPDATE
		public function execute($request){
			$res = null;
			$pdo = connectDB::getInstance();
			$pdo->exec($request);
			unset($pdo);
			return $res;
		}
		
		//renvoi un outil pdostatement ou null si 0 résultat
		public function findById($id){
			$res = null;
			$pdo = connectDB::getInstance();
			$pdostat = $pdo->query("SELECT * FROM ".$tableName." WHERE id = ".$id.";");
			if($pdostat->columnCount() == 1){
				$res = $pdostat;
			}
			$pdostat->closeCursor();
			unset($pdo);
			return $res;
		}
		
		//renvoi un outil pdostatement ou null si 0 résultat
		public function findAll(){
			$res = null;
			$pdo = connectDB::getInstance();
			$pdostat = $pdo->query("SELECT * FROM ".$tableName.";");
			if($pdostat->columnCount() != 0){
				$res = $pdostat;
			}
			$pdostat->closeCursor();
			unset($pdo);
			return $res;
		}
		
		//insert le tableau de donnée qui doit être de la forme $t['column']=value_column
		public function insert($fields){
			$pdo = connectDB::getInstance();
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
			$pdo->exec("INSERT INTO ".$tableName." (".$keyRequest.") VALUES(".$valRequest.");");
			unset($pdo);
		}
		
		//met à jour un enregistrement
		public function update($fields, $id){
			$pdo = connectDB::getInstance();
			$request = "";
			foreach($fields as $key => &$value){
				$request = $request.",".$key."=";
				if(is_string($value)){
					$value = $pdo->quote($value);
				}
				$request = $request.$value;
			}
			$request = substr($request, 1);
			$pdo->exec("UPDATE ".$tableName." SET ".$request." WHERE id = ".$id.";");
			unset($pdo);
		}
		
		//supprime un enregistrement
		public function delete($id){
			$pdo = connectDB::getInstance();
			$pdo->exec("DELETE FROM ".$tableName." WHERE id = ".$id.";");
			unset($pdo);
		}
	}