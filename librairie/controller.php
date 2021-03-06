<?php
	require_once('librairie/request.php');
	require_once('librairie/view.php');

	abstract class Controller{
		/**
		* Objet de vue
		* @var mixed
		*/
		protected $view;
		/**
		* Requ�te utilis� pour atteindre le controller
		* @var Pry\Net\Request
		*/
		protected $request;
		/**
		* Instanciation du controller
		* @param Net_Request $requete Requ�te utilis�
		* @param string $codeLangue Code langue. par d�faut d�fini � fr
		*/
		public function __construct($requete){
			$this->request = new Request($requete);
		}
		/**
		* Redirection
		* @param string $url
		*/
		public function redirect($url){
			header('Location: ' . $url);
			exit;
		}
		public function setView($view){
			$this->view = $view;
		}
	}