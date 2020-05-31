window.addEventListener(
    'load',
    function (){

		// récupération du container dans index.php
		let div = document.getElementById("affiche");

		// recupération des données json dans le fichier afficheIndex.php
		var requestURL = './afficheIndex.php';

		console.log(requestURL);

		// création de la requete XML
		var request = new XMLHttpRequest();

		request.open('GET', requestURL);

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
            var oeuvres = jsonObj;
			
			// Permet de faire une verif de ce qu'on affiche
            console.log(oeuvres);

			console.log("Avant affichage recupere");

			// création de la boucle pour affichage de toutes les données json
			// 12 oeuvres mais 13 car on commence à 1
			for(var i = 1; i < 13 ; i++){
				var lien =  oeuvres[i].lien;
				var titre =  oeuvres[i].titre;
                var auteur =  oeuvres[i].auteur;
				var categorie =  oeuvres[i].categorie;
				var couleur = oeuvres[i].couleur;

				// Déclaration de la structure html pour l'affichage correct dans indes.php
				var card = "<div class=\"card text-white text-center\" id='affichecard' style=\"background-color:"+couleur+";\"><div class=\"card-img-top\">"+lien+"</div><div class=\"card-body\"><h3 class=\"card-title\">"+titre+"</h3><h4 class=\"card-subtitle\">"+auteur+"</h4><p>"+categorie+"</p></div></div>";
				var list = document.createElement("div");
				// Inclusion de l'html dans un nouveau div (objet)
				list.innerHTML = card;
				
				// Inclusion de list (objet) dans le div récupéré tout en haut du doc
				// appendChild ne marche qu'avec de l'objet d'où la conversion avec list
				div.appendChild(list);
			}
        }
	}
);