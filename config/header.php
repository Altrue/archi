<link rel="shortcut icon" href="../images/favicon.ico?v=2"/>
<script type="text/javascript">
	date = new Date;
	h = date.getHours();
	if(h<10)
	{
	h = "0"+h;
	}
	m = date.getMinutes();
	if(m<10)
	{
	m = "0"+m;
	}
	s = date.getSeconds();
	if(s<10)
	{
	s = "0"+s;
	}
	resultat = 'Nous sommes le '+jours[jour]+' '+j+' '+mois[moi]+' '+annee+' il est '+h+':'+m+':'+s;
	document.getElementById(id).innerHTML = resultat;
	setTimeout('date_heure("'+id+'");','1000');
	return true;
</script>