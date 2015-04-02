<?php
	class View{
		/** Ne pas echapper la variable */
		const NO_ESCAPE = 1;
		/**
		* Ensemble des variables utilisable dans la vue
		* @var array
		*/
		protected $variables = array();
		/**
		* Dossier o� sont situer les vues
		* @var string
		*/
		protected $viewFolder;
		/**
		* Fichier vue � charger
		* @var string
		*/
		protected $view;
		public function __construct()
		{
		}
		/**
		* D�fini le dossier de base contenant les vues
		* @param string $path
		* @throws InvalidArgumentException Si le dossier n'existe pas
		*/
		public function setViewBase($path)
		{
		if (!file_exists($path))
		throw new \InvalidArgumentException('Can\'t find ' . $path . 'folder');
		$this->viewFolder = $path;
		}
		/**
		* D�fini la vue � charger
		* @param string $filePath Chemin dans le dossier des vue
		* @throws BadMethodCallException Si le dossier de base des vues n'est pas d�fini
		* @throws InvalidArgumentException Si la vue n'existe pas
		*/
		public function load($filePath)
		{
		if (empty($this->viewFolder))
		throw new \BadMethodCallException('No view base defined.You should call setViewBase First.');
		$this->view = $filePath;
		if (!file_exists($this->viewFolder . $this->view))
		throw new \InvalidArgumentException('Can\'t find the ' . $this->view . 'view');
		}
		/**
		* D�fini une variable de vue. La variable sera ensuite utilisable dans la vue via sa cl�
		* @param string $key
		* @param mixed $value
		* @param int $option
		*/
		public function set($key, $value, $option = null)
		{
		if ($option === self::NO_ESCAPE)
		$this->variables[$key] = $value;
		else
		$this->variables[$key] = htmlspecialchars($value, ENT_QUOTES);
		}
		/**
		* R�cup�re une variable de vue
		* @param type $key
		* @return type
		* @throws InvalidArgumentException Si la cl� n'existe pas
		*/
		public function get($key)
		{
		if (!array_key_exists($key, $this->variables))
		throw new \InvalidArgumentException('No value for this key');
		return $this->variables[$key];
		}
		/**
		* Raccourcis pour d�finir une variable de vue.
		* Cette variable sera forc�ment �chap�e � l'affichage
		* @param type $name
		* @param type $value
		*/
		public function __set($name, $value)
		{
		$this->set($name, $value, null);
		}
		/**
		* Raccourcis pour r�cup�rer une variable de vue
		* @param type $name
		*/
		public function __get($name)
		{
		$this->get($name);
		}
		/**
		* Affiche la vue
		* @throws BadMethodCallException Si la vue n'as pas �t� charg�e
		*/
		public function render()
		{
		if (empty($this->viewFolder))
		throw new \BadMethodCallException('PLease call load() before render()');
		extract($this->variables);
		include_once $this->viewFolder . $this->view;
		}
	}