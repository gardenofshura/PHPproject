<?php

/* Étapes :
1. Connexion à la bdd
2. Supprimer la publication
3. Encodage des données (renvoie json)
*/

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

$connect= mysqli_connect ('localhost', 'u690608483_wploo', '"InSpi(Mac)4', 'u690608483_folio') or die ('Messasge de Loonnnnnaaaaa' ) ;

//Codage des caractères utilisés (utf-8 norme web)
$charset = mysqli_set_charset($connect,'utf8');

// Suppression publication

$requeteDeletePubli = "DELETE FROM Publications WHERE idPublication = $idPublication;";

if (mysqli_query($connect, $requeteDeletePubli)) {
    // echo "New record created successfully";
    $retour = json_encode(array("titre"=>$titre, "auteur"=>$auteur, "lien"=>$lien, "nom"=>$nom, "prenom"=>$prenom, "categorie"=>$categorie));
    echo $retour;
} else {
    echo "Error: " . $requeteDeletePubli . "<br>" . mysqli_error($connect);
}

$fini = mysqli_close($connect);

?>