<!DOCTYPE html>
<html>
	<header>
		<link rel="stylesheet" type="text/css" href="css/main.css" />
		<link href='http://fonts.googleapis.com/css?family=Open+Sans&subset=latin,latin-ext' rel='stylesheet' type='text/css'/>
	<header>
	<body>
		<!-- add-->
		<div id="main">
			<div class="top-bar">
				<table class="table-top-bar">
					<tr><td class="td-search-title">SEARCH LOCATION</td><td class="td-search-icon"><div class="td-search-div"></div></td></tr>
				</table>
			</div>
			<a href="list"><div class="bottom-bar bottom-bar-add"><span>Retour à la liste</span></div></a>
			<?php
			$x = 1;
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
				?>
				<div class="search-line nightblue<?php echo $x%2 + 1;?>">
					<table class="table-top-bar">
						<tr>
							<td class="td-search-text">
								<div class="search-line-content">
									<span class="search-line-titre"><b><?php echo $explodedTz[0];?></b> <?php echo $explodedTz[1];?></span><br>
								</div>
							</td>
							<td class="td-search-check-icon">
								<input type="checkbox" id="check<?php echo $timeZone->getId();?>" onclick="addOrDelete(<?php echo $timeZone->getId();?>);" />
							</td>
						</tr>
					</table>
				</div>
				<?php
				$x++;
			}
			if ($count == 0) {
				echo "<div class='error_empty'><span class='vertical-align-text'>Cliquez sur <b>la loupe</b> pour commencer !</span></div>";
			}
			?>
		<a href="list"><div class="bottom-bar bottom-bar-add"><span>Retour à la liste</span></div></a>
	</body>
	<footer>
		<?php include ('utilities/footer.php'); ?>
		<script type="text/javascript" src="js/addDelete.js"></script>
	</footer>
<?php

?>
</html>