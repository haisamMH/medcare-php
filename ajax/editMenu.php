<?php

include_once dirname(__FILE__) . '/../includes/config.php';

editMenu($pm, filter_input_array(INPUT_POST));

function editMenu($pm, $POST) {
    
  
    $Id = $POST['id'];
    $BrandName = trim($POST['BrandName']);
    $GenericName = trim($POST['GenericName']);
    $Category = trim($POST['Category']);
    $UnitType = trim($POST['UnitType']);
    $UnitDosage = trim($POST['UnitDosage']);
    $SpecialInstruction = trim($POST['SpecialInstruction']);

    try {
        $sql = ("UPDATE items SET `BrandName` = :BrandName, `GenericName`=:GenericName, `Category` = :Category, `UnitType`=:UnitType, `UnitDosage`=:UnitDosage, `SpecialInstruction`=:SpecialInstruction, `UpdatedAt`=:UpdatedAt WHERE Id=:Id");
        $param = array(":BrandName" => $BrandName, ":GenericName" => $GenericName, ":Category" => $Category, ":UnitType" => $UnitType, ":UnitDosage" => $UnitDosage, ":SpecialInstruction" => $SpecialInstruction , ":UpdatedAt" => date("Y-m-d H:i:s") ,":Id"=>$Id);
        if ($pm->run($sql, $param)) {
            echo '1';
        }
    } catch (PDOException $ex) {
        echo $ex->getMessage();
    }
}
