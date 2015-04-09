<?php
	session_start();
	require_once('../controleur/mainController.php');
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
					<tr><td class="td-refresh"><a href=""><div class="td-refresh-div"></div></a></td><td class="td-logo"></td><td class="td-plus"><a href="add.php"><div class="td-plus-div"></div></a></td></tr>
				</table>
			</div>
			<?php
			$x = 0;
			$tabColor = array('orange1', 'orange2', 'orange3', 'violet1', 'violet2', 'violet3');
			$collec = mainController::selectTzAction();
			foreach($collec as $timeZone){
				list($p, $v) = explode('/', $timeZone->getLibelle());
				?>
				<div class="clock-line <?php echo $tabColor[$x%6]; ?>">
					<div class="clock-line-content">
						<span id="line<?php echo $x;?>-1" data-utc="<?php echo $timeZone->getGtm();?>" class="clock-line-time"></span><br>
						<span id="line<?php echo $x;?>-2" class="clock-line-titre"><b> <?php echo $p;?></b> <?php echo $v;?></span><br>
						<span id="line<?php echo $x;?>-3" class="clock-line-sous-titre"></span>
					</div>
				</div>
				<?php
				$x++;
			}
			?>
			<a href="grid.php"><div class="bottom-bar"><span>SWITCH TO GRID VIEW</span></div></a>
	</body>

<?php

?>
</html>