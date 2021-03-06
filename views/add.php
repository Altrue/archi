﻿<!DOCTYPE html>
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
					<form method="POST" action="add">
						<tr><td class="td-search-title"><input type="text" id="input_search" name="location" placeholder="Rechercher"/></td><td class="td-search-icon"><div class="td-search-div"><input type="submit" name="search" style="opacity:0; width:100%; height:100%;"></div></td></tr>
					</form>
				</table>
			</div>
			<a href="list"><div class="bottom-bar bottom-bar-add"><span>Retour à la liste</span></div></a>
			<?php
			if(!empty($liste)){
				$x = 1;
				foreach($liste as $tabTime){
					?>
					<div class="search-line nightblue<?php echo $x%2 + 1;?>">
						<table class="table-top-bar">
							<tr>
								<td class="td-search-text">
									<div class="search-line-content">
										<span class="search-line-titre"><b><?php echo $tabTime[0][0];?></b> <?php echo $tabTime[0][1];?></span><br>
									</div>
								</td>
								<td class="td-search-check-icon">
									<div class="squaredTwo<?php echo $x%2 + 1;?>" onclick="addOrDelete(<?php echo $tabTime[1];?>);">
										<input type="checkbox" id="check<?php echo $tabTime[1];?>" <?php if($tabTime[2] === true){echo 'checked';}?> />
										<label for="squaredTwo"></label> <!-- Laisser le label vide, mais ne pas le supprimer parce qu'apparemment c'est nécessaire o_O -->
									</div>
								</td>
							</tr>
						</table>
					</div>
					<?php
					$x++;
				}
			}
			else{
				echo'<div class="error_empty"><span class="vertical-align-text">Aucun résultat</span></div>';
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