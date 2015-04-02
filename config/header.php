<link rel="shortcut icon" href="../images/favicon.ico?v=2"/>
<meta http-equiv="Content-Type" content="UTF-8"/>
<script type="text/javascript" src="../js/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="../js/moment.js"></script>
<script type="text/javascript" src="../js/moment-tz.js"></script>
<script type="text/javascript">
$(document).ready(function(){
		/* Affiche la date et l'heure d'une timezone.
		"Offset" repr�sente le d�calage horaire.
			Exemple : UTC+2 s'�crit 2. UTC+5:30 s'�crit 5.5
		"Line" repr�sente la ligne.
			Exemple : 1, 2, 3, 4, etc...
		"Lavel" repr�sente le texte � affiche.
			Exemple : labelville = "Paris", labelpays = "France"
			= Paris, FRANCE.
		*/
		
		function time(offset,line,labelville, labelpays) {
		
			var d = new Date();
			var localTime = d.getTime();
			var localOffset = d.getTimezoneOffset() * 60000;
			var utc = localTime + localOffset;
			var ville = utc + (3600000*offset);
			var date = new Date(ville);
			
			annee = date.getFullYear();
			moi = date.getMonth();
			mois = new Array('Janvier', 'F�vrier', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Aout', 'Septembre', 'Octobre', 'Novembre', 'D�cembre');
			j = date.getDate();
			jour = date.getDay();
			jours = new Array('Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi');
			
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
			var id_heure = "line"+line+"-1";
			resultat_heure = h+':'+m;
			document.getElementById(id_heure).innerHTML = resultat_heure;
			
			var id_ville = "line"+line+"-2";
			resultat_ville = "<b>"+labelville+" </b>"+labelpays;
			document.getElementById(id_ville).innerHTML = resultat_ville;
			
			var id_date = "line"+line+"-3";
			resultat_date = jours[jour]+' '+j+' '+mois[moi]+' '+annee;
			document.getElementById(id_date).innerHTML = resultat_date;
			return true;
		}
	
	/* Appel� une fois au lancement, car sinon durant la premi�re seconde, la page n'est pas pr�te. */
	time(2,1,"paris","france");
	time(1,2,"London","UK");
	time(0,3,"Reykjavik","Island");
	time(-6,4,"New York","USA");
	time(3.5,5,"Colombo","India");
	time(9,6,"Sydney","Australia");
	
	/* Dans cette fonction, le code est appell� toutes les 1000ms (1 seconde) */
	setInterval(function(){
		time(2,1,"paris","france");
		time(1,2,"London","UK");
		time(0,3,"Reykjavik","Island");
		time(-6,4,"New York","USA");
		time(3.5,5,"Colombo","India");
		time(9,6,"Sydney","Australia");
	}, 1000);
});
</script>