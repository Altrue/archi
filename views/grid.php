<!DOCTYPE html> 
<html>
	<header>
		<link rel="stylesheet" type="text/css" href="css/main.css" />
		<link href='http://fonts.googleapis.com/css?family=Open+Sans&subset=latin,latin-ext' rel='stylesheet' type='text/css'/>
		<?php include ('utilities/header.php'); ?>
	</header>
	<body>
		<!-- grid-->
		<div id="main">
			<div class="top-bar">
				<table class="table-top-bar">
					<tr><td class="td-refresh"><a href="deco"><div class="td-refresh-div"></div></a></td><td class="td-logo"></td><td class="td-plus"><a href="add"><div class="td-plus-div"></div></a></td></tr>
				</table>
			</div>
			<table style="border-collapse:collapse;" cellspacing="0" cellpadding="0">
				<?php
			$x = 1;
			$count = $liste->getCount();
			$newLine = true;
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
				if ($newLine) {echo"<tr>";}
				?>
				<td class="td-clock-grid">
					<div id="div-line-<?php echo $x;?>" class="clock-grid">
						<div class="clock-grid-content">
							<div class="clock-grid-subcontent">
								<span class="clock-grid-span">
									<span id="line<?php echo $x;?>-1" data-tzlibelle="<?php echo $tzLibelle;?>" class="clock-grid-time" data-utc="-8.5"></span><br>
									<span id="line<?php echo $x;?>-2" class="clock-grid-titre"><b> <?php echo $explodedTz[0];?></b> <?php echo $explodedTz[1];?></span><br>
									<span id="line<?php echo $x;?>-3" class="clock-grid-sous-titre"></span>
								</span>
							</div>
						</div>
					</div>
				</td>
				<?php
				if ($newLine == false || $x >= $count) {echo"</tr>";} // La deuxième condition permet de fermer la ligne même si le count est impair.
				
				$x++;
				if ($newLine) {$newLine = false;}
				else {$newLine = true;}
			}
			if ($count == 0) {
				echo "<div class='error_empty'><span class='vertical-align-text'>Aucune Timezone enregistrée. Cliquez sur <b>+</b> pour commencer !</span></div>";
			}
			?>
				<tr class="invisible-tr">
					<td>
						<image class="clock-square" src="../images/1x1.png"/>
					</td>
				</tr>
			</table>
			<a href="list"><div id="bottom-link" data-count="<?php echo $count;?>" class="bottom-bar"><span>Affichage en liste</span></div></a>
	</body>
	<footer>
		<?php include ('utilities/footer.php'); ?>
	</footer>
</html>