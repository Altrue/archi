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
					<tr><td class="td-refresh"><a href=""><div class="td-refresh-div"></div></a></td><td class="td-logo"></td><td class="td-plus"><a href="add.php"><div class="td-plus-div"></div></a></td></tr>
				</table>
			</div>
			<table style="border-collapse:collapse;" cellspacing="0" cellpadding="0">
				<tr>
					<td class="td-clock-grid">
						<div class="clock-grid orange1">
							<div class="clock-grid-content">
								<div class="clock-grid-subcontent">
									<span>
										<span id="line1-1" class="clock-grid-time"></span><br>
										<span id="line1-2" class="clock-grid-titre"><b>PARIS</b> FRANCE</span><br>
										<span id="line1-3" class="clock-grid-sous-titre">TUESDAY, MAY 07, 2013</span>
									</span>
								</div>
							</div>
						</div>
					</td>
					<td class="td-clock-grid">
						<div class="clock-grid orange2">
							<div class="clock-grid-content">
								<div class="clock-grid-subcontent">
									<span>
										<span id="line2-1" class="clock-grid-time"></span><br>
										<span id="line2-2" class="clock-grid-titre"><b>PARIS</b> FRANCE</span><br>
										<span id="line2-3" class="clock-grid-sous-titre">TUESDAY, MAY 07, 2013</span>
									</span>
								</div>
							</div>
						</div>
					</td>
				</tr>
				<tr class="invisible-tr">
					<td>
						<image class="clock-square" src="../images/1x1.png"/>
					</td>
				</tr>
			</table>
			<a href="list.php"><div class="bottom-bar"><span>SWITCH TO LIST VIEW</span></div></a>
	</body>

<?php

?>
</html>