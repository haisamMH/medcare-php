<?php

include_once dirname(__FILE__) . '/../includes/config.php';

confirmDelivery($pm, filter_input_array(INPUT_POST));

function confirmDelivery($pm, $POST) {

    $OrderId = trim($POST['DOrderId']);

    try {
        $sql = ("UPDATE  orders SET `IsDelivered`=:IsDelivered,`Updated`=:Updated WHERE Id=:Id");
        $param = array(":IsDelivered" => 1, ":Updated" => date("Y-m-d H:i:s", time()), ":Id" => $OrderId);
        $result = $pm->run($sql, $param);

        if ($result) {
            echo '1';
        } else {
            echo '2';
        }
    } catch (PDOException $ex) {
        echo $ex->getMessage();
    }
}
