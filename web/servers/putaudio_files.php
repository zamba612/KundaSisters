<?php
$produitNAME = "Web Mobile Top-Up";
$produitMarque = "ZambaApple TM";
$produitNumber = "";
$proprietaire = "MANTEMO TUSIAMINA";
$Lieu = "TOUTRY-FRANCE";
$editeur = "Bob Mantemo Tusiamina";
$partenaire = "reloadly.com";
$adresse = "1 Rue Philippe Bouhey, 21460 Toutry-France, customers services";
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Banque du peuple</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

        <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>

        <script src="https://cdn.datatables.net/select/1.3.3/js/dataTables.select.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script> 
        <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>

        <script src="https://marcusvi200.github.io/list-array/script/ListArray.js"></script>

 <script type="text/javascript">
            function preback() {
                window.history.forward();
            }
            setTimeout("preback()", 0);
            window.onunload = function () {
                null
            }
        </script>
        <style>
            .button {
                background-color: #0000CC; /* Green */
                border: none;
                color: white;
                padding: 10px 20px;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                font-size: 10px;
            }   
            .button1 {
                background-color: #CC0000; /* Green */
                border: none;
                color: white;
                padding: 10px 20px;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                font-size: 10px;
            } 
            .button2 {
                background-color: #1a2226; /* Green */
                border: none;
                color: white;
                padding: 10px 20px;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                font-size: 10px;
            }  
            .button3 {
                background-color: #0E993C; /* Green */
                border: none;
                color: white;
                padding: 10px 20px;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                font-size: 10px;
            } 
        </style>


    </head>
    <body>
        <div class="jumbotron text-center">
            <h1>Kunda Sisters</h1>
            <p>Albums </p>

            <div id="response"></div>

        </div>

        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <h3>
                        <p><strong id="rechargement"></strong>

                        </p>


                    </h3>

                    <p>  

                    </p>
                </div>
                <!--                <form class="col-sm-4" action="insertAlbum.php" method="POST">-->
                <div class="col-sm-4">

                    <p>

                    <p>Créer un dossier de l'album</p>
                    <p>Faire suivre par plusieurs utilisateurs de la plateforme: 
                    <div>
                        <article>N'oubliez pas de joindre un fichier dans le but d'augmenter le nombre d'utilisateurs </article>
                        <label for="name">Le titre de l'album </label>
                        <input class="form-control" type="text" name="TitreAlbum" id="TitreAlbum" />   
                    </div>


                    <div>
                        <label for="name">Nombre des titres</label>
                        <input class="form-control" type="number" name="nombreTitres" id="nombreTitres" />

                    </div>
                    <div>
                        <label for="categorie">Catégorie</label>
                        <select  class="form-control"  id="categorie" name="categorie">
                            <option>Select</option>
                            <option value="Musique Chretienne">Musique Chretienne</option>
                        </select>


                    </div>
                    <div>
                        <label for="postnom">Duration</label>
                        <input class="form-control"  type="number" id="duration" name="duration" />

                    </div>

                    <div>
                        <label for="motif">Description</label>
                        <textarea class="form-control" id="description" name="description" ></textarea>
                    </div>
                    <div>
                        <label for="datedemande">Année de publication</label>
                        <input class="form-control" type="number" id="annedepub" name="annedepub"/>

                    </div>
                    <div>
                        <label for="datedemande"></label>
                        <button type="submit"   id="creerledossier"  class="button1 form-control senddata">Créer un dossier </button>

                    </div>

                    </p>
                    <p>
                </div>
                <!--            </form>-->
                <div class="col-sm-4" id="send-details">
                    <h3>
                        <p></p>
                        <p></p>
                    </h3>        
                   
                </div>
            </div>
        </div>
        <footer>

        </footer>
        <script>

            $(document).ready(function () {

                $(document).on("click", ".senddata", function () {
                   
                    var titre = document.getElementById("TitreAlbum").value;
                    var nombretitre = document.getElementById("nombreTitres").value;
                    var duration = document.getElementById("duration").value;
                    var description = document.getElementById("description").value;
                    var annedepub = document.getElementById("annedepub").value;
                    var categorie = document.getElementById("categorie").value;
                    
                    if (titre != '' && nombretitre != '' && duration != '' && description != '' && annedepub != '' && categorie != '') {
                         
                        $.ajax({
                            url: "http://localhost/KundaSistersByPostGres/web/servers/insertAlbum.php",
                            method: "POST",
                            data: {titre: titre, nombretitre: nombretitre, duration: duration, description: description, annedepub: annedepub, categorie: categorie},
                            success: function (data) {
                                window.alert(data);
                                data = $.parseJSON(data);
                                var Server_lan_connected = data.Server_lan_connected;
                                var Data_Set_or_Update_response = data.Data_Set_or_Update_response;
                                var Server_lan_closed = data.Server_lan_closed;

                                if (Data_Set_or_Update_response == "Error updating record: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near '' at line 1") {
                                    $("#response").html("<label class=\"form-control\">Server: " + Server_lan_closed + " <strong class=\"alert-danger\">Data didn't not set:Remplir toutes les cases correctement </strong>after closed :" + Server_lan_connected + "</label>");
                                } else if (Data_Set_or_Update_response == "Error updating record: Column count doesn't match value count at row 1") {
                                    $("#response").html("<label class=\"form-control\">Server: " + Server_lan_closed + " <strong class=\"alert-danger\">Data didn't not set: recommencer  avec le format compatible </strong>after closed :" + Server_lan_connected + "</label>");
                                } else if (Data_Set_or_Update_response == "Error updating record: Duplicate entry '" + titre + "' for key 'cardID'") {
                                    $("#response").html("<label class=\"form-control\">Server: " + Server_lan_closed + " <strong class=\"alert-danger\">Data didn't not set: Vous avez une demande en cours***** </strong>after closed :" + Server_lan_connected + "</label>");
                                  
                                } else {
                                    $("#response").text("Server: " + Server_lan_closed + " Data set:" + Data_Set_or_Update_response + " after closed :" + Server_lan_connected);
                                 location.href = "index.php?page=putfile&titre=" + titre;
                               }

                            }

                        });

                        setInterval(function () {
                            $('#response').html('');
                        }, 5000);
                    } else {
                        $("#response").text("Server: false Data set:false after closed : false");
                    }

                });

            });
        </script>

    </body>

</html>
