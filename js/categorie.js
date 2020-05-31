function $_GET(param) {
	var vars = {};
	window.location.href.replace( location.hash, '' ).replace( 
		/[?&]+([^=&]+)=?([^&]*)?/gi, // regexp
		function( m, key, value ) { // callback
			vars[key] = value !== undefined ? value : '';
		}
	);

	if ( param ) {
		return vars[param] ? vars[param] : null;	
	}
	return vars;
}

var $_GET = $_GET(),
    idcat = $_GET['idcat'];

// console.log(id);

window.addEventListener(
    'load',
    function (){

		// récupération du container dans index.php
		let div = document.getElementById("afficheBDD");

		// recupération des données json dans le fichier afficheIndex.php
		var requestURL = './afficheCategorie.php';

		// console.log(requestURL);

		// création de la requete XML
		var request = new XMLHttpRequest();

        request.open('GET', requestURL);
        
        // console.log(request);

		request.responseType = 'json';
		request.send();

		// Au chargement de la page je récupère le json et on l'affiche via la fonction affiche
		request.onload = function() {
			var data = request.response;
			affiche(data);
		  }

		console.log("Avant fonction recupere");

		// Déclaration de la fonction affiche
		function affiche(jsonObj){
            var oeuvres = jsonObj[0];
			
			// Permet de faire une verif de ce qu'on affiche
            // console.log(oeuvres.length);

            // console.log("Avant affichage recupere");
            
            var tabIdPublis = new Array();
            var tabLike = new Array();
            var tabTitre = new Array();
            var tabLien = new Array();
            var tabAuteur = new Array();
            var tabCouleur = new Array();
            var tabNoms = new Array();
            var tabPrenoms = new Array();
            var i = 0;

            // Parcourir toutes les oeuvres pour trouver celles qui appartiennent à la cat recherchée
            for(var o = 0 ; o < oeuvres.length ; o ++){
                if(oeuvres[o].categorie == idcat){
                    var idPubli = oeuvres[o].idPubli;
                    var like = oeuvres[o].nbLike;
                    var titre = oeuvres[o].titre;
                    var auteur = oeuvres[o].auteur;
                    var lien = oeuvres[o].lien;
                    var couleur = oeuvres[o].couleur;
                    var nom = oeuvres[o].nom;
                    var prenom = oeuvres[o].prenom;
                    tabIdPublis[i] = [idPubli];
                    tabLike[i] = [like];
                    tabTitre[i] = [titre];
                    tabLien[i] = [lien];
                    tabAuteur[i] = [auteur];
                    tabCouleur[i] = [couleur];
                    tabNoms[i] = [nom];
                    tabPrenoms[i] = [prenom];
                    i++;
                }
            }
            console.log(tabTitre);
            console.log(tabAuteur);
            console.log(tabCouleur);
            console.log(tabTitre.length);

            for(i = 0 ; i < tabTitre.length ; i++){
                var idPubli = tabIdPublis[i];
                var nbLike = tabLike[i];
                var lien =  tabLien[i];
				var titre =  tabTitre[i];
                var auteur =  tabAuteur[i];
                var couleur = tabCouleur[i];
                var nom = tabNoms[i];
                var prenom = tabPrenoms[i];

                // console.log(titre);

                var card = "<div id=\"card"+i+"\" class=\"card text-white text-center cardCategorie\" style=\"background-color:"+couleur+";\"><div class=\"card-img-top\">"+lien+"</div><div class=\"card-body\"><div id='titre'><h3 class=\"card-title\">"+titre+"</h3><h4 class=\"card-subtitle\">"+auteur+"</h4><p>Partagé par : "+prenom+" "+nom+"</p></div></div><div class=\"card-footer \"><p onclick='like("+idPubli+','+i+")' id=\"coeur\">"+nbLike+"</p></div></div>";
                var list = document.createElement("div");
                list.id = i;
				// Inclusion de l'html dans un nouveau div (objet)
				list.innerHTML = card;
				
				// Inclusion de list (objet) dans le div récupéré tout en haut du doc
				// appendChild ne marche qu'avec de l'objet d'où la conversion avec list
				div.appendChild(list);
            }

            // Code pour page de navigation en bas

            var code = "<b class=\"nav justify-content-center\"> Pages : "+barre_navigation(tabTitre.length, 16, 0, 10)+"</b>"
            var nav = document.getElementById('navpage');
            nav.innerHTML = code ;

        // echo ('<b class="nav justify-content-center"> Pages : '.barre_navigation(tabTitre.length, 16, $var, 10).'</b>');
        // }
    }
});