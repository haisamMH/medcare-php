<?php

include_once dirname(__FILE__) . '/../includes/config.php';

Signup($pm, filter_input_array(INPUT_POST));

function Signup($pm, $POST) {

    $PharmacyName = trim($POST['PharmacyName']);
    $title = trim($POST['title']);
    $name = trim($POST['name']);
    $email = trim($POST['email']);
    $number = trim($POST['number']);
    $password = md5(trim($POST['password']));
    $address = trim($POST['address']);
    $code = md5(uniqid(rand()));


    $sql = ("SELECT * FROM pharmacy WHERE UserEmail=:UserEmail");
    $param = (array(":UserEmail" => $email));
    $row = $pm->run($sql, $param);

    if (count($row) > 0) {
        echo '1';
    } else {

        $sql = ("INSERT INTO pharmacy(`PharmacyName`,`UserTitle`, `UserName`, `UserEmail`, `UserPhone`, `UserAddress`, `UserPass`, `UserStatus`, `TokenCode`, `CreatedAt`) 
                                                VALUES(:PharmacyName ,:UserTitle, :UserName, :UserEmail, :UserPhone, :UserAddress, :UserPass, :UserStatus, :TokenCode, :CreatedAt)");
        $param = (array(":PharmacyName" => $PharmacyName,":UserTitle" => $title, ":UserName" => $name, ":UserEmail" => $email, ":UserPhone" => $number, ":UserAddress" => $address, ":UserPass" => $password, ":UserStatus" => 'Y', ":TokenCode" => $code, ":CreatedAt" => date("Y-m-d H:i:s")));
        if ($id = $pm->insertAndGetLastRowId($sql, $param)) {           
            echo '2';
        } else {
            echo '3';
        }
    }
}

