function like(idPubli, i){
    var bdd = document.getElementById('card'+i+'');
	bdd.remove(bdd.selectedIndex);
    let params = {};
        params.idPubli = idPubli;
        console.log(params); 

    fetch('./like.php', {method:"POST", body : JSON.stringify(params)})
        .then( retour => retour.json() )
        .then( data => { const requete = "<div class=\"card text-white text-center cardCategorie\" style=\"background-color:red;\"><div class=\"card-img-top\">"+data.lien+"</div><div class=\"card-body\"><div id='titre'><h3 class=\"card-title\">"+data.titre+"</h3><h4 class=\"card-subtitle\">"+data.auteur+"</h4><p>Partagé par : "+data.prenom+" "+data.nom+"</p></div></div><div class=\"card-footer \"><p onclick=like("+idPubli+','+i+") id=\"coeur\">"+data.nbLike+"</p></div></div>";
        let div = document.getElementById(""+i+"");
        var list = document.createElement("div");
        list.innerHTML = requete;
        div.appendChild(list);})
        // document.getElementById(""+i+"").innerHTML = requete; } )
        .catch(error => { console.log(error) })	
}