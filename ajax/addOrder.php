<?php

include_once dirname(__FILE__) . '/../includes/config.php';

addOrderItems($pm, filter_input_array(INPUT_POST));

function addOrderItems($pm, $POST) {
   
    $OredrId = trim($POST['OrderId']);

    try {
        for ($count = 0; $count < count($POST["item_unit"]); $count++) {
            $sql = ("INSERT INTO `order_items`( `OrderId`, `ItemId`, `Qty`, `Price`, `CreatedAt`) VALUES(:OrderId, :ItemId, :Qty,:Price ,:CreatedAt)");
            $param = array(":OrderId" => $OredrId, ":ItemId" => $POST["item_unit"][$count], ":Qty" =>  $POST["item_quantity"][$count], ":Price" =>  $POST["item_name"][$count], ":CreatedAt" => date("Y-m-d H:i:s", time()));
            $pm->insertAndGetLastRowId($sql, $param);
        }
        echo 'ok';
    } catch (PDOException $ex) {
        echo $ex->getMessage();
    }
}
