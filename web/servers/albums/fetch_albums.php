<?php
require '../../../vendor/autoload.php';
use Netas\KundaSisters\albums;

$albums=new albums();

$data = array();

$row = $albums->
    $sub_array = array();
    $sub_array[] = '<div>' . $row["id"] . '</div>';
    $sub_array[] = '<div>' . $row["titre"] . '</div>';
    $sub_array[] = '<div>' . $row["nbredestitres"] . '</div>';
    $sub_array[] = '<div>' . $row["categorie"] . '</div>';
    $sub_array[] = '<div>' . $row["duration"] . '</div>';
    $sub_array[] = '<div>' . $row["visitors"] . '</div>';
    $sub_array[] = '<div>' . $row["annedepub"] . '</div>';
    $sub_array[] = '<button class="btn btn-success btn-xs" onclick="fetch_data()" id="showTitres" data-titre="' . $row["titre"] . '">voir ses ' . $row["nbredestitres"] . ' titres</button> ';
    $data[] = $sub_array;


function get_all_data($connect) {
    $query = "SELECT * FROM `albums`";
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