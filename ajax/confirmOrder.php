<?php

include_once dirname(__FILE__) . '/../includes/config.php';

confirmOrder($pm, filter_input_array(INPUT_POST));

function confirmOrder($pm, $POST) {

    $OrderId = trim($POST['id']);

    try {
        $sql = ("UPDATE  orders SET `IsConfirmed`=:IsConfirmed,`Updated`=:Updated WHERE Id=:Id");
        $param = array(":IsConfirmed" => 1, ":Updated" => date("Y-m-d H:i:s", time()), ":Id" => $OrderId);
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
