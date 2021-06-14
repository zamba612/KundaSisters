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

                    <p>Login</p>
                    <p>



                    <div>
                        <label for="name">Username</label>
                        <input class="form-control" type="text" name="username" id="username" />

                    </div>

                    <div>
                        <label for="password">Password</label>
                        <input class="form-control" type="password" placeholder="******"  id="password" name="password"/>

                    </div>
                    <div>
                        <label for="datedemande"></label>
                        <button type="submit"  name="login" id="login"  class="button1 form-control ">login</button>

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
                
                $(document).on("click", "#login", function () {
                    
                    var username = document.getElementById("username").value;
                    var password = document.getElementById("password").value;
                    
                    if (username != '' && password != '') {
                        $.ajax({
                            url: "loggin.php",
                            method: "POST",
                            data: {username: username, password: password},
                            success: function (data) {    
                                data = $.parseJSON(data);                                
                                if (data.resultQuer.Login == "Not login") {
                                    alert(data.Failed);
                                } else if (data.resultQuer.Login == "Login success") {
                                    if (confirm("Success")) {
                                      location.href = "index.php"
                                    }
                                    
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
