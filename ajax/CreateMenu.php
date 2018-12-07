<?php

include_once dirname(__FILE__) . '/../includes/config.php';

login($pm, filter_input_array(INPUT_POST), $_FILES);

function login($pm, $POST, $FILES) {
    $PharmacyID =  $_SESSION['userSession']['PharmacyID'];
    $BrandName = trim($POST['BrandName']);
    $GenericName = trim($POST['GenericName']);
    $Category = trim($POST['Category']);
    $UnitType = trim($POST['UnitType']);
    $UnitDosage = trim($POST['UnitDosage']);
    $SpecialInstruction = trim($POST['SpecialInstruction']);


    try {
        $sql = ("INSERT INTO items(`PharmacyID`,`BrandName`, `GenericName`, `Category`, `UnitType`, `UnitDosage`, `SpecialInstruction`,`CreatedAt`, `UpdatedAt`) 
                                                VALUES(:PharmacyID,:BrandName, :GenericName, :Category, :UnitType, :UnitDosage, :SpecialInstruction, :CreatedAt, :UpdatedAt)");
        $param = (array(":PharmacyID" => $PharmacyID,":BrandName" => $BrandName, ":GenericName" => $GenericName, ":Category" => $Category, ":UnitType" => $UnitType, ":UnitDosage" => $UnitDosage, ":SpecialInstruction" => $SpecialInstruction, ":CreatedAt" => date("Y-m-d H:i:s"), ":UpdatedAt" => date("Y-m-d H:i:s")));
        if ($id = $pm->insertAndGetLastRowId($sql, $param)) {
            echo '1';
        }
    } catch (PDOException $ex) {
        echo $ex->getMessage();
    }
}
