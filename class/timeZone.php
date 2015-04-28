<?php
	class TimeZone {
		
		//attr
		private $id;
		private $libelle;
		
		//méthodes
		//get
		public function getLibelle(){
			return $this->libelle;
		}
		public function getId(){
			return $this->id;
		}
		
	}