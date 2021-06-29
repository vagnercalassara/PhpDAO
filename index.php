<?php 

require_once("config.php");

//$sql = new SQL();
//$modelos = $sql->select("SELECT * FROM TB_MODELO");
//echo json_encode($modelos);

$Usuario = new Usuario();
$Usuario->loadById(1);
echo $Usuario;

 ?>