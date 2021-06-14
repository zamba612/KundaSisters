<html>
    <head>
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
        <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>

    </head>
    <body onload="fetch_data()">
        <div id="display"  class="content">


        </div>

        <div class="container box">
            <h1 align="center">Chansons de l'album <?php echo $_GET['titre'] ?><label id="titreAlbum"></label></h1>

            <div class="table-responsive">


                <div align="right">
                    <form action="index.php">
                        <button type="submit" name="add" id="addingtitre" class="btn btn-info">Hide</button>
                    </form>
                </div>
                <br />
                <div id="alert_message"></div>
                <table id="titre_datas" class="table table-bordered table-striped" >
                    <thead>
                        <tr>
                            <th></th>
                            <th>Titre</th>
                            <th>Duration</th>
                            <th>Album</th>
                            <th>description</th>  
                            <th>Audio</th>  
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        require '../../../vendor/autoload.php';

                        use Netas\KundaSisters\single_audio;
                        use Netas\KundaSisters\chansons;
                        $single = new single_audio();
                        $chansons = new chansons();
                      
                        $id = 1;
                        $query = "SELECT * FROM titres_chansons WHERE Album=:Album";
                        $Request = $single->pdo->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                        $Request->execute([':Album' => $_GET['titre']]);
                        while ($row = $Request->fetch(PDO::FETCH_ASSOC)) {
                            $fichiers = $single->single_titre($row["titre"], $row["album"]);
                            $chansons = $fichiers;

                            echo "<tr>";

                            echo '<td>' . $id++ . '</td>';
                            echo '<td>' . $row["titre"] . '</td>';
                            echo '<td>' . $row["duration"] . '</td>';
                            echo '<td>' . $row["album"] . '</td>';
                            echo '<td>' . $row["description"] . '</td>';
                            echo '<td>'
                            . '  <audio controls>
                        <source id="myAudio" src="fileNames/' . $chansons->fileName . '" type="audio/mpeg">
                        Your browser does not support the <code>audio</code> tag.
                    </audio></td>';
                            echo '<td><a class="btn btn-success btn-xs " href="index.php?page=single&chanson=' . $row["titre"] . '&album=' . $row["album"] . '" id="' . $row["id"] . '">';
                            if ($chansons->fileName) {
                                echo "changer un fichier";
                            } else {
                                echo "Ajouter un fichier";
                            }
                            echo '</a></td>';
                            echo '<td><button type="button" name="delete" class="btn btn-danger btn-xs delete" id="' . $row["id"] . '">Delete</button> </td>';
                            echo " </tr>";
                        }
                        ?>

                    </tbody>
                </table>
            </div>
        </div>
        <script type="text/javascript" language="javascript" >



            $(document).ready(function () {

                $(document).on("click", "#myAudio", function () {

                    var x = document.getElementById("myAudio").value;
                    console.log(x);
                });

                function fetch_data()
                {
                    var album = <?php echo $_GET['titre'] ?>;
                    window.alert(album);
                    var dataTable = $('#titre_datas').DataTable({
                        "processing": true,
                        "serverSide": true,
                        "order": [],
                        "ajax": {
                            url: "fetch.php",
                            type: "POST",
                            data: {album: album}
                        }
                    });
                }

                function update_data(id, column_name, value)
                {
                    $.ajax({
                        url: "update.php",
                        method: "POST",
                        data: {id: id, column_name: column_name, value: value},
                        success: function (data)
                        {
                            $('#alert_message').html('<div class="alert alert-success">' + data + '</div>');
                            $('#titre_datas').DataTable().destroy();
                            fetch_data();
                        }
                    });
                    setInterval(function () {
                        $('#alert_message').html('');
                    }, 5000);
                }

                var title = <?php echo $_GET['titre'] ?>;
                $('#addingtitre').click(function () {
                    var html = '<tr>';
                    html += '<td></td>';
                    html += '<td  id="data1">  <input class="form-control"  type="text" id="titre" /></td>';
                    html += '<td  id="data2">  <input class="form-control"  type="time" id="duration" /></td>';
                    html += '<td  id="data3">  <input class="form-control"readonly value="' + title + '"  type="text" id="album" /></td>';
                    html += '<td  id="data1">  <input class="form-control"  type="text" id="description" /></td>';
                    html += '<td id="data1"> </td>';
                    html += '<td><button type="button" name="insert" id="insert" class="btn btn-success btn-xs">Insert</button></td>';
                    html += '</tr>';
                    $('#titre_datas tbody').prepend(html);
                });

                $(document).on('click', '#insert', function () {
                    var titre = document.getElementById('titre').value;
                    var duration = document.getElementById('duration').value;
                    var album = document.getElementById('album').value;
                    var description = document.getElementById('description').value;

                    if (titre != '' && duration != '' && album != '' && description != '')
                    {

                        $.ajax({
                            url: "savefiles.php",
                            method: "POST",
                            data: {titre: titre, duration: duration, album: album, description: description},
                            success: function (data)
                            {
                                data = $.parseJSON(data);

                                $('#alert_message').html('<div class="alert alert-success">' + data['chanson'].titre + '</div>');
                                $('#titre_datas').DataTable().destroy();
                                if (confirm("Titre " + data['chanson'].titre + " de l'album " + data['chanson'].album + " est créé, Vous pouvez ajouter un fichier audio ou video?")) {
                                    location.href = "filesnames.php?chanson=" + data['chanson'].titre + "&" + "album=" + data['chanson'].album;
                                }

                                // {"insert":{"Request_success":true,"Datas_insert":"Success"},"chanson":{"titre":"dgsghfgfg","album":"ee"}}
                                fetch_data();
                            }
                        });
                        setInterval(function () {
                            $('#alert_message').html('');
                        }, 5000);
                    } else
                    {
                        alert("Both Fields is required");
                    }
                });

                $(document).on('click', '.delete', function () {
                    var id = $(this).attr("id");


                    var x = document.getElementById("myAudio").duration;
                    console.log(x);
//                    if (confirm("Are you sure you want to remove this?"))
//                    {
//                        $.ajax({
//                            url: "delete.php",
//                            method: "POST",
//                            data: {id: id},
//                            success: function (data) {
//                                $('#alert_message').html('<div class="alert alert-success">' + data + '</div>');
//                                $('#titre_datas').DataTable().destroy();
//                                fetch_data();
//                            }
//                        });
//                        setInterval(function () {
//                            $('#alert_message').html('');
//                        }, 5000);
//                    }
                });
            });
        </script> 


    </body>
</html>
