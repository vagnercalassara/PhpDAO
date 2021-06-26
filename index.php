<?php 

require_once("config.php");


$sql = new SQL();
$modelos = $sql->select("SELECT * FROM TB_MODELO");
echo json_encode($modelos);

 ?>