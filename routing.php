<?php
	require 'Router.class.php';
	 
	$router = Router::getInstance();
	//Définition du dossier contenant les controlleur
	$router->setPath('controleur/');
	// Si aucun controller n'est spécifié on appèlera accueilController et sa méthode index()
	$router->setDefaultController('index','index');
	// En cas d'url invalid on appèlera le controller errorController et sa méthode alert()
	$router->setErrorControllerAction('error', 'alert');
	// L'url http://monsite.com/actualites/archives/2012/01/PHP sera redirigé vers
	// actualitesController et sa méthode index(). Les paramètres annee, mois , catégorie seront passer au controller par le routeur.
	$router->addRule('actualites/archives/:annee/:mois/:categorie', array('controller' => 'actualites', 'action' => 'index'));
	$router->load();