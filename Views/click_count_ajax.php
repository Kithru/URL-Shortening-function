<?php
require_once "../Classes/Classes.php";
$urlid = $_REQUEST["id"];
$classManager = new classmanager();
$result = $classManager->updateclickcount($urlid);
echo $result;
?>