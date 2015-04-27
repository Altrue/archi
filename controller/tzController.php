<?php
	require_once('../librairie/formulaire.php');
	require_once('../librairie/session.php');
	require_once('../helper/userDao.php');
	require_once('../helper/tzDao.php');
	require_once('../librairie/ControllerInterface.php');
	
	class tzController extends Controller implements ControllerInterface{
		
		//liste les timezones sélectionnées
		public function indexAction(){
			$userDAO = new userDao();
			$user = $userDAO->findUserByLog($_SESSION['loginUser']);
			$zone = new zoneUserDao();
			$zone->findByUser($user);
			$view = new view('../views/');
			if($this->request->get('page') == 'grid'){
				$view->load('grid.php');
			}
			else{
				$view->load('list.php');
			}
			$view->set('liste',$user->getListTz());
			$view->render();
		}
		
		//ajoute une timezone
		public function addTzAction(){
			$tzDAO = tzDao::getInstance();
			$tz = $tzDAO->findTzById($this->request->getPost('tzId'));
			$userDAO = userDao::getInstance();
			$user = $userDAO->findUserByLog($_SESSION['loginUser']);
			$zone = zoneUserDao::getInstance();
			$zone->findByUser($user);
			$zone->insertZone($user, $tz);
		}
		
		//supprime une timezone
		public function deleteTzAction(){
			$tzDAO = tzDao::getInstance();
			$tz = $tzDAO->findTzById($this->request->getPost('tzId'));
			$userDAO = userDao::getInstance();
			$user = $userDAO->findUserByLog($_SESSION['loginUser']);
			$zone = zoneUserDao::getInstance();
			$zone->findByUser($user);
			$zone->deleteZone($user, $tz);
		}
		
		//liste toutes les timezones sélectionnable
		public function listAllTzAction(){
			$tzDAO = tzDao::getInstance();
			$view = new view('../views/');
			$view->load('add.php');
			$view->set('liste',$tzDAO->findAllTz());
			$view->render();
		}
	}