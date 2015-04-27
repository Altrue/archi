<?php
	require_once('../librairie/formulaire.php');
	require_once('../librairie/session.php');
	require_once('../librairie/connectDBClass.php');
	require_once('../librairie/ControllerInterface.php');
	
	class indexController extends Controller implements ControllerInterface{
		
		public function indexAction(){
			$err = null;
			if(isset($this->request->getPost('connexion'))){
				$formConnexion = new formulaire('connexion','POST');
				$formConnexion->addInput(new input('login','text',$this->request->getPost('login'),null,100,true));
				$formConnexion->addInput(new input('mdp','password',$this->request->getPost('mdp'),null,null,true));
				if($formConnexion->isValid()){
					$session = new session($formConnexion->selectInputValue('login'));
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
			$view = new view('../views/');
			$view->load('index.php');
			$view->set('message',$err);
			$view->render();
		}
		
		public function logoutAction(){
			if(isset($_SESSION['user'])){
				unset($_SESSION['user']);
				session_destroy();
				$view = new view('../views/');
				$view->load('index.php');
				$view->set('message','deco');
				$view->render();
			}
		}
	}