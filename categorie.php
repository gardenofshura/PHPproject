<!doctype html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="INSP'IMAC">
        <meta name="author" content="Aloïs Aubert, Nelly Dupuydenus, Loona Gaillard, Clothilde Huvier">
        <link rel="icon" type="image/png" href="./img/icon.png"/>
        <title>INSP'IMAC</title>

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

        <link href="https://fonts.googleapis.com/css2?family=Open+Sans+Condensed:ital,wght@0,300;0,700;1,300&display=swap" rel="stylesheet"> 
        
        <!-- lien vers fichier css -->
        <link rel="stylesheet" href="./css/style.css">
    </head>

    <body>
        <header>
            <!-- Inclusion de la barre de navigation -->
            <?php include_once('./nav.php'); ?>

            <!-- Inclusion de la barre de navigation entre les différentes pages -->
            <?php include_once('./navpages.php'); ?>
        </header>

        <main>
            <div id="container" class="container-fluid">
                <div id="affiche" class="row">
                    <div class="col-md-1 col-sm-4">
                        <h1>
                        <?php
                            //Récupération des valeurs dans la query string
                            $nomCat=$_GET['nomcat'];
                            echo($nomCat);
                        ?>
                            
                        </h1>
                    </div>
                    <div id="afficheBDD" class="row col-md-11 col-sm-8">
                        
                    </div>
                </div>
                <div id="afficheSearch" class='row justify-content-center'>
                </div>
            </div>
            <div id="navpage"></div>
        </main>

        <!-- OBLIGATOIRE pour lancer la page (affichage) dans la nav  -->
        <script src="./js/categorie.js"></script>
        <!-- OBLIGATOIRE pour lancer la recherche dans la nav  -->
        <script src="./js/form.js"></script>
        <!-- OBLIGATOIRE pour lancer la recherche dans la nav  -->
        <script src="./js/like.js"></script>

        <!-- Inclusions de du fichier Js Bootstrap -->
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    </body>
</html>