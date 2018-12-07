<?php

include_once dirname(__FILE__) . '/../includes/config.php';

deletefaq($pm, filter_input_array(INPUT_POST));

function deletefaq($pm, $POST) {
    
    $Id = base64_decode($POST['id']);
    
    try {
        $sql = ("DELETE FROM faq  WHERE Id=:Id");
        $param = array(":Id"=>$Id);
        if ($pm->run($sql, $param)) {
            echo '1';
        }
    } catch (PDOException $ex) {
        echo $ex->getMessage();
    }
}
