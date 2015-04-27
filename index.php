<?php
	require 'librairie/Router.class.php';
	 
	$router = Router::getInstance();
	//Définition du dossier contenant les controlleur
	$router->setPath('controller/');
	// Si aucun controller n'est spécifié on appèlera indexController et sa méthode index()
	$router->setDefaultControllerAction('indexController','indexAction');
	// En cas d'url invalid on appèlera le controller errorController et sa méthode index()
	$router->setErrorControllerAction('errorController', 'indexAction');
	// L'url http://monsite.com/actualites/archives/2012/01/PHP sera redirigé vers
	// actualitesController et sa méthode index(). Les paramètres annee, mois , catégorie seront passer au controller par le routeur.
	//$router->addRule('actualites/archives/:annee/:mois/:categorie', array('controller' => 'actualites', 'action' => 'index'));
	$router->addRule('list/:page', array('controller' => 'tzController', 'action' => 'indexAction'));
	$router->addRule('grid/:page', array('controller' => 'tzController', 'action' => 'indexAction'));
	$router->addRule('deco', array('controller' => 'indexController', 'action' => 'logoutAction'));
	$router->load();