document.getElementById('search').onclick = event => {
	event.preventDefault();
	//Remove permet de supprimer les données déjà présentes sur la page
	var bdd = document.getElementById('affiche');
	bdd.remove(bdd.selectedIndex);
	let params = {};
		params.recherche = document.getElementById('recherche').value;
		console.log(params); 
		// à compléter// construction des queries

	fetch("./afficheSearch.php" , {method:"POST", body : JSON.stringify(params)}) // à corriger si cela ne fonctionne pas
	.then( response => response.json())
	.then( data => {
		let div = document.getElementById("afficheSearch");
		data.forEach(element => {
			const requete = "<div class='col-md-4'><div class='card text-center' style='background-color:#ffd700'>"+element["lien"]+"<div class='card-body'><h3 class='card-title'>"+element["titre"]+"</h3><h4 class='card-subtitle'>"+element["auteur"]+"</h4><p>"+element["categorie"]+"</p id=\"coeur\"><p>Partagé par : "+element["prenom"]+" "+element["nom"]+"</p></div></div></div> "

			div.innerHTML += requete;
		});
	})
	.catch(error => { console.log(error) });

}