<?php
	//Chiffrement des données sensibles : toutes données pouvant ammené à l'identité de la personne
	require_once('/librairie/connectDBClass.php');
	require_once('/librairie/collection.php');
	require_once('/class/timeZone.php');
	
	class user {
		//attributs
		private $id;
		private $loginUser;
		//collection de timeZone
		private $listTz;
		
		//méthodes
		//constructeur
		public function __construct($id, $log){
			$this->id = $id;
			$this->loginUser = $log;
			$this->listTz = new collection();
		}
		
		//get
		public function getLoginUser(){
			return $this->loginUser;
		}
		public function getId(){
			return $this->id;
		}
		public function getListTz(){
			return $this->listTz;
		}
		//set
		public function setListTz($arrayTz){
			$this->listTz->setListObjet($arrayTz);
		}
		
		//ajoute une timezone à la collection
		public function addTz($tz){
			$this->listTz->addObjet($tz);
		}
		
		//supprime une timezone de la collection
		public function deleteTz($tz){
			$x = 0;
			foreach ($this->listTz->getListObjet() as $zone){
				if($zone->getId() == $tz->getId()){
					break;
				}
				$x++;
			}
			$this->listTz->supprObjet($x);
		}
	}