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

//---------------------------------------------
// Partie AJOUT bdd UTILISATEURS
//---------------------------------------------

//Connexion à la base de donnée
$connect= mysqli_connect ('localhost', 'u690608483_wploo', '"InSpi(Mac)4', 'u690608483_folio') or die ('Messasge de Loonnnnnaaaaa' ) ;

//Codage des caractères utilisés (utf-8 norme web)
$charset = mysqli_set_charset($connect,'utf8');

//Requête SQL pour avoir toutes les données de la table Utilisateurs
$requeteNoms = "SELECT * FROM `Utilisateurs`";

//Connexion à la table 'Utilisateurs'
$TableNoms = mysqli_query($connect, $requeteNoms) or die (mysqli_error($connect));

//Comptage du nombre d'utilisateurs
$nbNoms = mysqli_num_rows($TableNoms);

//Je crée un tab pour chaque valeur de la tab Utilisateurs
for ($i=1; $i<=$nbNoms; $i++) {
    $tab = mysqli_fetch_array ($TableNoms) ;
    
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
    //Requête SQL pour avoir insérer un nouvel utilisateur
    $requeteNewU = "INSERT INTO `Utilisateurs` (`nom`, `prenom`)
    VALUES ('$nom', '$prenom')";

    if (mysqli_query($connect, $requeteNewU)) {
        //echo "New record created successfully";
        //---------------------------------
        //Doit permettre de récupérer l'id du nouvel Utilisateur créé
        $idU = mysqli_insert_id($connect);

    } else {
        echo "Error: " . $requeteNewU . "<br>" . mysqli_error($connect);
    }
}


//Libération de la place mémoire que prend la requête
// !! A mettre en fin de fichier ça peut créer des bugs !!
$libere = mysqli_free_result ($TableNoms);

$requeteCats = "SELECT * FROM `Categories`";

//Connexion à la table 'Categorie'
$TableCats = mysqli_query($connect, $requeteCats) or die (mysqli_error($connect));

//Comptage du nombre de 'nomCategorie' présents dans la table 'Categories'
$nbCats = mysqli_num_rows($TableCats);

for ($i=1; $i<=$nbCats; $i++) {
    $tabCat = mysqli_fetch_array ($TableCats) ;
    
    $idCat[$i]=$tabCat['idCategorie'];
    $nomCat[$i]=$tabCat['nomCategorie'];

    // Je compare les valeurs de la bdd et les valeurs rentrée dans le formulaire
    // Si les deux valeurs sont égales je récupère l'id de la catégorie
    if(strcasecmp($nomCat[$i], $categorie) == 0){
        $idCategorie = $idCat[$i];
        $nomCategorie = $nomCat[$i];
    }
}
      
//Libération de la place mémoire que prend la requête
// !! A mettre en fin de requête ça peut créer des bugs !!
$libere = mysqli_free_result ($TableCats);

// Il faut récupérer toutes les données de la table oeuvre pour savoir si l'oeuvre est déjà présente dans la bdd
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
    // Si les deux valeurs sont égales je récupère l'id de la oeuvre
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

// Récupération de la date :
$date = date('2020-m-d');

// Requête d'insertion dans la table Publications des données récupérées
$requetePublication = "INSERT INTO `Publications`( `date`, `nbLike`,`idCategorie`, `idUtilisateur`, `idOeuvre`)
VALUES ('$date', '0' ,'$idCategorie', '$idU', '$idOeuvre')";

if (mysqli_query($connect, $requetePublication)) {
    // echo "New record created successfully";
    // Récupère le dernier id
    $idPubli = mysqli_insert_id($connect);
    $retour = json_encode(array("titre"=>$titre, "auteur"=>$auteur, "lien"=>$lien, "nom"=>$nom, "prenom"=>$prenom, "categorie"=>$nomCategorie, "idPubli"=>$idPubli));
    echo $retour;
} else {
    echo "Error: " . $requetePublication . "<br>" . mysqli_error($connect);
}

$fini = mysqli_close($connect);

exit();

?>