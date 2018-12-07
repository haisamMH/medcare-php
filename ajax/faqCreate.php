<?php

include_once dirname(__FILE__) . '/../includes/config.php';

login($pm, filter_input_array(INPUT_POST));

function login($pm, $POST) {

        $Question = trim($POST['Question']);
        $Answer = trim($POST['Answer']);
        
        try {
            $sql = ("INSERT INTO faq(`Question`, `Answer`,`CreatedAt`, `UpdatedAt`) 
                                                VALUES(:Question, :Answer,:CreatedAt, :UpdatedAt)");
            $param = (array(":Question" => $Question, ":Answer" => $Answer, ":CreatedAt" => date("Y-m-d H:i:s"), ":UpdatedAt" => date("Y-m-d H:i:s")));
            if ($id = $pm->insertAndGetLastRowId($sql, $param)) {
                echo '1';
            }
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
}
