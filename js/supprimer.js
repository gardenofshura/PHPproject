function supprimer(idPubli){
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
    //à compléter// construction des queries

    fetch('./supprimer.php', {method:"POST", body : JSON.stringify(params)})
        .then( retour => retour.json() )
        .then( data => { const requete = "<div class='row justify-content-center'> <div class='col-sm-6 col-md-12'> <div class='card text-center' style='background-color:blue'> <div class='card-body'> <p>"+data.prenom+ " "+data.nom+", vous avez supprimer : </p>"+data.lien+"<h2 class='card-title'>"+data.titre+"-"+data.auteur+"</h2><p>Dans la catégorie "+data.categorie+"</p></div></div><div class='card-footer text-muted'></div></div></div>";
        // console.log(data.idPubli)
        document.getElementById('affichePubli').innerHTML = requete; } )
        .catch(error => { console.log(error) })	
        // console.log(retour);	
}