<?php

/*
 *  Show movies from filters
 */

// headers
header("Content-Type: application/json; charset=UTF-8");

// -- TO DO - check HTTP method

if($_SERVER['REQUEST_METHOD']== 'GET'){
    echo 'error';
}

//Récupère les données du form dans search.html / form.js
$json = file_get_contents('php://input');
$data = json_decode($json, TRUE);

// var_dump($data);

if(isset($data['prenom']))
    $prenom = $data['prenom'];
else
    $prenom = TRUE;

if(isset($data['nom']))
    $nom = $data['nom'];
else
    $nom = TRUE;

// Check pour chacune des catégories

if(isset($data['categorie']))
    $categorie = $data['categorie'];
else
    $categorie = TRUE;

// -----------------------------------

if(isset($data['titre']))
    $titre = $data['titre'];
else
    $titre = TRUE;

if(isset($data['auteur']))
    $auteur = $data['auteur'];
else
    $auteur = TRUE;

if(isset($data['lien']))
    $lien = $data['lien'];
else
    $lien = TRUE;

if(isset($data['idPubli']))
    $idPublication = $data['idPubli'];
else
    $idPublication = TRUE;

//Récupérer les infos de la publication
//Comparé l'utilisateur avec les données bdd
//Comparé l'oeuvre avec les données bdd
//Comparé catégorie avec les données bdd

/* -------------------------
Récupération des données de la publication
------------------------- */

//Connexion à la base de donnée 'PROJET PHP'
$connect= mysqli_connect ('localhost', 'u690608483_wploo', '"InSpi(Mac)4', 'u690608483_folio') or die ('Messasge de Loonnnnnaaaaa' ) ;

//Codage des caractères utilisés (utf-8 norme web)
$charset = mysqli_set_charset($connect,'utf8');

//Requête SQL pour avoir tous les noms des catégories ('nomCategorie')
$requetePublication = "SELECT *, titre, auteur, nomCategorie, nom, prenom FROM `Publications`
                        JOIN Oeuvres ON Publications.idOeuvre = Oeuvres.idOeuvre
                        JOIN Categories ON Publications.idCategorie = Categories.idCategorie
                        JOIN Utilisateurs ON Publications.idUtilisateur = Utilisateurs.idUtilisateur
                        WHERE idPublication = $idPublication;";

//Connexion à la table 'Publications'
$TablePublication = mysqli_query($connect, $requetePublication) or die (mysqli_error($connect));

$tabOeuvre = mysqli_fetch_array ($TablePublication) ;
//Récupération des valeurs
// Table publi
$idUtilisateur = $tabOeuvre['idUtilisateur'];
// table oeuvre
$idOeuvre=$tabOeuvre['idOeuvre'];
$titreOeuvre=$tabOeuvre['titre'];
$auteurOeuvre=$tabOeuvre['auteur'];
// table categorie
$idCat = $tabOeuvre['idCategorie'];
$nomCat=$tabOeuvre['nomCategorie'];
// table utilisateur
$nomUtilisateur = $tabOeuvre['nom'];
$prenomUtilisateur=$tabOeuvre['prenom'];

/* ---------------
COMPARAISON UTILISATEUR
Si les données relatives à l'utilisateur ont été modifées
------------------ */

$requeteU = "SELECT * FROM `Utilisateurs`";

//Connexion à la table 'Utilisateurs'
$TableU = mysqli_query($connect, $requeteU) or die (mysqli_error($connect));

//Comptage du nombre d''utilisateurs présents dans la table 'Utilisateurs'
$nbU = mysqli_num_rows($TableU);

//Je crée un tab pour chaque valeur de la tab Utilisateurs
for ($i=1; $i<=$nbU; $i++) {
    $tab = mysqli_fetch_array ($TableU) ;
    
    $Nom[$i]=$tab['nom'];
    $Prenom[$i]=$tab['prenom'];
    $idUtilisateur[$i]=$tab['idUtilisateur'];

    // Je compare les valeurs de la bdd et les valeurs rentrée dans le formulaire
    // Si les deux valeurs sont égales je récupère l'id de l'utilisateur
    if(strcasecmp($Nom[$i], $nom) == 0 AND strcasecmp($Prenom[$i], $prenom)== 0){
        $idU = $idUtilisateur[$i];
        $nouveau = false;
        break;
    } else {
        $nouveau = true;
    }
} 
//création d'un nouvel utilisateur
if($nouveau == true){
    //Requête SQL pour insérer un nouvel utilisateur
    $requeteNewU = "INSERT INTO `Utilisateurs` (`nom`, `prenom`)
    VALUES ('$nom', '$prenom')";

    if (mysqli_query($connect, $requeteNewU)) {
        //Doit permettre de récupérer l'id du nouvel Utilisateur créé
        $idU = mysqli_insert_id($connect);
    } else {
        echo "Error: " . $requeteNewU . "<br>" . mysqli_error($connect);
    }
}

