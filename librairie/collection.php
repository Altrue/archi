<?php
	require_once('connectDBClass.php');
	class collection {
		//attributs
		private $listObjet;
		private $countObjet;
		//méthodes
		//constructeur
		public function __construct(){
			$this->listObjet = array();
			$this->countObjet = 0;
		}
		//get
		public function getListObjet(){
			return $this->listObjet;
		}
		public function getCount(){
			return $this->countObjet;
		}
		//set
		//permet d'assigner un tableau à la liste en indiquant le nombre d'objet au paramètre count
		public function setListObjet($valeur){
			if(is_array($valeur)){
				$this->listObjet = $valeur;
				$this->countObjet = count($valeur);
			}
			else{
				throw new Exception('Paramètres invalide !');
			}
		}
		//ajouter un objet
		public function addObjet($objet){
			$this->listObjet[] = $objet;
			$this->countObjet++;
		}
		//supprimer un l'objet à l'index $index
		public function supprObjet($index){
			if (is_int($index) && $this->listObjet[$index]!=null){
				unset($this->listObjet[$index]);
				$this->listObjet = array_values($this->listObjet);
				$this->countObjet--;
			}
			else{
				throw new Exception('Paramètres invalides !');
			}
		}
	}