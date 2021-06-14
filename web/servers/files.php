
<?php

if (isset($_FILES['file']['name']) && $_FILES['file']['name'] != '') {
    $name = $_FILES['file']['name'];
    $targetDir = "../fileNames/";
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

            if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)) {
                $response = $files_recorder->insert_new_file("fichiers_audios", $_GET['chanson'], $_GET['album'], $fileName);
                echo json_encode($response);
            }
        }
    } else {
        echo 'format';
    }
}
   