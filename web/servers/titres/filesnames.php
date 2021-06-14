
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
        <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
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
    <body >
        <?php

        use Netas\KundaSisters\files_recorder;
        use Netas\KundaSisters\single_audio;
        use Netas\KundaSisters\chansons;
        use Netas\KundaSisters\Mysql_Driver;

if (isset($_POST['Loading'])) {


            if (isset($_FILES['file']['name']) && $_FILES['file']['name'] != '') {
                $name = $_FILES['file']['name'];
                $targetDir = "fileNames/";
                // echo "FILES" . $name;
                $fileName = basename($_FILES["file"]["name"]);
                $targetFilePath = $targetDir . $_FILES['file']['name'];
                $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
                $allowTypes = array('mp4', 'avi', '3gp', 'mov', 'mpeg');
                if (in_array($fileType, $allowTypes)) {
                    if (($_FILES['file']['size'] >= 595623261 ) || ($_FILES['file']['size'] == 0)) {
                        
                    } else {

                        if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)) {
                            $response = $files_recorder->insert_new_file("fichiers_videos", $_GET['chanson'], $_GET['album'], $fileName);
                            echo json_encode($response);
                        }
                    }
                }
            }
        } else {
            //  echo "Files failed";
        }
        if (isset($_POST['AudioLoading'])) {

            if (isset($_FILES['file']['name']) && $_FILES['file']['name'] != '') {
                $name = $_FILES['file']['name'];
                $targetDir = "fileNames/";
                //echo "FILES" . $name;
                $fileName = basename($_FILES["file"]["name"]);
                $targetFilePath = $targetDir . $_FILES['file']['name'];
                $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
                $allowTypes = array('mp3', 'wav', 'ogg', 'vma', 'mid', 'mpeg');
                if (in_array($fileType, $allowTypes)) {
                    if (($_FILES['file']['size'] >= 41943040 ) ||
                            ($_FILES['file']['size'] == 0)) {
                        echo "Limit is" + 41943040;
                    } else {
                        echo "prepared 1";
                        if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)) {
                            $files_recorder = new files_recorder();
                            $single = new single_audio();
                            $driv=new Mysql_Driver();
                            echo $fileName;
                            echo json_encode($single->pdo);

                            try {       
                                $sql = "INSERT INTO fichiers_audios (titre_chanson, titrealbum, filename) VALUES (:titre_chanson,:titrealbum,:filename)";
                                $stmt = $single->pdo->prepare($sql);
                                $stmt->execute(array(':titre_chanson' => $_GET['chanson'], ':titrealbum' => $_GET['album'], ':filename' => $fileName));
                                $publisher_id = $single->pdo->lastInsertId();
                                $response = $publisher_id;
                            } catch (PDOException $th) {
                                $response = $th->getMessage();
                            }
                            echo json_encode($response);
                        }
                    }
                } else {
                    echo 'format';
                }
            }
        } else {
            //  echo "Files failed";
        }
        ?>
        <div class="jumbotron text-center">
            <h1>Kunda Sisters</h1>
            <p>Albums </p>

            <div id="response"></div>

        </div>

        <div class="container">
            <div class="row">
                <a href="index.php?page=Albums">Albums</a>
                <div class="col-sm-4 row">
                    <h3>
                        <p>VIDEO</p>

                    </h3>
                    <form action="index.php?page=single&?Loading=Loading&chanson=<?php echo $_GET['chanson'] ?>&album=<?php echo $_GET['album'] ?>" method="POST" enctype="multipart/form-data">
                        <input type="file" name="file" id="file" class="form-control"/>
                        <button type="submit" name="Loading" id="videoplayerbtn" class="form-control">VIDEO TEST</button>
                        <p>
                            <?php
                            $conn = mysqli_connect("localhost", "root", "", "kundasisters");
                            $query = "SELECT * FROM fichiers_videos WHERE titre_chanson='" . $_GET['chanson'] . "' AND titreAlbum='" . $_GET['album'] . "'";

                            if ($result = mysqli_query($conn, $query)) {
                                if ($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                    <video autoplay="true" id="videoplayer"  src="fileNames/<?php echo $row['fileName'] ?>"  width="960px" height="1010px" controls="true"></video>
                                    <?php
                                }
                            }
                            ?>

                        </p>
                    </form>
                </div>

                <div class="col-sm-4">
                    <h3>
                        <p>AUDIO</p>

                    </h3>
                    <p>
                    <form action="http://localhost/KundaSistersByPostGres/web/index.php?page=single&chanson=<?php echo $_GET['chanson'] ?>&album=<?php echo $_GET['album'] ?>" method="POST" enctype="multipart/form-data">
                        <input type="file" name="file" id="file" class="form-control"/>
                        <button type="submit" name="AudioLoading" id="videoplayerbtn" class="form-control">VIDEO TEST</button>
                        <p>
                            <?php
                            $files_recorder = new files_recorder();
                            $single = new single_audio();
                            $chansons = new chansons();
                            $chansons = $single->single_titre($_GET['chanson'], $_GET['album']);
                            ?>
                            <audio controls autoplay="true" >
                                <source src="fileNames/<?php echo $chansons->fileName ?>" type="audio/mpeg">
                                Your browser does not support the <code>audio</code> tag.
                            </audio>

                            <?php
                            ?>

                        </p>
                    </form>
                    <button id="duration">Try it</button>
                    <p>



                    <div>

                    </div>

                    </p>
                    <p>
                </div>
                <!--            </form>-->
                <div class="col-sm-4" id="send-details">
                    <h3>
                        <p>PHOTOS</p>

                    </h3>        

                </div>
            </div>
        </div>
        <footer>

        </footer>
        <script>

            $(document).ready(function () {
//                $(document).on("click", "#videoplayerbtn", function () {
//                    var videoplayer = document.getElementById("videoplayer");
//                    window.alert(videoplayer.name);
//
//                });
                $(document).on("click", "#duration", function () {
                    var id = $(this).attr("id");

                    console.log(id);
                    var x = document.getElementById("myAudio");
                    console.log(x);
                });

                $(document).on("click", ".senddata", function () {
                    alert();
                    var titre = document.getElementById("TitreAlbum").value;
                    var nombretitre = document.getElementById("nombreTitres").value;
                    var duration = document.getElementById("duration").value;
                    var description = document.getElementById("description").value;
                    var annedepub = document.getElementById("annedepub").value;
                    var categorie = document.getElementById("categorie").value;
                    if (titre != '' && nombretitre != '' && duration != '' && description != '' && annedepub != '' && categorie != '') {
                        $.ajax({
                            url: "insertAlbum.php",
                            method: "POST",
                            data: {titre: titre, nombretitre: nombretitre, duration: duration, description: description, annedepub: annedepub, categorie: categorie},
                            success: function (data) {
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
                                    location.href = "files_put.php?titre=" + titre;
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
