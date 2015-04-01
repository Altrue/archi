<?php
	class timeZone {
		
		//attr
		private $id;
		private $libelle;
		private $gtm;
		
		//méthodes
		//constructeur
		public function __construct($id, $libelle, $gtm){
			$this->id = $id;
			$this->libelle = $libelle;
			$this->gtm = $gtm;
		}
		
		//get
		public function getLibelle(){
			return $this->libelle;
		}
		public function getId(){
			return $this->id;
		}
		public function getGtm(){
			return $this->gtm;
		}
		
	}