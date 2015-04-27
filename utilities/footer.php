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
		*/
		function time(tzlibelle,line) {
			tzlibelle = ''+tzlibelle+'';
			var offset = moment().tz(tzlibelle).format("ZZ").slice(0,-2);;
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
			
			var id_date = "line"+line+"-3";
			resultat_date = jours[jour]+' '+j+' '+mois[moi]+' '+annee;
			document.getElementById(id_date).innerHTML = resultat_date;
			return true;
		}
	
	/* Actualise tous les affichages d'heures */
	function refreshTime() {
		var count = $("#bottom-link").attr('data-count');
		var currentCount = 1;
		while (currentCount <= count) {
			time($("#line"+currentCount+"-1").attr('data-tzlibelle'),currentCount);
			currentCount = currentCount + 1;
		}
	}
	
	/* Appel� une fois au lancement, car sinon durant la premi�re seconde, la page n'est pas pr�te. */
	refreshTime();
	
	var x = 0;
	
	/* Dans cette fonction, le code est appell� toutes les 1000ms (1 seconde) */
	setInterval(function(){
		refreshTime();
	}, 1000);
	
});
</script>