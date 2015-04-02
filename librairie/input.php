<?php
	class input {
		//attributs
		private $name;
		private $value;
		private $type;
		private $max;
		private $min;
		private $required;
		
		//méthodes
		//constructeur
		public function __construct($name,$type,$value,$min,$max,$required){
			$this->name=$name;
			$this->type=$type;
			$this->value=$value;
			if($min!=null && is_int($min)){
				$this->min=$min;
			}
			if($max!=null && is_int($max)){
				$this->max=$max;
			}
			if(is_bool($required)){
				$this->required=$required;
			}
			else{
				throw new Exception('Type du paramètre required invalide !');
			}
		}
		
		//set
		public function setValue($value){
			$this->value=$value;
		}
		
		//get
		public function getName(){
			return $this->name;
		}
		public function getType(){
			return $this->type;
		}
		public function getValue(){
			return $this->value;
		}
		public function getMin(){
			return $this->min;
		}
		public function getMax(){
			return $this->max;
		}
		public function getRequired(){
			return $this->required;
		}
		
		//vérifie l'intégrité du value et sécurise la donnée
		//renvoie true si tout est ok, sinon false
		public function secureValue(){
			$secure=true;
			switch($this->type){
				case "text":
					if($this->min != null && strlen($this->value)<$this->min){
						$secure=false;
					}
					if($this->max != null && strlen($this->value)>$this->max){
						$secure=false;
					}
					$this->value=str_replace('&','&amp;',$this->value);
					$this->value=str_replace('<','&lt;',$this->value);
					$this->value=str_replace('>','&gt;',$this->value);
					$this->value=addcslashes($this->value, '%_');
				break;
				case "number":
					if(is_numeric($this->value)){
						if($this->min!=null && $this->value < $this->min){
							$secure=false;
						}
						if($this->min!=null && $this->value > $this->max){
							$secure=false;
						}
					}
					else{
						$secure=false;
					}
				break;
				case "password":
					if($this->min != null && strlen($this->value)<$this->min){
						$secure=false;
					}
					else{
						$this->value=hash("sha256",$this->value);
					}
				break;
				case "date":
					if(strpos($this->value,"-")!=false){
						if(preg_match("#^[0-9]{4}-[0-9]{2}-[0-9]{2}$#",$this->value)){
							list($annee, $mois, $jour) = explode('-', $this->dateActu);
						}
						else{
							list($jour, $mois, $annee) = explode('-', $this->dateActu);
						}
					}
					elseif(strpos($this->value,"/")!=false){
						if(preg_match("#^[0-9]{4}\/[0-9]{2}\/[0-9]{2}$#",$this->value)){
							list($annee, $mois, $jour) = explode('/', $this->value);
						}
						else{
							list($jour, $mois, $annee) = explode('/', $this->value);
						}
					}
					if(checkdate($mois,$jour,$annee)){
						$this->value=$annee."-".$mois."-".$jour;
					}
					else{
						$secure=false;
					}
				break;
			}
			return $secure;
		}
		
		//true si POST rempli quand required = true si POST vide renvoi false
		//si required = false renvoi toujours true
		public function testRequired(){
			$retour = true;
			if($this->required == true){
				if(!isset($_POST[$this->name]) || empty($_POST[$this->name])){
					$retour = false;
				}
			}
			return $retour;
		}
	}