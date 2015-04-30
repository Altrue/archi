<?php
	require 'librairie/Router.class.php';
	 
	$router = Router::getInstance();
	//D�finition du dossier contenant les controlleur
	$router->setPath('controller/');
	// Si aucun controller n'est sp�cifi� on app�lera indexController et sa m�thode index()
	$router->setDefaultControllerAction('IndexController','indexAction');
	// En cas d'url invalid on app�lera le controller errorController et sa m�thode index()
	$router->setErrorControllerAction('ErrorController', 'indexAction');
	// L'url http://monsite.com/actualites/archives/2012/01/PHP sera redirig� vers
	// actualitesController et sa m�thode index(). Les param�tres annee, mois , cat�gorie seront passer au controller par le routeur.
	//$router->addRule('actualites/archives/:annee/:mois/:categorie', array('controller' => 'actualites', 'action' => 'index'));
	$router->addRule(':list', array('controller' => 'TzController', 'action' => 'indexAction'));
	$router->addRule(':grid', array('controller' => 'TzController', 'action' => 'indexAction'));
	$router->addRule(':deco', array('controller' => 'IndexController', 'action' => 'logoutAction'));
	$router->addRule(':add', array('controller' => 'TzController', 'action' => 'listAllTzAction'));
	$router->addRule(':ajout', array('controller' => 'TzController', 'action' => 'addTzAction'));
	$router->addRule(':delete', array('controller' => 'TzController', 'action' => 'deleteTzAction'));
	$router->addRule(':nolog', array('controller' => 'IndexController', 'action' => 'indexAction'));
	$router->load();