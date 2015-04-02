<?php
	session_start();
	require_once('../librairie/formulaire.php');
	require_once('../librairie/session.php');
?>
<!DOCTYPE html>
<html>
	<header>
		<link rel="stylesheet" type="text/css" href="../css/main.css" />
		<link href='http://fonts.googleapis.com/css?family=Open+Sans&subset=latin,latin-ext' rel='stylesheet' type='text/css'/>
		<?php include ('../config/header.php'); ?>
	</header>
	<body>
		<div id="main">
			<div class="top-bar">
				<table class="table-top-bar">
					<tr><td class="td-logo"></td></tr>
				</table>
			</div>
			<?php
			if(isset($_POST['deco'])){
				if(isset($_SESSION['user'])){
				unset($_SESSION['user']);
				session_destroy();
			}
			}
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
						header('Location: list.php');
					}
				}
				else{
					echo "erreur de saisie";
				}
			}
			?>
			<div class="login-line nightblue1">
				<table class="table-top-bar">
					<tr>
						<td class="td-login-text">
							<div class="login-line-content">
								<span class="login-line-titre"><b>Connexion</b></span><br><br>
								<form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">
									<span class="login-line-sous-titre">Login :</span><br>
									<input class="input-login" type="text" name="login"/><br><br>
									<span class="login-line-sous-titre">Mot de Passe :</span><br>
									<input class="input-login" type="password" name="mdp"/><br><br>
									<input type="submit" class="submit-login" name="connexion" value="Connexion"/>
								</form>
							</div>
						</td>
					</tr>
				</table>
			</div>
			<div class="bottom-bar-login"><span>Veuillez vous connecter pour continuer</span></div>
		</div>
	</body>
</html>