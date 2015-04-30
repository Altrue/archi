<script type="text/javascript" src="js/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="js/moment.js"></script>
<script type="text/javascript" src="js/moment-tz.js"></script>
<script type="text/javascript">
$(document).ready(function(){

		/* Affiche la date et l'heure d'une timezone.
		"Offset" représente le décalage horaire.
			Exemple : UTC+2 s'écrit 2. UTC+5:30 s'écrit 5.5
		"Line" représente la ligne.
			Exemple : 1, 2, 3, 4, etc...
		*/
		function time(tzlibelle,line) {
			var offset = moment().tz(tzlibelle).format("ZZ").slice(0,-2);;
			var d = new Date();
			var localTime = d.getTime();
			var localOffset = d.getTimezoneOffset() * 60000;
			var utc = localTime + localOffset;
			var ville = utc + (3600000*offset);
			var date = new Date(ville);
			
			annee = date.getFullYear();
			moi = date.getMonth();
			mois = new Array('Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Aout', 'Septembre', 'Octobre', 'Novembre', 'Décembre');
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
			resultat_heure = h+'<a style="color: #fff;" class="deuxpoints">:</a>'+m;
			document.getElementById(id_heure).innerHTML = resultat_heure;
			
			var id_date = "line"+line+"-3";
			resultat_date = jours[jour]+' '+j+' '+mois[moi]+' '+annee;
			document.getElementById(id_date).innerHTML = resultat_date;
			
			var id_line = "div-line-"+line;
			var color_class = "";
			if (h < 4) {color_class = "violet2";}
			else if (h < 7) {color_class = "violet3";}
			else if (h < 12) {color_class = "orange1";}
			else if (h < 17) {color_class = "orange2";}
			else if (h < 21) {color_class = "orange3";}
			else {color_class = "violet1";}
			document.getElementById(id_line).classList.add(color_class);
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
		if (x < 1) {
			$( ".deuxpoints" ).css( "opacity", "0.5" );
			x = 1;
		}
		else {
			$( ".deuxpoints" ).css( "opacity", "1" );
			x = 0;
		}
	}
	
	var x = 0;
	
	/* Appelé une fois au lancement, car sinon durant la première seconde, la page n'est pas prête. */
	refreshTime();
	
	/* Dans cette fonction, le code est appellé toutes les 1000ms (1 seconde) */
	setInterval(function(){
		refreshTime();
	}, 1000);
	
});
</script>