<?php
	session_start();

	require_once('librairie/formulaire.php');
	require_once('librairie/session.php');
	require_once('dao/userDao.php');
	require_once('dao/tzDao.php');
	require_once('dao/zoneUserDao.php');
	require_once('librairie/ControllerInterface.php');
	require_once('librairie/controller.php');
	
	class TzController extends Controller implements ControllerInterface{
		
		//liste les timezones sélectionnées
		public function indexAction(){
			if($_SESSION['user']){
				$co = new ConnectDB();
				$pdo = $co->connectBase();
				$userDAO = new UserDao();
				$user = $userDAO->findUserByLog($pdo, unserialize($_SESSION['user'])->getLoginUser());
				$zone = new ZoneUserDao();
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
			else{
				$this->redirect('nolog');
			}
		}
		
		//ajoute une timezone
		public function addTzAction(){
			if($_SESSION['user']){
				$co = new ConnectDB();
				$pdo = $co->connectBase();
				$tzDAO = new TzDao();
				$tz = $tzDAO->findTzById($pdo, $this->request->getPost('tzId'));
				if($tz != null){
					$userDAO = new UserDao();
					$user = $userDAO->findUserByLog($pdo, unserialize($_SESSION['user'])->getLoginUser());
					$zone = new ZoneUserDao();
					$zone->findByUser($pdo, $user);
					$zone->insertZone($pdo, $user, $tz);
				}
				unset($pdo);
			}
			else{
				$this->redirect('nolog');
			}
		}
		
		//supprime une timezone
		public function deleteTzAction(){
			if($_SESSION['user']){
				$co = new ConnectDB();
				$pdo = $co->connectBase();
				$tzDAO = new TzDao();
				$tz = $tzDAO->findTzById($pdo, $this->request->getPost('tzId'));
				if($tz != null){
					$userDAO = new UserDao();
					$user = $userDAO->findUserByLog($pdo, unserialize($_SESSION['user'])->getLoginUser());
					$zone = new ZoneUserDao();
					$zone->findByUser($pdo, $user);
					$zone->deleteZone($pdo, $user, $tz);
				}
				unset($pdo);
			}
			else{
				$this->redirect('nolog');
			}
		}
		
		//liste toutes les timezones sélectionnable
		public function listAllTzAction(){
			if($_SESSION['user']){
				$co = new ConnectDB();
				$pdo = $co->connectBase();
				$tzDAO = new TzDao();
				$liste = array();
				$tabVarView = array();
				if($this->request->getPost('search') !== null){
					$liste = $tzDAO->findAllBySearch($pdo, strtolower(str_replace(' ','_',$this->request->getPost('location'))));
				}
				else{
					$liste = $tzDAO->findAllTz($pdo);
				}
				if(!empty($liste)){
					$x = 0;
					foreach($liste as $timeZone){
						$explodedTz = array();
						$explodedTz = explode('/', $timeZone->getLibelle());
						if (!isset($explodedTz[1])) {
							$explodedTz[1] = "";
						}
						if (isset($explodedTz[2])) {
							$explodedTz[1] = $explodedTz[2];
						}
						$explodedTz[1] = str_replace("_", " ", $explodedTz[1]);
						$tabVarView[$x][0] = $explodedTz;
						$tabVarView[$x][1] = $timeZone->getId();
						$zoneUser = new ZoneUserDao();
						$tabVarView[$x][2] = $zoneUser->exist($pdo, $timeZone);
						$x++;
					}
				}
				$view = new View('views/');
				$view->load('add.php');
				$view->set('liste',$tabVarView,1);
				unset($pdo);
				$view->render();
			}
			else{
				$this->redirect('nolog');
			}
		}
	}