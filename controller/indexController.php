<?php
	session_start();

	require_once('librairie/formulaire.php');
	require_once('librairie/session.php');
	require_once('librairie/controller.php');
	require_once('librairie/connectDBClass.php');
	require_once('librairie/ControllerInterface.php');
	
	class IndexController extends Controller implements ControllerInterface{
		
		public function indexAction(){
			$err = null;
			$var = $this->request->getPost('connexion');
			if(isset($var) && !isset($_SESSION['user'])){
				$formConnexion = new Formulaire('connexion','POST');
				$formConnexion->addInput(new Input('login','text',$this->request->getPost('login'),null,100,true));
				$formConnexion->addInput(new Input('mdp','password',$this->request->getPost('mdp'),null,null,true));
				if($formConnexion->isValid()){
					$session = new Session($formConnexion->selectInputValue('login'));
					$c = $session->connectUtilisateur($formConnexion->selectInputValue('mdp'));
					if($c != 1){
						$err = "errL";
					}
					else{
						$this->redirect('list');
					}
				}
				else{
					$err = "errS";
				}
			}
			if(isset($_SESSION['user'])){
				$this->redirect('list');
			}
			$view = new View('views/');
			$view->load('index.php');
			$view->set('message',$err);
			$view->render();
		}
		
		public function logoutAction(){
			$view = new View('views/');
			$view->load('index.php');
			$mess = null;
			if(isset($_SESSION['user'])){
				unset($_SESSION['user']);
				session_destroy();
				$mess = 'deco';
			}
			$view->set('message',$mess);
			$view->render();
		}
	}