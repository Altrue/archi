<?php
	//Chiffrement des donn�es sensibles : toutes donn�es pouvant ammen� � l'identit� de la personne
	require_once('/connexion/connectDBClass.php');
	require_once('/class/collection.php');
	class user {
		//attributs
		private $loginUtil;
		//collection de timeZone
		private $listTz;
		
		//m�thodes
		//constructeur
		public function __construct($var){
			$this->loginUtil = $var;
			$this->listTz = new collection();
			//remplir liste
		}
		
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
		
		//ajoute une timezone � la collection
		public function addTz($libelle, $gtm){
		
		}
		
		//supprime une timezone de la collection
		public function deleteTz($libelle){
		
		}
	}