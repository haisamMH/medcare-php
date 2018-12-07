<?php
session_start();
date_default_timezone_set("Asia/Colombo");
require_once dirname(__FILE__).'/../AppManager.php';
$pm = AppManager::getPM();

$page = '';
define("WEBSITE_NAME", "MedCare");
define("SALT", 'Med001');
