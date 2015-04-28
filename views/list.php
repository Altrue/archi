<!DOCTYPE html> 
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
					<tr><td class="td-refresh"><a href=""><div class="td-refresh-div"></div></a></td><td class="td-logo"></td><td class="td-plus"><a href="add"><div class="td-plus-div"></div></a></td></tr>
				</table>
			</div>
			<?php
			$x = 1;
			$count = $liste->getCount();
			$tabColor = array('orange1', 'orange2', 'orange3', 'violet1', 'violet2', 'violet3');
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
				<div class="clock-line <?php echo $tabColor[$x%6]; ?>">
					<div class="clock-line-content">
						<span id="line<?php echo $x;?>-1" data-tzlibelle="<?php echo $tzLibelle;?>" class="clock-line-time"></span><br>
						<span id="line<?php echo $x;?>-2" class="clock-line-titre"><b> <?php echo $explodedTz[0];?></b> <?php echo $explodedTz[1];?></span><br>
						<span id="line<?php echo $x;?>-3" class="clock-line-sous-titre"></span>
					</div>
				</div>
				<?php
				$x++;
			}
			?>
			<a href="grid"><div id="bottom-link" data-count="<?php echo $count;?>" class="bottom-bar"><span>SWITCH TO GRID VIEW</span></div></a>
	</body>
	<footer>
		<?php include ('utilities/footer.php'); ?>
	</footer>
<?php

?>
</html>