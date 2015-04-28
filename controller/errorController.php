<?php
	require_once('librairie/ControllerInterface.php');
	require_once('librairie/controller.php');
	
	class ErrorController extends Controller implements ControllerInterface{
		
		public function indexAction(){
			header("HTTP/1.0 404 Not Found");
		}
	}