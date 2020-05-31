<?php
/*
 *  Show movies from filters
 */

// headers
header("Content-Type: application/json; charset=UTF-8");

// -- TO DO - check HTTP method

if($_SERVER['REQUEST_METHOD']==GET){
    echo 'error';
}

//Récupère les données du form dans search.html / form.js
$json = file_get_contents('php://input');
$data = json_decode($json, TRUE);

// Vérification du contenu dans la barre de recherche
if(isset($data['recherche']))
    $search = $data['recherche'];
else
    $search = TRUE;

 // Code PHP connexion BDD

 $connect= mysqli_connect ('localhost', 'u690608483_wploo', '"InSpi(Mac)4', 'u690608483_folio') or die ('Messasge de Loonnnnnaaaaa' ) ;

 $charset=mysqli_set_charset($connect,'utf8');
 
 // Requête SQL qui permet de récupérer toutes les informations nécessaires pour un affichage complet après coup
 // Attention au join
 // WHERE : permet de filter les résultats en fonction de la recherche de l'utilisateur
 $requeteAllOeuvres = "SELECT *, nom, prenom, nomCategorie, titre, auteur, lien FROM Publications
                     JOIN Utilisateurs ON Publications.idUtilisateur = Utilisateurs.idUtilisateur
                     JOIN Categories ON Publications.idCategorie = Categories.idCategorie 
                     JOIN Oeuvres ON Publications.idOeuvre = Oeuvres.idOeuvre
                     WHERE nom = '$search' OR prenom='$search' OR titre='$search' OR auteur='$search';";
     
 $TableAllOeuvres= mysqli_query($connect, $requeteAllOeuvres) or die (mysqli_error($connect));

 $nbPublication = mysqli_num_rows($TableAllOeuvres);

 for($i=0; $i<$nbPublication; $i++){
     $data = mysqli_fetch_array($TableAllOeuvres);

     // Récupération des données de la table Publications
     $nbLike = $data['nbLike'];
     $date = $data['date'];

     // Récupération des données de la table Oeuvres
     $idOeuvre=$data['idOeuvre'];
     $titre=$data['titre'];
     $auteur=$data['auteur'];
     $lien=$data['lien'];

     // Récupération des données de la table Utilisateurs
     $prenomUtilisateur=$data['prenom'];
     $nomUtilisateur=$data['nom'];

     // Récupération des données de la table Categories
     $nomCategorie=$data['nomCategorie'];

     // Création du tableau pour la préparation json
     $reponsePubli[] = array("nbLike"=>$nbLike, "date"=>$date, "idOeuvre"=>$idOeuvre, "titre"=>$titre, "auteur"=>$auteur, "lien"=>$lien, "prenom"=>$prenomUtilisateur, "nom"=>$nomUtilisateur, "categorie"=>$nomCategorie);

 }

$response = $reponsePubli;
echo json_encode($response);

 //Libération de la place mémoire que prend la requête
 // !! A mettre en fin de fichier ça peut créer des bugs !!
 $libere = mysqli_free_result ($TableAllPublication);
 $fini = mysqli_close($connect);

exit();

?>