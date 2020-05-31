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

//Récupère les données du form dans categories.php / categories.js
$json = file_get_contents('php://input');
$data = json_decode($json, TRUE);

if(isset($data['idPubli']))
    $idPublication = $data['idPubli'];
else
    $idPublication = TRUE;

/* -------------------------
Récupération des données de la publication
------------------------- */

//Connexion à la base de donnée 'PROJET PHP'
$connect= mysqli_connect ('localhost', 'u690608483_wploo', '"InSpi(Mac)4', 'u690608483_folio') or die ('Messasge de Loonnnnnaaaaa' ) ;

//Codage des caractères utilisés (utf-8 norme web)
$charset = mysqli_set_charset($connect,'utf8');

$requeteLike = "SELECT *, titre, auteur, lien, nomCategorie, nom, prenom FROM Publications 
                JOIN Oeuvres ON Publications.idOeuvre = Oeuvres.idOeuvre
                JOIN Utilisateurs ON Publications.idUtilisateur = Utilisateurs.idUtilisateur
                JOIN Categories ON Publications.idCategorie = Categories.idCategorie
                WHERE idPublication = $idPublication;";

$TableLike = mysqli_query($connect, $requeteLike) or die (mysqli_error($connect));

$tabPubli = mysqli_fetch_array ($TableLike) ;

// table oeuvre
$nbLike=$tabPubli['nbLike'];
$titre=$tabPubli['titre'];
$auteur=$tabPubli['auteur'];
$lien = $tabPubli['lien'];
$nom = $tabPubli['nom'];
$prenom = $tabPubli['prenom'];

$nbLike = $nbLike+1;

$requeteUpdateLike = "UPDATE `Publications` SET `nbLike`=$nbLike WHERE idPublication = $idPublication";;

if (mysqli_query($connect, $requeteUpdateLike)) {
    // echo "New record created successfully";
    $retour = json_encode(array("titre"=>$titre, "auteur"=>$auteur, "lien"=>$lien, "nom"=>$nom, "prenom"=>$prenom, "idPubli"=>$idPublication, "nbLike"=>$nbLike));
    echo $retour;
} else {
    echo "Error: " . $requeteModifPublication . "<br>" . mysqli_error($connect);
}

?>