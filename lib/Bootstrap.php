<?php
define('ROOT', '/Volumes/Sites/framework/');
define('LIB', ROOT . 'lib/');
define('APP', ROOT . 'app/');
ini_set('display_errors', 1);

require_once('lib/Autoloader.php');
$controller = new Core_Controller_Index();
$db = Core_Model_Database::getConnection();