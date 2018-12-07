<?php

include_once dirname(__FILE__) . '/../includes/config.php';

login($pm, filter_input_array(INPUT_POST));

function login($pm, $POST) {

    $email = trim($POST['email']);
    $password = trim($POST['password']);
    try {
        $sql = ("SELECT * FROM users WHERE UserEmail=:UserEmail");
        $param = (array(":UserEmail" => $email));
        $result = $pm->run($sql,$param);
      
        if (count($result) == 1) {
            $result = $result[0];
             
            if ($result['UserStatus'] == "Y") {
                if ($result['UserPass'] == md5($password)) {
                    $_SESSION['userSession'] = $result;
                    
                     echo '4';
                } else {
                    echo '1';
                }
            } else {
                echo '2';
            }
        } else {
            echo '3';
        }
    } catch (PDOException $ex) {
        echo $ex->getMessage();
    }
}
