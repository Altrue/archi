﻿<!DOCTYPE html> 
<html>
	<header>
		<link rel="stylesheet" type="text/css" href="css/main.css" />
		<link href='http://fonts.googleapis.com/css?family=Open+Sans&subset=latin,latin-ext' rel='stylesheet' type='text/css'/>
		<?php include ('utilities/header.php'); ?>
	</header>
	<body>
		<!-- liste-->
		<div id="main">
			<div class="top-bar">
				<table class="table-top-bar">
					<tr><td class="td-refresh"><a href="deco"><div class="td-refresh-div"></div></a></td><td class="td-logo"></td><td class="td-plus"><a href="add"><div class="td-plus-div"></div></a></td></tr>
				</table>
			</div>
			<?php
			$x = 1;
			$count = $liste->getCount();
			
			foreach($liste->getListObjet() as $timeZone){
				$tzLibelle = $timeZone->getLibelle();
				$explodedTz = array();
				$explodedTz = explode('/', $tzLibelle);
				if (!isset($explodedTz[1])) {
					$explodedTz[1] = "";
				}
				if (isset($explodedTz[2])) {
					$explodedTz[1] = $explodedTz[2];
				}
				$explodedTz[1] = str_replace("_", " ", $explodedTz[1]);
				?>
				<div id="div-line-<?php echo $x;?>" class="clock-line">
					<div class="clock-line-content">
						<span id="line<?php echo $x;?>-1" data-tzlibelle="<?php echo $tzLibelle;?>" class="clock-line-time"></span><br>
						<span id="line<?php echo $x;?>-2" class="clock-line-titre"><b> <?php echo $explodedTz[0];?></b> <?php echo $explodedTz[1];?></span><br>
						<span id="line<?php echo $x;?>-3" class="clock-line-sous-titre"></span>
					</div>
				</div>
				<?php
				$x++;
			}
			if ($count == 0) {
				echo "<div class='error_empty'><span class='vertical-align-text'>Aucune Timezone enregistrée. Cliquez sur <b>+</b> pour commencer !</span></div>";
			}
			?>
			<a href="grid"><div id="bottom-link" data-count="<?php echo $count;?>" class="bottom-bar"><span>Affichage en grille</span></div></a>
	</body>
	<footer>
		<?php include ('utilities/footer.php'); ?>
	</footer>
</html>