<?php
	class timeZone {
		
		//attr
		private $libelle;
		private $gtm;
		
		//méthodes
		//constructeur
		public function __construct($libelle, $gtm){
			$this->libelle = $libelle;
			$this->gtm = $gtm;
		}
		
		//get
		public function getLibelle(){
			return $this->libelle;
		}
		
		public function getGtm(){
			return $this->gtm;
		}
		
	}