<?php 
    
    //Connexion à la base de donnée 'PROJET PHP'
    $connect= mysqli_connect ('localhost', 'u690608483_wploo', '"InSpi(Mac)4', 'u690608483_folio') or die ('Messasge de Loonnnnnaaaaa' ) ;

    //Codage des caractères utilisés (utf-8 norme web)
    $charset=mysqli_set_charset($connect,'utf8');
    
    //Requête SQL pour avoir tous les publications
    $requeteNBOeuvres = "SELECT *, nom, prenom, titre, auteur, lien, Oeuvres.idOeuvre, Oeuvres.idCategorie FROM `Publications`
                        JOIN Utilisateurs ON Publications.idUtilisateur = Utilisateurs.idUtilisateur
                        JOIN Oeuvres ON Publications.idOeuvre = Oeuvres.idOeuvre;";
        
    //Connexion à la table
    $TableNBOeuvres= mysqli_query($connect, $requeteNBOeuvres) or die (mysqli_error($connect));

    //Comptage du nombre du nombre total de publications présentes
    $nbOeuvre = mysqli_num_rows($TableNBOeuvres);

    for($i=0; $i<$nbOeuvre; $i++){
        $tab = mysqli_fetch_array($TableNBOeuvres) ;

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
            
        $idPubli = $tab['idPublication'];
        $nbLike = $tab['nbLike'];
        $id=$tab['idOeuvre'];
        $titre=$tab['titre'];
        $auteur=$tab['auteur'];
        $lien=$tab['lien'];
        $idCategorie=$tab['idCategorie'];
        $nom = $tab['nom'];
        $prenom = $tab['prenom'];
        //Création tableau pour le json
        $TabCategorie[$i]=array("idPubli"=>$idPubli, "nbLike"=>$nbLike, "id"=>$id, "titre"=>$titre, "auteur"=>$auteur, "lien"=>$lien, "categorie"=>$idCategorie, "nom"=>$nom, "prenom" =>$prenom, "couleur"=>$hex);
    }

    //Encodage json
    echo json_encode(array(($TabCategorie), "nbOeuvre"=>$nbOeuvre));
    
    //Libération de la place mémoire que prend la requête
    // !! A mettre en fin de fichier ça peut créer des bugs !! 
    $libere = mysqli_free_result($TableOeuvres);

    $fini = mysqli_close($connect);
?>