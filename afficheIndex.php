<?php 

// headers
header("Content-Type: application/json; charset=UTF-8");

//Connexion à la base de donnée 'PROJET PHP'
$connect = mysqli_connect ('localhost', 'u690608483_wploo', '"InSpi(Mac)4', 'u690608483_folio') or die ('Messasge de Loonnnnnaaaaa' ) ;
//Codage des caractères utilisés (utf-8 norme web)
$charset = mysqli_set_charset($connect,'utf8');

//Requête SQL pour avoir tous les infos sur la catégorie avec l'$idcat récupéré au dessus
$requeteOeuvres = "SELECT idPublication, nom, prenom, titre, auteur, lien, Oeuvres.idCategorie, nomCategorie FROM `Publications`
                    JOIN Utilisateurs ON Publications.idUtilisateur = Utilisateurs.idUtilisateur
                    JOIN Oeuvres ON Publications.idOeuvre = Oeuvres.idOeuvre
                    JOIN Categories ON Publications.idCategorie = Categories.idCategorie
                    ORDER BY Oeuvres.idOeuvre DESC;";

//Connexion à la table
$TableOeuvre= mysqli_query($connect, $requeteOeuvres) or die (mysqli_error($connect));

//Comptage du nombre de Publications
$nbOeuvre = mysqli_num_rows($TableOeuvre);

//limiter l'affichage à 12 oeuvres de la tableOeuvres mais l'affichage dans l'ordre décroissant se fera au niveau de la requête
for($i=1; $i<=12; $i++){
    $tab = mysqli_fetch_array($TableOeuvre) ;

    // creation d'une couleur aléatoire
    $hex = '#';

    //Create a loop.
    foreach(array('r', 'g', 'b') as $color){
        //Random number between 0 and 255.
        $val = mt_rand(0, 255);
        //Convert the random number into a Hex value.
        $dechex = dechex($val);
        //Pad with a 0 if length is less than 2.
        if(strlen($dechex) < 2){
            $dechex = "0" . $dechex;
        }
        //Concatenate
        $hex .= $dechex;
    }
        
    $id=$tab['idOeuvre'];
    $titre=$tab['titre'];
    $auteur=$tab['auteur'];
    $lien=$tab['lien'];
    $idCategorie=$tab['idCategorie'];
    $categorie = $tab['nomCategorie'];
    $nom = $tab['nom'];
    $prenom = $tab['prenom'];
    //Création tableau pour encodage json
    $TabIndex[$i]=array("id"=>$id, "titre"=>$titre, "auteur"=>$auteur, "lien"=>$lien, "categorie"=>$categorie, "nom"=>$nom, "prenom"=>$prenom, "couleur"=>$hex);
    }
    //Encodage json
    echo json_encode($TabIndex);

//Libération de la place mémoire que prend la requête
// !! A mettre en fin de fichier ça peut créer des bugs !! 
$libere = mysqli_free_result($TableOeuvres);

$fini = mysqli_close($connect);

exit();

?>