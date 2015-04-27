<?php
	session_start();

	class request{
		private $headers;
		private $get;
		private $post;
		private $cookie;
		private $request;
		private $param;
		private $file;
		private $defaultMethod = 'post';
		public function __construct($params){
			$this->get = $_GET;
			$this->post = $_POST;
			$this->cookie = $_COOKIE;
			$this->file = $_FILES;
			$this->request = $_REQUEST;
			$this->param = $params;
		}
		/**
		* Réinitialise l'objet request
		*/
		public function reset()
		{
			$this->get = $_GET;
			$this->post = $_POST;
			$this->cookie = $_COOKIE;
			$this->file = $_FILES;
			$this->request = $_REQUEST;
			$this->headers = null;
			$this->param = null;
		}
		/**
		* Récupère une variable $_SERVER
		* @param string $name Nom de la variable à récupérer. Si null la totalité des variables sera retournée
		* @return mixed Retourne une string en cas de valeur unique un array sinon
		*/
		public function getServer($name = null){
			if (!empty($name))
			return (isset($_SERVER[$name])) ? $_SERVER[$name] : null;
			return $_SERVER;
		}
		/**
		* Retourne un paramètre de la requête.
		* @param string $name Nom du paramètre
		* @param string $type Type de requête. Peut être get|post|request|cookie
		* @return mixed
		*/
		public function getParam($name, $type = null){
			$type = empty($type) ? $this->defaultMethod : strtolower($type);
			if (!$this->isValidMethod($type))
			throw new \InvalidArgumentException('Type de paramètre invalide');
			return (isset($this->{$type}[$name])) ? $this->{$type}[$name] : null;
		}
		//récupère un paramètre de param
		public function getParams($name){
		$retour = null;
			if(isset($this->post[$name])){
				$retour = $this->param[$name];
			}
			return $retour;	
		}
		/**
		* Récupère une valeur POST
		* @param string $name Nom de la valeur POST
		* @param string $dataType Type de données pour appliquer un filtres.
		* @param mixed $flag Flag optionnel à utiliser pour le filtre
		* Types autorisés int,float,string,email,url,ip
		* @return mixed
		*/
		public function getPost($name){
			$retour = null;
			if(isset($this->post[$name])){
				$retour = $this->post[$name];
			}
			return $retour;
		}
		/**
		* Récupère une valeur GET
		* @param string $name Nom de la valeur GET
		* @param string $dataType Type de données pour appliquer un filtres.
		* Types autorisés int,float,string,email,url,ip
		* @return mixed
		*/
		public function get($name){
			$retour = null;
			if(isset($this->post[$name])){
				$retour = $this->get[$name];
			}
			return $retour;
		}
		/**
		* Récupère une variable d'environnement
		* @param string $name
		*/
		public function getEnv($name){
			return getenv($name);
		}
		/**
		* Retourne la variable $_FILES demandé
		* @param string $name nom du file
		* @return array
		*/
		public function getFile($name){
			return isset($this->file[$name]) ? $this->file[$name] : null;
		}
		/**
		* Retourne $_FILES
		* @return array
		*/
		public function getFiles(){
			return $this->file;
		}
		/**
		* Vérifie si la requête est de type post
		* @return boolean
		*/
		public function isPost(){
			if($this->getServer('REQUEST_METHOD') == 'POST') {
			return true;
			}
			return false;
		}
		/**
		* Vérifie si la requête est de type get
		* @return boolean
		*/
		public function isGet(){
			if($this->getServer('REQUEST_METHOD') == 'GET') {
			return true;
			}
			return false;
		}
		/**
		* Vérifie si la requête est de type Ajax.
		* Cet header est en général fourni par tous les FW js mais peut cependant
		* être absent dans certains cas.
		* @return boolean
		*/
		public function isXmlHttpRequest(){
			$xhttp = $this->getServer('HTTP_X_REQUESTED_WITH');
			if(!empty($xhttp) && strtolower($xhttp) == 'xmlhttprequest') {
			return true;
			}
			return false;
		}
		/**
		* Vérifie la validité de la méthode demandé
		* @param string $method
		* @return boolean
		*/
		protected function isValidMethod($method){
			return in_array($method, array('get', 'post', 'request', 'cookie', 'put', 'delete'));
		}
	}	