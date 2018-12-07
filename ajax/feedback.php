<?php

include_once dirname(__FILE__) . '/../includes/config.php';

addFeedback($pm, filter_input_array(INPUT_POST));

function addFeedback($pm, $POST) {

    $message = trim($POST['message']);
    $username = trim($POST['username']);
    $useremail = trim($POST['useremail']);
    try {
        $sql = ("INSERT INTO `feedback`( `UserName`, `UserEmail`, `Feedback`, `CreatedAt`) VALUES(:UserName, :UserEmail, :Feedback, :CreatedAt)");
        $param = array(":UserName" => $username, ":UserEmail" => $useremail, ":Feedback" => $message, ":CreatedAt" => date("Y-m-d H:i:s", time()));
        $result = $pm->insertAndGetLastRowId($sql, $param);

        if ($result > 0) {
            echo '1';
        } else {
            echo '2';
        }
    } catch (PDOException $ex) {
        echo $ex->getMessage();
    }
}
