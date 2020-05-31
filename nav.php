<nav class="navbar navbar-expand-lg navbar-light">
  <a class="navbar-brand logo" href="./index.php"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="./index.php">Accueil</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Catégorie
        </a>
        <div class="dropdown-menu">
          <?php  

                //Connexion à la base de donnée 'PROJET PHP'
                $connect= mysqli_connect ('localhost', 'u690608483_wploo', '"InSpi(Mac)4', 'u690608483_folio') or die ('Messasge de Loonnnnnaaaaa' ) ;

                //Codage des caractères utilisés (utf-8 norme web)
                $charset = mysqli_set_charset($connect,'utf8');
                
                //Requête SQL pour avoir tous les noms des catégories ('nomCategorie')
                $requeteCatégorie = "SELECT * FROM `Categories`;";
                
                //Résultats de la table 'Categorie'
                $TableCategorie = mysqli_query($connect, $requeteCatégorie) or die (mysqli_error($connect));

                //Comptage du nombre de 'nomCategorie' présents dans la table 'Categories'
                $nbCategorie = mysqli_num_rows($TableCategorie);
            
        
                //Pour toutes les catégories on crée les liens pour la navigation
                for ($i=1; $i<=$nbCategorie; $i++) {
                    $tab = mysqli_fetch_array ($TableCategorie) ;
                    
                    $idCategorie=$tab['idCategorie'];
                    $nomCategorie=$tab['nomCategorie'];
                    
                    //Action = création de lien
                    echo('<a onclick="clickCategorie()" id="categorie" class="dropdown-item categorie" href="categorie.php?idcat='.$idCategorie.'&nomcat='.$nomCategorie.'">'.$nomCategorie.'</a>');

                }
                        
                //Libération de la place mémoire que prend la requête
                // !! A mettre en fin de fichier ça peut créer des bugs !!
                $libere = mysqli_free_result ($TableCategorie);

                $fini = mysqli_close($connect);
                
            ?>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="./publier.php" tabindex="-1" aria-disabled="true">Publier</a>
      </li>
    </ul>
    <form method="post" class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="text" placeholder="Que recherchez-vous ?" id="recherche">
        <button class="btn btn-outline-info my-2 my-sm-0" id="search" type="submit">Rechercher</button>
    </form>
  </div>
</nav>