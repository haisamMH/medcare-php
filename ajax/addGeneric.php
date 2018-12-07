<?php

include_once dirname(__FILE__) . '/../includes/config.php';

addGeneric($pm, filter_input_array(INPUT_POST));

function addGeneric($pm, $POST) {

        $GenericName = trim($POST['GenericName']);
        
        $results = $pm->run("SELECT * FROM generics_name WHERE GenericName = :GenericName" , array(":GenericName" => $GenericName));
    try {
        if (count($results) > 0) {
            echo '2';
        } else {
            $sql = ("INSERT INTO generics_name(`GenericName`) 
                                                VALUES(:GenericName)");
            $param = (array(":GenericName" => $GenericName));
            if ($id = $pm->insertAndGetLastRowId($sql, $param)) {
                echo '1';
            }
        }
    } catch (PDOException $ex) {
        echo $ex->getMessage();
    }
}
