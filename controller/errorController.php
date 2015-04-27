<?php
	require_once('librairie/ControllerInterface.php');
	require_once('librairie/Controller.php');
	
	class errorController extends Controller implements ControllerInterface{
		
		public function indexAction(){
			header("HTTP/1.0 404 Not Found");
		}
	}