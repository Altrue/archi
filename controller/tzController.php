<?php
	require_once('/librairie/formulaire.php');
	require_once('/librairie/session.php');
	require_once('/helper/userDao.php');
	require_once('/helper/tzDao.php');
	
	class tzController {
	
		private $view;
		
		//ajoute une timezone
		public function addTzAction($tzId){
			$tzDAO = tzDao::getInstance();
			$tz = $tzDAO->findTzById($tzId);
			$userDAO = userDao::getInstance();
			$user = $userDAO->findUserByLog($_SESSION['loginUser']);
			$zone = zoneUserDao::getInstance();
			$zone->findByUser($user);
			$zone->insertZone($user, $tz);
		}
		
		//supprime une timezone
		public function deleteTzAction($tzId){
			$tzDAO = tzDao::getInstance();
			$tz = $tzDAO->findTzById($tzId);
			$userDAO = userDao::getInstance();
			$user = $userDAO->findUserByLog($_SESSION['loginUser']);
			$zone = zoneUserDao::getInstance();
			$zone->findByUser($user);
			$zone->deleteZone($user, $tz);
		}
		
		//liste les timezones sélectionnées
		public function selectTzAction(){
			$userDAO = userDao::getInstance();
			$user = $userDAO->findUserByLog($_SESSION['loginUser']);
			$zone = zoneUserDao::getInstance();
			$zone->findByUser($user);
			return $user->getListTz();
		}
		
		//liste toutes les timezones sélectionnable
		public function listAllTzAction(){
			$tzDAO = tzDao::getInstance();
			return $tzDAO->findAllTz();
		}
	}