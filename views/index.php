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
									<input type="submit" class="submit-login" name="valider" value="Connexion"/>
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