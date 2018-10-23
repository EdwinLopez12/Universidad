<?php @session_start();
  require_once '../../Modelos/Session.php';
  require_once '../../Controladores/SessionController.php';

  if(isset($_GET['salir'])){
    $salir = $_GET['salir'];
    if($salir){
      salir();
    }
  }

 ?>
