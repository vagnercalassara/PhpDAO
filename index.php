<?php 

require_once("config.php");

$Usuario = new Usuario();

//Lista usuario pelo id..
//$Usuario->loadById(55);

// Geração de json dos usuarios
//echo json_encode($Usuario->getList());

//$Usuario->login("vagnercalassara@gmail.com","1");

//Lista os usuarioa pela informãção mencionada..
//echo json_encode($Usuario->search("vag"));


// Inserção...
$Usuario->setTipo_Usuario(1);
$Usuario->setEmail_Usuario("magnifico@gmail.com");
$Usuario->setSenha_Usuario("VVVVvvVa");
$Usuario->setStatus_Usuario(1);
$Usuario->Insert();

echo $Usuario;


 ?>