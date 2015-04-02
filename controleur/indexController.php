<?php
	require_once('/librairie/formulaire.php');
	require_once('/librairie/session.php');
	require_once('/librairie/connectDBClass.php');
	class indexController {
	
		private $view;
		
		public function loginAction(){
			if(isset($_POST['connexion'])){
				$formConnexion = new formulaire('connexion','POST');
				$formConnexion->addInput(new input('login','text',$_POST['login'],null,100,true));
				$formConnexion->addInput(new input('mdp','password',$_POST['mdp'],null,null,true));
				if($formConnexion->isValid()){
					$session = new session($formConnexion->selectInputValue('login'));
					$c = $session->connectUtilisateur($formConnexion->selectInputValue('mdp'));
					if($c != 1){
						echo "login ou mot de passe incorrect";
					}
					else{
						//connecté
					}
				}
				else{
					echo "erreur de saisie";
				}
			}
		}
		
		public function logoutAction(){
			if(isset($_SESSION['user'])){
				unset($_SESSION['user']);
				session_destroy();
			}
		}
	}