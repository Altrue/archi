<?php
	require 'librairie/Router.class.php';
	 
	$router = Router::getInstance();
	//D�finition du dossier contenant les controlleur
	$router->setPath('controller/');
	// Si aucun controller n'est sp�cifi� on app�lera indexController et sa m�thode index()
	$router->setDefaultControllerAction('indexController','indexAction');
	// En cas d'url invalid on app�lera le controller errorController et sa m�thode index()
	$router->setErrorControllerAction('errorController', 'indexAction');
	// L'url http://monsite.com/actualites/archives/2012/01/PHP sera redirig� vers
	// actualitesController et sa m�thode index(). Les param�tres annee, mois , cat�gorie seront passer au controller par le routeur.
	//$router->addRule('actualites/archives/:annee/:mois/:categorie', array('controller' => 'actualites', 'action' => 'index'));
	$router->addRule('list/:page', array('controller' => 'tzController', 'action' => 'indexAction'));
	$router->addRule('grid/:page', array('controller' => 'tzController', 'action' => 'indexAction'));
	$router->addRule('deco', array('controller' => 'indexController', 'action' => 'logoutAction'));
	$router->load();