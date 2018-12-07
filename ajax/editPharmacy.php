<?php

include_once dirname(__FILE__) . '/../includes/config.php';

Signup($pm, filter_input_array(INPUT_POST));

function Signup($pm, $POST) {

    $PharmacyId = trim($POST['id']);
    $PharmacyName = trim($POST['PharmacyName']);
    $title = trim($POST['title']);
    $name = trim($POST['name']);
    $email = trim($POST['email']);
    $number = trim($POST['number']);
    $address = trim($POST['address']);
    $code = md5(uniqid(rand()));


    $sql = ("SELECT * FROM pharmacy WHERE UserEmail=:UserEmail");
    $param = (array(":UserEmail" => $email));
    $row = $pm->run($sql, $param);

    if (count($row) > 0 || count($row) == 1) {
        if (count($row) == 1) {
            if ($row[0]['PharmacyID'] == $PharmacyId) {
                $sql = ("Update pharmacy SET `PharmacyName`=:PharmacyName,`UserTitle` =:UserTitle , `UserName`=:UserName, `UserEmail`=:UserEmail, `UserPhone`=:UserPhone, `UserAddress`=:UserAddress WHERE PharmacyID=:PharmacyID");
                $param = (array(":PharmacyName" => $PharmacyName, ":UserTitle" => $title, ":UserName" => $name, ":UserEmail" => $email, ":UserPhone" => $number, ":UserAddress" => $address, "PharmacyID" => $PharmacyId));
                if ($pm->run($sql, $param)) {
                    echo '2';
                } else {
                    echo '3';
                }
            } else {
                echo '1';
            }
        } else {
            echo '1';
        }
    } else {

        $sql = ("Update pharmacy SET `PharmacyName`=:PharmacyName,`UserTitle` =:UserTitle , `UserName`=:UserName, `UserEmail`=:UserEmail, `UserPhone`=:UserPhone, `UserAddress`=:UserAddress WHERE PharmacyID=:PharmacyID");
        $param = (array(":PharmacyName" => $PharmacyName, ":UserTitle" => $title, ":UserName" => $name, ":UserEmail" => $email, ":UserPhone" => $number, ":UserAddress" => $address, "PharmacyID" => $PharmacyId));
        if ($pm->run($sql, $param)) {
            echo '2';
        } else {
            echo '3';
        }
    }
}
