<?php
	session_start();
?>
<!DOCTYPE html>
<html>
	<header>
		<link rel="stylesheet" type="text/css" href="../css/main.css" />
		<link href='http://fonts.googleapis.com/css?family=Open+Sans&subset=latin,latin-ext' rel='stylesheet' type='text/css'/>
		<?php include ('../utilities/header.php'); ?>
	</header>
	<body>
		<div id="main">
			<div class="top-bar">
				<table class="table-top-bar">
					<tr><td class="td-logo"></td></tr>
				</table>
			</div>
			<?php
				if($message == 'deco'){echo 'Vous avez été déconnecté';}
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
							<?php
								if($message == 'errS'){echo 'erreur de saisie';}
								if($message == 'errL'){echo 'login ou mot de passe incorrect';}
							?>
						</td>
					</tr>
				</table>
			</div>
			<div class="bottom-bar-login"><span>Veuillez vous connecter pour continuer</span></div>
		</div>
	</body>
	<footer>
		<?php include ('../utilities/footer.php'); ?>
	</footer>
</html>