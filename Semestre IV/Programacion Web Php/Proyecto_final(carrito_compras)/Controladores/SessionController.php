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
      if($_SESSION['rol'] == 'administrador'){
        header('Location: ../Vistas/Admin/index.php');
      }else{
        // $_SESSION['CARRITO'];
        header('Location: ../Vistas/Cliente/index.php');
      }
    }else{
      $error = "El usuario o la contraseña son incorrectos";
      header('Location: ../Vistas/Index/index.php?error='.$error.'');
    }
  }

  function validar_session(){
    $session = NEW Session();
    $resultado = $session->security();

    if(!$resultado){
      header('Location: index.php');
    }
  }

  function salir(){
    $session = NEW Session();
    $session->exit();
    header('Location: ../Index/index.php');
  }


 ?>
