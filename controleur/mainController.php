<?php
	require_once('../librairie/connectDBClass.php');
	require_once('../librairie/formulaire.php');
	require_once('../librairie/session.php');
	require_once('../helper/userDao.php');
	require_once('../helper/tzDao.php');
	require_once('../helper/zoneUserDao.php');
	
	class mainController {
		
		// public static function loginAction(){
			// if(isset($_POST['connexion'])){
				// $formConnexion = new formulaire('connexion','POST');
				// $formConnexion->addInput(new input('login','text',$_POST['login'],null,100,true));
				// $formConnexion->addInput(new input('mdp','password',$_POST['mdp'],null,null,true));
				// if($formConnexion->isValid()){
					// $session = new session($formConnexion->selectInputValue('login'));
					// $c = $session->connectUtilisateur($formConnexion->selectInputValue('mdp'));
					// if($c != 1){
						// echo "login ou mot de passe incorrect";
					// }
					// else{
						//connecté
					// }
				// }
				// else{
					// echo "erreur de saisie";
				// }
			// }
		// }
		
		// public static function logoutAction(){
			// if(isset($_SESSION['user'])){
				// unset($_SESSION['user']);
				// session_destroy();
			// }
		// }
		
		//ajoute une timezone
		public static function addTzAction($tzId){
			$co = new connectDB();
			$pdo = $co->connectBase();
			$tzDAO = new tzDao();
			$tz = $tzDAO->findTzById($pdo, $tzId);
			$userDAO = new userDao();
			$user = $userDAO->findUserByLog($pdo, unserialize($_SESSION['user'])->getLoginUser());
			$zone = new zoneUserDao();
			$zone->findByUser($pdo, $user);
			$zone->insertZone($pdo, $user, $tz);
			unset($pdo);
		}
		
		//supprime une timezone
		public static function deleteTzAction($tzId){
			$co = new connectDB();
			$pdo = $co->connectBase();
			$tzDAO = new tzDao();
			$tz = $tzDAO->findTzById($pdo, $tzId);
			$userDAO = new userDao();
			$user = $userDAO->findUserByLog($pdo, unserialize($_SESSION['user'])->getLoginUser());
			$zone = new zoneUserDao();
			$zone->findByUser($pdo, $user);
			$zone->deleteZone($pdo, $user, $tz);
			unset($pdo);
		}
		
		//liste les timezones sélectionnées
		public static function selectTzAction(){
			$co = new connectDB();
			$pdo = $co->connectBase();
			$userDAO = new userDao();
			$user = $userDAO->findUserByLog($pdo, unserialize($_SESSION['user'])->getLoginUser());
			$zone = new zoneUserDao();
			$zone->findByUser($pdo, $user);
			return $user->getListTz();
			unset($pdo);
		}
		
		//liste toutes les timezones sélectionnable
		public static function listAllTzAction(){
			$co = new connectDB();
			$pdo = $co->connectBase();
			$tzDAO = new tzDao();
			return $tzDAO->findAllTz($pdo);
			unset($pdo);
		}
	}