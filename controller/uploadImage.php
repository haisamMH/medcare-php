<?php

include_once dirname(__FILE__) . '/../includes/config.php';
upload($pm, filter_input_array(INPUT_POST));
function upload($pm,$POST) {
    $PharmacyID = $POST['PharmacyID'];
    $UserID = $_SESSION['userSession']['UserID'];
    $name = $_FILES['file']['name'];
    $target_dir = "images/";
    $target_file = $target_dir . basename($_FILES["file"]["name"]);

    // Select file type
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Valid file extensions
    $extensions_arr = array("jpg", "jpeg", "png", "gif");

    // Check extension
    if (in_array($imageFileType, $extensions_arr)) {
        
        // Insert record
        $sql = ("INSERT INTO orders(`PharmacyID`,`UserId`, `prescriptionUrl`, `Created`, `Updated`) 
                                                VALUES(:PharmacyID,:UserId, :prescriptionUrl, :Created, :Updated)");
        $param = (array(":PharmacyID" => $PharmacyID,":UserId" => $UserID, ":prescriptionUrl" => $target_file, ":Created" => date("Y-m-d H:i:s"), ":Updated" => date("Y-m-d H:i:s")));
        $id = $pm->insertAndGetLastRowId($sql, $param);

        // Upload file
        move_uploaded_file($_FILES['file']['tmp_name'], "../".$target_dir . $name);

        if ($id>0) {
            header("Location: ../my_orders.php");
        } else {
            header("Location: ../dashboard.php?err=1");
        }
    }
}