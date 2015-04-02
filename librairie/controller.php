<?php
	abstract class controller{
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
		* Langue d�tect�e dans l'URL. Code sur deux lettre
		* @var string
		*/
		protected $codeLangue;
		/**
		* Instanciation du controller
		* @param Net_Request $requete Requ�te utilis�
		* @param string $codeLangue Code langue. par d�faut d�fini � fr
		*/
		public function __construct($requete, $codeLangue = 'fr'){
			$this->request = $requete;
			$this->codeLangue = $codeLangue;
		}
		/**
		* Redirection
		* @param string $url
		*/
		public function redirect($url){
			header('Location: /' . $url);
			exit;
		}
		public function setView($view){
			$this->view = $view;
			if ($this->view instanceof Pry\View\View)
			$this->view->controller = $this->request->controller;
		}
		abstract public function index();
	}