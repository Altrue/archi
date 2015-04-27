<?php	
	require_once('librairie/collection.php');
	require_once('librairie/input.php');
	class formulaire {
		//attributs
		private $name;
		private $method;
		private $collectionInput;
		
		//m�thodes
		//constructeur
		public function __construct($name,$method){
			$this->name=$name;
			if($method=="POST" || $method=="GET"){
				$this->method=$method;
			}
			else{
				throw new Exception('Type du param�tre method invalide !');
			}
			$this->collectionInput = new collection();
		}
		
		//get
		public function getName(){
			return $this->name;
		}
		public function getMethod(){
			return $this->method;
		}
		public function getCollectionInput(){
			return $this->collectionInput;
		}
		
		//ajoute un input � la collection et uniquement un input
		public function addInput($input){
			if(is_a($input,'input')){
				$this->collectionInput->addObjet($input);
			}
			else{
				throw new Exception('Type du param�tre invalide !');
			}
		}
		
		//s�lectionne la valeur d'un input par son nom
		//renvoi null si rien est trouv� sinon renvoi la valeur de l'input
		public function selectInputValue($name){
			$retour = null;
			foreach ($this->collectionInput->getListObjet() as $value){
				if($value->getName() == $name){
					$retour = $value->getValue();
					break;
				}
			}
			return $retour;
		}
		
		//v�rifie la validit� de tous les champs du formulaire et le s�curise
		//v�rifie �galement que le formulaire a bien �t� pass� en POST (pas pris en compte le GET)
		// !!! Si des champs SIRET et SIREN ont �t� ajout� alors le champs SIRET devra �tre instanci� avant le champs SIREN !!!
		//renvoi true si valide sinon false
		public function isValid(){
			$valid=false;
			$siret="";
			if($this->collectionInput->getCount()>0){
				foreach ($this->collectionInput->getListObjet() as $value){
					if($value->testRequired()){
						$valid=$value->secureValue();
					}
					if($value->getType()=="siret"){
						$siret = $value->getValue();
					}
					elseif($value->getType()=="siren"){
						if($siret!="" && substr($siret,0,9)!=$value->getValue()){
							$valid = false;
						}
					}
					if($valid==false){
						break;
					}
				}
			}
			return $valid;
		}
	}