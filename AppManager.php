<?php

class AppManager {

    private static $pm; 
    
    public static function getPM() {
        if (self::$pm === null) {
            include_once dirname(__FILE__).'/PersistanceManager.php';
            self::$pm = new PersistanceManager();
        }
        return self::$pm;
    }
}

?>