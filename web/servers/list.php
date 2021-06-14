<!DOCTYPE html>
<html>
    <head>
        <META HTTP-EQUIV="CONTENT-TYPE" CONTENT="text/html; charset=windows-1252">
        <TITLE>Bilan pr&eacute;visionnel</TITLE>
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
        <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
        <style>
            body
            {
                margin:0;
                padding:0;
                background-color:#f1f1f1;
            }
            .box
            {
                width:1270px;
                padding:20px;
                background-color:#fff;
                border:1px solid #ccc;
                border-radius:5px;
                margin-top:25px;
                box-sizing:border-box;
            }
        </style>
    </head>
    <style>
        ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            overflow: hidden;
            background-color: #333;
        }

        li {
            float: left;
        }

        li a {
            display: block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        li a:hover:not(.active) {
            background-color: #111;
        }

        .active {
            background-color: #4CAF50;
        }
        body{
            padding: 1%;
        }
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
            width: 70%;
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
        input[type=file]{
            width: 100px;
        }
    </style>
    <script>

        $(document).ready(function () {
            $(document).on("click", "#showTitres", function () {
                if (window.XMLHttpRequest) {
                    // code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp = new XMLHttpRequest();
                } else { // code for IE6, IE5
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("showingtitres").innerHTML = this.responseText;
                    }
                }
                var str = $(this).data("titre");
                window.alert(str);
              xmlhttp.open("GET", "titres.php?titre=" + str, true);
              xmlhttp.send();

            });
        });

    </script>
    <body>
  <div class="jumbotron text-center">
            <h1>Kunda Sisters</h1>
            <p>Albums </p>

            <div id="response"></div>

        </div>
        <div id="display"  class="content">


        </div>

        <div class="container box">
            <h1 align="center">Albums</h1>

            <div class="table-responsive">


                <div align="right">
                    <button type="button" name="add" id="add" class="btn btn-info">Ajouter un album Kunda Sisters</button>
                </div>
                <br />
                <div id="alert_message"></div>
                <table id="user_data" class="table table-bordered table-striped " width="100%" >
                    <thead>
                        <tr>
                            <th></th>
                            <th>Titre</th>
                            <th>Duration</th>
                            <th>Album</th>
                            <th>description</th>                           
                            <th>Visiteurs</th>
                            <th>Année de sortie</th>
                            <th></th>
                        </tr>
                    </thead>
                </table>
               
            </div>
            
        </div>
         <div id="showingtitres"></div>
        <script type="text/javascript" language="javascript" >
            $(document).ready(function () {

                fetch_data();

                function fetch_data()
                {

                    var dataTable = $('#user_data').DataTable({
                        "processing": true,
                        "serverSide": true,
                        "order": [],
                        "ajax": {
                            url: "albums.php",
                            type: "POST"
                        }
                    });
                }

                $(document).on("click", "#add", function () {
                    if (confirm("Voulez-vous ajouter un album de Kunda Sisters?"))
                        location.href = "putaudio_files.php";

                });

            });
        </script>
    </body>
</html>