/* ---------------
COMPARAISON CATEGORIE
Si les données relatives à la categorie ont été modifées
------------------ */

// Libère la mémoire
$libere = mysqli_free_result ($TabId);

if($categorie != $nomCat){
    $requeteCats = "SELECT * FROM `Categories`";

    //Connexion à la table 'Categorie'
    $TableCats = mysqli_query($connect, $requeteCats) or die (mysqli_error($connect));

    //Comptage du nombre de 'nomCategorie' présents dans la table 'Categories'
    $nbCats = mysqli_num_rows($TableCats);

    for ($i=1; $i<=$nbCats; $i++) {
        $tabCat = mysqli_fetch_array ($TableCats) ;
        
        $idCats[$i]=$tabCat['idCategorie'];
        $nomCats[$i]=$tabCat['nomCategorie'];

        // Je compare les valeurs de la bdd et les valeurs rentrée dans le formulaire
        // Si les deux valeurs sont égales je récupère l'id de la catégorie
        if(strcasecmp($nomCats[$i], $categorie) == 0){
            $idCategorie = $idCats[$i];
            $nomCategorie = $nomCats[$i];
        }
    }
}

/* ---------------
COMPARAISON OEUVRES
Si les données relatives à l'oeuvres ont été modifées
------------------ */

if($titre != $titreOeuvre OR $auteur != $auteurOeuvre){

    $requeteAlleOeuvres = "SELECT * FROM Oeuvres";

    $TableOeuvre = mysqli_query($connect, $requeteAlleOeuvres) or die (mysqli_error($connect));

    //Comptage du nombre d'oeuvres présentes dans la table 'Oeuvres'
    $nbOeuvres = mysqli_num_rows($TableOeuvre);

    for ($i=1; $i<=$nbOeuvres; $i++) {
        $tabOeuvre = mysqli_fetch_array ($TableOeuvre) ;
        
        $idOeuvres[$i]=$tabOeuvre['idOeuvre'];
        $titreOeuvres[$i]=$tabOeuvre['titre'];
        $auteurOeuvres[$i]=$tabOeuvre['auteur'];

        // Je compare les valeurs de la bdd et les valeurs rentrée dans le formulaire
        // Si les deux valeurs sont égales je récupère l'id de l'oeuvre
        // Sinon direction création d'une oeuvre
        if(strcasecmp($titreOeuvres[$i], $titre) == 0 AND strcasecmp($auteurOeuvres[$i], $auteur) == 0){
            $idOeuvre = $idOeuvres[$i];
            $titre = $titreOeuvres[$i];
            $auteur = $auteurOeuvres[$i];
            $nouvelleOeuvre = false;
            break;
        } else {
            $nouvelleOeuvre = true;
        }
    }
    //création d'une nouvelle oeuvre
    if($nouvelleOeuvre == true){
        //Requête SQL pour insérer la nouvelle oeuvre et ses données
        $requeteInsertOeuvre = "INSERT INTO `Oeuvres`(`titre`, `auteur`, `lien`, `idCategorie`)
        VALUES ('$titre', '$auteur', '$lien', $idCategorie);";

        if (mysqli_query($connect, $requeteInsertOeuvre)) {

            $idOeuvre = mysqli_insert_id($connect);

        } else {
            echo "Error: " . $requeteInsertOeuvre . "<br>" . mysqli_error($connect);
        }
    }
}

// Requete de modification
$requeteModifPublication = "UPDATE `Publications` SET `idCategorie`=$idCategorie, `idUtilisateur`=$idU, `idOeuvre`=$idOeuvre WHERE idPublication = $idPublication;";

if (mysqli_query($connect, $requeteModifPublication)) {
    // echo "New record created successfully";
    $retour = json_encode(array("titre"=>$titre, "auteur"=>$auteur, "lien"=>$lien, "nom"=>$nom, "prenom"=>$prenom, "categorie"=>$nomCategorie, "idPubli"=>$idPublication));
    echo $retour;
} else {
    echo "Error: " . $requeteModifPublication . "<br>" . mysqli_error($connect);
}

//Libération de la place mémoire que prend la requête
// !! A mettre en fin de fichier ça peut créer des bugs !!
$fini = mysqli_close($connect);

?>