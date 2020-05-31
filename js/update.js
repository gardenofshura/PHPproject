function update(idPubli){
    let params = {};
        params.idPubli = idPubli;
		console.log(idPubli);
        params.nom = document.getElementById('nom').value;
        params.prenom = document.getElementById('prenom').value;
        params.titre = document.getElementById('titre').value;
        params.auteur = document.getElementById('auteur').value;
        params.lien = document.getElementById('lien').value;
        var selectElmt = document.getElementById('formCategorie');
        params.categorie = selectElmt.options[selectElmt.selectedIndex].value;
        console.log(params); 

    fetch('./update.php', {method:"POST", body : JSON.stringify(params)})
        .then( retour => retour.json() )
        .then( data => { const requete = "<div class='row justify-content-center'> <div class='col-sm-6 col-md-12'> <div class='card text-center' style='background-color:blue'> <div class='card-body'> <p>"+data.prenom+ " "+data.nom+", vous avez partagé : </p>"+data.lien+"<h2 class='card-title'>"+data.titre+"-"+data.auteur+"</h2><p>Dans la catégorie "+data.categorie+"</p></div></div><div class='card-footer text-muted'><button onclick='update("+data.idPubli+")' id='update' class='btn btn-outline-light mb-2'>Modifier</button><button id='delete' onclick='supprimer"+data.idPubli+")' class='btn btn-outline-light mb-2'>Supprimer</button></div></div></div>";
        // console.log(data.idPubli)
        document.getElementById('affichePubli').innerHTML = requete; } )
        .catch(error => { console.log(error) })	
}