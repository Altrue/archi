<?php
	class TimeZone {
		
		//attr
		private $id;
		private $libelle;
		
		//m�thodes
		//get
		public function getLibelle(){
			return $this->libelle;
		}
		public function getId(){
			return $this->id;
		}
		
	}