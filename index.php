<?php 

require_once("config.php");

$Usuario = new Usuario();

//$Usuario->loadById(1);

//echo json_encode($Usuario->getList());

//$Usuario->login("vagnercalassara@gmail.com","1");

echo json_encode($Usuario->search("vag"));

//echo $Usuario;


 ?>