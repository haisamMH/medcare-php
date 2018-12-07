<?php

include_once dirname(__FILE__) . '/../includes/config.php';

addBrand($pm, filter_input_array(INPUT_POST));

function addBrand($pm, $POST) {

    $BrandName = trim($POST['BrandName']);
    $results = $pm->run("SELECT * FROM brands WHERE BrandName = :BrandName" , array(":BrandName" => $BrandName));
    try {
        if (count($results) > 0) {
            echo '2';
        } else {
            $sql = ("INSERT INTO brands(`BrandName`) 
                                                VALUES(:BrandName)");
            $param = (array(":BrandName" => $BrandName));
            if ($id = $pm->insertAndGetLastRowId($sql, $param)) {
                echo '1';
            }
        }
    } catch (PDOException $ex) {
        echo $ex->getMessage();
    }
}
