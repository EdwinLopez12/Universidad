<?php

  if(isset($_POST['email']) && isset($_POST['pass'])){
    require_once '../Modelos/Conexion.php';
    require_once '../Modelos/Session.php';

    $email = $_POST['email'];
    $pass = $_POST['pass'];

    validar_user($email, $pass);
  }

  function validar_user($email, $pass){
    $session = NEW Session();
  	$resultado = $session->control($email, $pass);

    if($resultado){
      header('Location: ../Vistas/Index/index.php');
    }else{
      header('Location: ../Vistas/Index/login.php?estado=0');
    }
  }

  function validar_session(){
    $session = NEW Session();
    $resultado = $session->security();

    if(!$resultado){
      header('Location: login.php');
    }
  }

  function salir(){
    $session = NEW Session();
    $session->exit();
    header('Location: login.php');
  }


 ?>
