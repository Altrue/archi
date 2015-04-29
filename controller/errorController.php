<?php
	require_once('librairie/ControllerInterface.php');
	require_once('librairie/controller.php');
	
	class ErrorController extends Controller implements ControllerInterface{
		
		public function indexAction(){
			$view = new View('views/');
			$view->load('notFound404.php');
			$view->render();
		}
	}