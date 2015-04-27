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
		* R�initialise l'objet request
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
		* R�cup�re une variable $_SERVER
		* @param string $name Nom de la variable � r�cup�rer. Si null la totalit� des variables sera retourn�e
		* @return mixed Retourne une string en cas de valeur unique un array sinon
		*/
		public function getServer($name = null){
			if (!empty($name))
			return (isset($_SERVER[$name])) ? $_SERVER[$name] : null;
			return $_SERVER;
		}
		/**
		* Retourne un param�tre de la requ�te.
		* @param string $name Nom du param�tre
		* @param string $type Type de requ�te. Peut �tre get|post|request|cookie
		* @return mixed
		*/
		public function getParam($name, $type = null){
			$type = empty($type) ? $this->defaultMethod : strtolower($type);
			if (!$this->isValidMethod($type))
			throw new \InvalidArgumentException('Type de param�tre invalide');
			return (isset($this->{$type}[$name])) ? $this->{$type}[$name] : null;
		}
		//r�cup�re un param�tre de param
		public function getParams($name){
		$retour = null;
			if(isset($this->post[$name])){
				$retour = $this->param[$name];
			}
			return $retour;	
		}
		/**
		* R�cup�re une valeur POST
		* @param string $name Nom de la valeur POST
		* @param string $dataType Type de donn�es pour appliquer un filtres.
		* @param mixed $flag Flag optionnel � utiliser pour le filtre
		* Types autoris�s int,float,string,email,url,ip
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
		* R�cup�re une valeur GET
		* @param string $name Nom de la valeur GET
		* @param string $dataType Type de donn�es pour appliquer un filtres.
		* Types autoris�s int,float,string,email,url,ip
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
		* R�cup�re une variable d'environnement
		* @param string $name
		*/
		public function getEnv($name){
			return getenv($name);
		}
		/**
		* Retourne la variable $_FILES demand�
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
		* V�rifie si la requ�te est de type post
		* @return boolean
		*/
		public function isPost(){
			if($this->getServer('REQUEST_METHOD') == 'POST') {
			return true;
			}
			return false;
		}
		/**
		* V�rifie si la requ�te est de type get
		* @return boolean
		*/
		public function isGet(){
			if($this->getServer('REQUEST_METHOD') == 'GET') {
			return true;
			}
			return false;
		}
		/**
		* V�rifie si la requ�te est de type Ajax.
		* Cet header est en g�n�ral fourni par tous les FW js mais peut cependant
		* �tre absent dans certains cas.
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
		* V�rifie la validit� de la m�thode demand�
		* @param string $method
		* @return boolean
		*/
		protected function isValidMethod($method){
			return in_array($method, array('get', 'post', 'request', 'cookie', 'put', 'delete'));
		}
	}	