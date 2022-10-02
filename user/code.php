<?php
session_start();
define('ROOT_PATH', dirname(__FILE__));
require '../includes/code.class.php';
$_mulin = new ValidateCode();
$_mulin->doimg();
$_SESSION['mulin_code'] = $_mulin->getCode();
?>