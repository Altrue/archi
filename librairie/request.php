<?php
	class request{
		protected $headers;
		protected $get;
		protected $post;
		protected $put;
		protected $delete;
		protected $cookie;
		protected $request;
		protected $file;
		protected $filters;
		protected $defaultMethod = 'request';
		public function __construct()
		{
		$this->get = $_GET;
		$this->post = $_POST;
		$this->cookie = $_COOKIE;
		$this->file = $_FILES;
		$this->request = $_REQUEST;
		if($this->isPut())
		parse_str(file_get_contents("php://input"),$this->put);
		if($this->isDelete())
		parse_str(file_get_contents("php://input"),$this->delete);
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
		if($this->isPut())
		parse_str(file_get_contents("php://input"),$this->put);
		if($this->isDelete())
		parse_str(file_get_contents("php://input"),$this->delete);
		}
		/**
		* Retourne l'ensemble des ent�tes de la requ�te
		* @return array
		*/
		public function getHeaders()
		{
		if (empty($this->headers))
		$this->headers = $this->getAllHeaders();
		return $this->headers;
		}
		/**
		* Retourne un header en particulier
		* @param string $name Nom du header
		* @return string Valeur du header ou null si l'ent�te n'existe pas.
		*/
		public function getHeader($name)
		{
		$this->getHeaders();
		return (isset($this->headers[$name])) ? $this->headers[$name] : null;
		}
		/**
		* R�cup�re une variable $_SERVER
		* @param string $name Nom de la variable � r�cup�rer. Si null la totalit� des variables sera retourn�e
		* @return mixed Retourne une string en cas de valeur unique un array sinon
		*/
		public function getServer($name = null)
		{
		if (!empty($name))
		return (isset($_SERVER[$name])) ? $_SERVER[$name] : null;
		return $_SERVER;
		}
		/**
		* Retourne un param�tre de la requ�te. Le param�tres pourra �tre filtr� si des filtres ont �t� d�fini
		* @param string $name Nom du param�tre
		* @param string $type Type de requ�te. Peut �tre get|post|request|cookie
		* @return mixed
		*/
		public function getParam($name, $type = null)
		{
		$type = empty($type) ? $this->defaultMethod : strtolower($type);
		if (!$this->isValidMethod($type))
		throw new \InvalidArgumentException('Type de param�tre invalide');
		if (!empty($this->filters[$type]) && $this->filters[$type]['isFiltered'] == false)
		$this->applyFilters($type);
		return (isset($this->{$type}[$name])) ? $this->{$type}[$name] : null;
		}
		/**
		* Retourne l'ensemble des pram�tres de type $type
		* @param string $type Peut �tre get|post|request|cookie
		* @return array
		* @throws InvalidArgumentException
		*/
		public function getParams($type = null)
		{
		$type = empty($type) ? $this->defaultMethod : strtolower($type);
		if (!$this->isValidMethod($type))
		throw new \InvalidArgumentException('Type de param�tre invalide');
		if (!empty($this->filters[$type]) && $this->filters[$type]['isFiltered'] == false)
		$this->applyFilters($type);
		return $this->$type;
		}
		/**
		* R�cup�re une valeur POST
		* @param string $name Nom de la valeur POST
		* @param string $dataType Type de donn�es pour appliquer un filtres.
		* @param mixed $flag Flag optionnel � utiliser pour le filtre
		* Types autoris�s int,float,string,email,url,ip
		* @return mixed
		*/
		public function getPost($name, $dataType = null,$flag = null)
		{
		return $this->getWithFilter($name, 'post', $dataType, $flag);
		}
		/**
		* R�cup�re une valeur PUT
		* @param string $name Nom de la valeur PUT
		* @param string $dataType Type de donn�es pour appliquer un filtres.
		* @param mixed $flag Flag optionnel � utiliser pour le filtre
		* Types autoris�s int,float,string,email,url,ip
		* @return mixed
		*/
		public function getPut($name, $dataType = null,$flag = null)
		{
		return $this->getWithFilter($name, 'put', $dataType, $flag);
		}
		/**
		* R�cup�re une valeur PUT
		* @param string $name Nom de la valeur PUT
		* @param string $dataType Type de donn�es pour appliquer un filtres.
		* @param mixed $flag Flag optionnel � utiliser pour le filtre
		* Types autoris�s int,float,string,email,url,ip
		* @return mixed
		*/
		public function getDelete($name, $dataType = null,$flag = null)
		{
		return $this->getWithFilter($name, 'delete', $dataType, $flag);
		}
		/**
		* R�cup�re une valeur GET
		* @param string $name Nom de la valeur GET
		* @param string $dataType Type de donn�es pour appliquer un filtres.
		* Types autoris�s int,float,string,email,url,ip
		* @return mixed
		*/
		public function get($name, $dataType = null,$flag = null)
		{
		return $this->getWithFilter($name, 'get', $dataType, $flag);
		}
		/**
		* R�cup�re une variable d'environnement
		* @param string $name
		*/
		public function getEnv($name)
		{
		return getenv($name);
		}
		/**
		* Retourne la variable $_FILES demand�
		* @param string $name nom du file
		* @return array
		*/
		public function getFile($name)
		{
		return isset($this->file[$name]) ? $this->file[$name] : null;
		}
		/**
		* Retourne $_FILES
		* @return array
		*/
		public function getFiles()
		{
		return $this->file;
		}
		/**
		* Ajoute un filtre � appliquer lors de la r�cup�ration de param�tre.
		* <code>
		* setFilter(
		* array(
		* 'id' => FILTER_SANITIZE_NUMBER_INT,
		* 'nom'=> FILTER_SANITIZE_STRING
		* ),'post'
		* );
		* </code>
		* @param array $filtre Description du filtre. Doit �tre compatible avec filter_var_array
		* @param string $type Le type de requ�te
		* @see http://github.com/bdelespierre/php-axiom/tree/master/libraries/axiom/axRequest.class.php
		* @see http://php.net/manual/fr/function.filter-var-array.php
		* @return \Controller_Request
		* @throws InvalidArgumentException En cas de type invalide
		*/
		public function setFilter(array $filtre, $type = null)
		{
		$type = empty($type) ? $this->defaultMethod : strtolower($type);
		if (!$this->isValidMethod($type))
		throw new \InvalidArgumentException('Type de param�tre invalide');
		$this->filters[$type] = array(
		'filter' => $filtre,
		'isFiltered' => false
		);
		return $this;
		}
		/**
		* D�fini la m�thode par d�faut � utiliser. request est utilis� de base.
		* Cela agit directement sur les m�thode getParam() , getParams() , setFilter() , quand le
		* param�tre de m�thode n'est pas fournit
		* @param string $name Nom de la m�thode parmis get|post|cookie|request
		*/
		public function setDefaultMethod($name)
		{
		$this->defaultMethod = strtolower($name);
		}
		public function __get($name)
		{
		return $this->getParam($name);
		}
		public function __isset($name)
		{
		$tmp = $this->getParam($name);
		return isset($tmp);
		}
		/**
		* Ajoute un param�tre � la requ�te
		* @param mixed $params Valeur � ajouter
		* @param string [$type] Type de requ�te
		*/
		public function add($params, $type = null)
		{
		$type = empty($type) ? $this->defaultMethod : strtolower($type);
		$this->{$type} = array_merge($this->{$type}, $params);
		if (isset($this->filters[$type]))
		$this->filters[$type]['isFiltered'] = false;
		}
		/**
		* V�rifie si la requ�te est de type post
		* @return boolean
		*/
		public function isPost()
		{
		if($this->getServer('REQUEST_METHOD') == 'POST') {
		return true;
		}
		return false;
		}
		/**
		* V�rifie si la requ�te est de type put
		* @return boolean
		*/
		public function isPut()
		{
		if($this->getServer('REQUEST_METHOD') == 'PUT') {
		return true;
		}
		return false;
		}
		/**
		* V�rifie si la requ�te est de type Delete
		* @return boolean
		*/
		public function isDelete()
		{
		if($this->getServer('REQUEST_METHOD') == 'DELETE') {
		return true;
		}
		return false;
		}
		/**
		* V�rifie si la requ�te est de type get
		* @return boolean
		*/
		public function isGet()
		{
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
		public function isXmlHttpRequest()
		{
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
		protected function isValidMethod($method)
		{
		return in_array($method, array('get', 'post', 'request', 'cookie', 'put', 'delete'));
		}
		/**
		* Applique les filtres d�fini
		* @param string $type le type de requ�te
		* @return boolean
		* @throws RuntimeException Si les filtres �choue
		*/
		protected function applyFilters($type)
		{
		if (empty($this->filters[$type]) || empty($this->$type))
		return false;
		$this->$type = filter_var_array($this->$type, $this->filters[$type]['filter']);
		if (!$this->$type)
		throw new \RuntimeException('Filtres invalide');
		$this->filters['isFiltered'] = true;
		}
		/**
		* R�cup�re un param�tre en appliquant un filtres particulier
		* @param string $name Nom du param�tre
		* @param string $type Type de param�tre
		* @param string $dataType Type de donn�es attendu
		* @param mixed $flag Flag optionnel � utiliser
		*/
		protected function getWithFilter($name, $type, $dataType,$flag = null)
		{
		$type = empty($type) ? $this->defaultMethod : strtolower($type);
		if (isset($this->{$type}[$name]))
		{
		switch ($dataType)
		{
		case 'int' :
		return intval($this->{$type}[$name]);
		case 'float' :
		return floatval($this->{$type}[$name]);
		case 'string' :
		$str = filter_var($this->{$type}[$name], FILTER_SANITIZE_STRING,$flag);
		return ($str != false) ? $str : null;
		case 'email' :
		$str = filter_var($this->{$type}[$name], FILTER_VALIDATE_EMAIL,$flag);
		return ($str != false) ? $str : null;
		case 'url' :
		$str = filter_var($this->{$type}[$name], FILTER_VALIDATE_URL,$flag);
		return ($str != false) ? $str : null;
		case 'ip' :
		$str = filter_var($this->{$type}[$name], FILTER_VALIDATE_IP,$flag);
		return ($str != false) ? $str : null;
		default :
		return $this->{$type}[$name];
		}
		}
		else
		{
		return null;
		}
		}
		private function getAllHeaders()
		{
		if (!function_exists('getallheaders'))
		{
		$headers = '';
		foreach ($_SERVER as $name => $value)
		{
		if (substr($name, 0, 5) == 'HTTP_')
		{
		$headers[str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))))] = $value;
		}
		}
		return $headers;
		}
		else
		{
		return getallheaders();
		}
	}
