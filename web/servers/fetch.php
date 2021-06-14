<?php

$connect = mysqli_connect("localhost", "root", "", "kundasisters");
$columns = array('id', 'titre', 'duration', 'Album', 'description');
$Album = $_POST['album'];
$query = "SELECT * FROM titres_chansons ";

if (isset($Album)) {
    $query .= '
 WHERE Album = "' . $Album . '" 
 OR Album = "' . $Album . '" 
 ';
}

if (isset($_POST["order"])) {
    $query .= 'ORDER BY ' . $columns[$_POST['order']['0']['column']] . ' ' . $_POST['order']['0']['dir'] . ' 
 ';
} else {
    $query .= 'ORDER BY id ASC ';
}

$query1 = '';

if ($_POST["length"] != -1) {
    $query1 = 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}

$number_filter_row = mysqli_num_rows(mysqli_query($connect, $query));

$result = mysqli_query($connect, $query . $query1);

$data = array();
$id=1;
while ($row = mysqli_fetch_array($result)) {
    $sub_array = array();

        $sub_array[] = '<div  class="update" data-id="' . $row["id"] . '" data-column="souscripteur">' . $id++ . '</div>';
        $sub_array[] = '<div contenteditable class="update" data-id="' . $row["id"] . '" data-column="titre">' . $row["titre"] . '</div>';
        $sub_array[] = '<div  class="update" data-id="' . $row["id"] . '" data-column="total_souscrit">' . $row["duration"] . '</div>';
        $sub_array[] = '<div  class="update" data-id="' . $row["id"] . '" data-column="souscripteur">' . $row["Album"] . '</div>';
        $sub_array[] = '<div  class="update" data-id="' . $row["id"] . '" data-column="parts">' . $row["description"] . '</div>';
        $sub_array[] = '<a class="btn btn-success btn-xs " href="filesnames.php?chanson=' . $row["titre"] . '&album=' . $row["Album"] . '" id="' . $row["id"] . '">Lire le titre</a>';
        $sub_array[] = '<button type="button" name="delete" class="btn btn-danger btn-xs delete" id="' . $row["id"] . '">Delete</button> ';
  
    $data[] = $sub_array;
}

function get_all_data($connect) {
    $query = "SELECT * FROM titres_chansons";
    $result = mysqli_query($connect, $query);
    return mysqli_num_rows($result);
}

$output = array(
    "draw" => intval($_POST["draw"]),
    "recordsTotal" => get_all_data($connect),
    "recordsFiltered" => $number_filter_row,
    "data" => $data
);

echo json_encode($output);
?>