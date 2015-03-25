<?php
	//Chiffrement des donn�es sensibles : toutes donn�es pouvant ammen� � l'identit� de la personne
	require_once('/php/connexion/connectDBClass.php');
	class user {
		//attributs
		private $loginUtil;
		private $mdpUtil;
		private $nomUtil;
		private $prenomUtil;
		
		//m�thodes
		//get
		public function getLoginUtil(){
			return $this->loginUtil;
		}
		public function getNomUtil(){
			return $this->nomUtil;
		}
		public function getPrenomUtil(){
			return $this->prenomUtil;
		}
		public function getMdpUtil(){
			return $this->mdpUtil;
		}
		
		//set
		public function setNomUtil($var){
			$this->nomUtil = $var;
		}
		public function setPrenomUtil($var){
			$this->prenomUtil = $var;
		}
		public function setMdpUtil($var){
			$this->mdpUtil = $var;
		}
		
		//DELETE d'un utilisateur
		public function deleteUtilisateur(){
			if(!empty($this->loginUtil)){
				$pdo = connectDB::getInstance();
				$request = $pdo->quote("DELETE FROM USER WHERE idUtil=".$pdo->quote($this->loginUtil).";");
				$pdo->exec($request);
				unset($pdo);
			}
			else{
				throw new Exception('Delete impossible !');
			}
		}
	}