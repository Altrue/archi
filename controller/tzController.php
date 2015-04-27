<?php
	session_start();

	require_once('librairie/formulaire.php');
	require_once('librairie/session.php');
	require_once('helper/userDao.php');
	require_once('helper/tzDao.php');
	require_once('helper/zoneUserDao.php');
	require_once('librairie/ControllerInterface.php');
	require_once('librairie/Controller.php');
	
	class tzController extends Controller implements ControllerInterface{
		
		//liste les timezones sélectionnées
		public function indexAction(){
			$co = new connectDB();
			$pdo = $co->connectBase();
			$userDAO = new userDao();
			$user = $userDAO->findUserByLog($pdo, unserialize($_SESSION['user'])->getLoginUser());
			$zone = new zoneUserDao();
			$zone->findByUser($pdo, $user);
			unset($pdo);
			$view = new View('views/');
			$tabServer = explode('/',$this->request->getServer('REQUEST_URI'));
			if(in_array('grid', $tabServer)){
				$view->load('grid.php');
			}
			else{
				$view->load('list.php');
			}
			$view->set('liste',$user->getListTz(),1);
			$view->render();
		}
		
		//ajoute une timezone
		public function addTzAction(){
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
		public function deleteTzAction(){
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
		
		//liste toutes les timezones sélectionnable
		public function listAllTzAction(){
			$co = new connectDB();
			$pdo = $co->connectBase();
			$tzDAO = new tzDao();		
			$view = new View('views/');
			$view->load('add.php');
			$view->set('liste',$tzDAO->findAllTz($pdo),1);
			unset($pdo);
			$view->render();
		}
	}