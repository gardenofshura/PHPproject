<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="INSP'IMAC">
    <meta name="author" content="Aloïs Aubert, Nelly Dupuydenus, Loona Gaillard, Clothilde Huvier">
    <link rel="icon" type="image/png" href="./img/icon.png"/>
    <title>INSP'IMAC</title>

    <link href="https://fonts.googleapis.com/css2?family=Open+Sans+Condensed:ital,wght@0,300;0,700;1,300&display=swap" rel="stylesheet"> 

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/publier.css" />
    <!-- <link rel="stylesheet" href="./css/style.css">     -->

</head>

<body>
    <!----------------------Menu ------------------------->
    <header>
        <!-- Inclusions de la barre de navigation -->
        <?php include_once('nav.php'); ?>
    </header>

    <main>
        <div id="container">
          <div class="container" id="affiche">
            <div class="row">
              <!-- <div class="blocForm"> -->
                <form method="post" >
                    <div class="row mb-2">
                      <div class="col">
                        <label for="prenom" class="col-sm-8 control-label">Prénom :</label>
                        <div class="col-sm-12">
                          <input type="text" class="form-control"
                          name="prenom" id="prenom"  required>
                        </div>
                      </div>
                        <div class="col">
                            <label for="nom" class="col-sm-8 control-label">Nom :</label>
                            <div class="col-sm-12">
                              <input type="text" class="form-control"
                              name="nom" id="nom" required>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3 justify-content-center">
                      <div class="col-md-6">
                        <label for="categorie"></label>
                        <select id="formCategorie" class="form-control" required>
                          <!-- <option value="">Catégorie</option> -->
                            <option value="film">Film</option>
                            <option value="serie">Série</option>
                            <option value="musique">Musique</option>
                          </select>
                        </div>
                    </div>

                    <div class="row mb-2">
                      <div class="col">
                          <label for="titre" class="col-sm-8 control-label">Titre de l'oeuvre : </label>
                          <div class="col-sm-12">
                            <input type="text" class="form-control"
                            name="titre" id="titre" required >
                          </div>

                        </div>
                        <div class="col">
                          <label for="auteur" class="col-sm-8 control-label">Artiste de l'oeuvre :</label>
                          <div class="col-sm-12">
                            <input type="text" class="form-control"
                            name="auteur" id="auteur" required >
                          </div>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="lien" class="col-sm-12 control-label">Lien internet ou youtube (iframe) de l'oeuvre :</label>
                      <div class="col-sm-10">
                        <textarea class="form-control"
                        name="lien" id="lien" require=required></textarea>
                      </div>
                    </div>

                    <div class="row mb-3 justify-content-center">
                      <div class="col-xs-1">
                        <button id="publier" type="submit" class="btn btn-outline-light mb-2 ">Publier</button>
                      </div>
                    </div>
                </form>
                <div id="affichePubli"></div>
              <!-- </div> -->
            </div>
          </div>
        </div>

        <div id="afficheSearch" class='row justify-content-center'>
        </div>

    </main>

    <!-- Inclusions de du fichier JS -->
    <script src='./js/publier.js'></script>
    <script src='./js/update.js'></script>
    <script src='./js/supprimer.js'></script>

      <!-- OBLIGATOIRE pour lancer la recherche dans la nav  -->
      <script src="./js/form.js"></script>

    <!-- Inclusions de du fichier Js Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</body>

</html>
