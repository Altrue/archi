<?php
	class TimeZone {
		
		//attr
		private $id;
		private $libelle;
		
		//m�thodes
		//constructeur
		public function __construct($id, $libelle){
			$this->id = $id;
			$this->libelle = $libelle;
		}
		
		//get
		public function getLibelle(){
			return $this->libelle;
		}
		public function getId(){
			return $this->id;
		}
		
	}