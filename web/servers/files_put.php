


//https://kundasisters.herokuapp.com/
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
    <body>
        <div class="jumbotron text-center" style="background-image: url(fileNames/)">
            <h1>Kunda Sisters</h1>
            <p>Album  <small><?php
                    echo $_GET['titre'];
                    ?></small></p>

            <div id="response"></div>

        </div>

        <div id="display"  class="content">


        </div>

        <div class="container box">
            <h1 align="center">Titres et chansons</h1>

            <div class="table-responsive">


                <div align="right">


                    <button type="button" name="add" id="add" class="btn btn-info">Ajouter des titres de l'album   <?php
                        echo $_GET['titre'];
                        ?></button>
                </div>

                <br />
                <div id="alert_message"></div>

                <table id="user_data" class="table table-bordered table-striped" >
                    <thead>
                        <tr>
                            <th></th>
                            <th>Titre</th>
                            <th>Duration</th>
                            <th>Album</th>
                            <th>description</th>                           
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        require_once '../vendor/autoload.php';

                        use Netas\KundaSisters\single_tire;
                        use Netas\KundaSisters\titres;

                        $single = new single_tire();
                        $albums = new titres();

                        $i = 0;
                        $query = "SELECT * FROM titres_chansons WHERE album=:album";
                        $Request = $single->pdo->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                        $Request->execute([':album' => $_GET['titre']]);
                        while ($result = $Request->fetch(PDO::FETCH_ASSOC)) {
                            ?>
                            <tr>
                                <td> <?php echo $result['id'] ?> </td>
                                <td><?php echo $result['titre'] ?></td>
                                <td><?php echo $result['duration']; ?></td>
                                <td><?php echo $result['album'] ?></td>
                                <td> <?php echo $result['description'] ?></td>
                                <td>  <a class="btn btn-success btn-xs " href="filesnames.php?chanson=<?php echo $result['titre'] ?>&album=<?php echo $result['album'] ?> '" id="<?php echo $result['id'] ?>">Lire le titre</a></td>
                                <td><button type="button" name="delete" class="btn btn-danger btn-xs delete" id="<?php echo $result['id'] ?>">Delete</button> </td>

                            </tr>
                        <?php } ?>

                    </tbody>
                </table>
            </div>
        </div>

    </body>
</html>
<script type="text/javascript" language="javascript" >
    $(document).ready(function () {

        $('#add').click(function () {
            var html = '<tr>';
            html += '<td></td>';
            html += '<td  id="data1">  <input class="form-control"  type="text" id="titre" /></td>';
            html += '<td  id="data2">  <input class="form-control"  type="time" id="duration" /></td>';
            html += '<td  id="data3">  <input class="form-control"readonly value="<?php echo $_GET['titre'] ?>"  type="text" id="album" /></td>';
            html += '<td  id="data1">  <input class="form-control"  type="text" id="description" /></td>';
            html += '<td id="data1"> </td>';
            html += '<td><button type="button" name="insert" id="insert" class="btn btn-success btn-xs">Insert</button></td>';
            html += '</tr>';
            $('#user_data tbody').prepend(html);
        });


        $(document).on('click', '#insert', function () {
            var titre = document.getElementById('titre').value;
            var duration = document.getElementById('duration').value;
            var album = document.getElementById('album').value;
            var description = document.getElementById('description').value;
            window.alert(titre);
            if (titre != '' && duration != '' && album != '' && description != '') {

                $.ajax({
                    url: "http://localhost/KundaSistersByPostGres/web/servers/savefiles.php",
                    method: "POST",
                    data: {titre: titre, duration: duration, album: album, description: description},
                    success: function (data) {
                        data = $.parseJSON(data);
window.alert(data.titre);
                        $('#alert_message').html('<div class="alert alert-success">' + data.titre + '</div>');

                        if (confirm("Titre " + data.titre + " de l'album " + data.album + " est créé, Vous pouvez ajouter un fichier audio ou video?")) {
                            location.href = "index.php?page=single&chanson=" + data.titre + "&" + "album=" + data.album;
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
        fetch_data();

        function fetch_data()
        {

            var dataTable = $('#user_data').DataTable({
                "processing": true,
                "serverSide": true

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
                    $('#user_data').DataTable().destroy();
                    fetch_data();
                }
            });
            setInterval(function () {
                $('#alert_message').html('');
            }, 5000);
        }





        $(document).on('click', '.delete', function () {
            var id = $(this).attr("id");
            if (confirm("Are you sure you want to remove this?"))
            {
                $.ajax({
                    url: "delete.php",
                    method: "POST",
                    data: {id: id},
                    success: function (data) {
                        $('#alert_message').html('<div class="alert alert-success">' + data + '</div>');
                        $('#user_data').DataTable().destroy();
                        fetch_data();
                    }
                });
                setInterval(function () {
                    $('#alert_message').html('');
                }, 5000);
            }
        });
    });
</script>

