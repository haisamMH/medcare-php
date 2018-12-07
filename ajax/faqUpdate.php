<?php

include_once dirname(__FILE__) . '/../includes/config.php';

editfaq($pm, filter_input_array(INPUT_POST));

function editfaq($pm, $POST) {
    
    $Question = $POST['Question'];
    $Answer = $POST['Answer'];
    $Id = $POST['Id'];
    
    try {
        $sql = ("UPDATE faq SET `Question` = :Question, `Answer`=:Answer,`UpdatedAt`=:UpdatedAt WHERE Id=:Id");
        $param = array(":Question" => $Question, ":Answer" => $Answer, ":UpdatedAt" => date("Y-m-d H:i:s") ,":Id"=>$Id);
        if ($pm->run($sql, $param)) {
            echo '1';
        }
    } catch (PDOException $ex) {
        echo $ex->getMessage();
    }
}
