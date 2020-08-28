<?php
  /**
   * Conexion con la base de datos
   */
  class Conexion{

    public function getConexion(){
      $usuario = 'root';
      $contrasena = '';
      $base_datos = 'carrito_compras';
      $host = 'localhost';

      $conexion = NEW PDO('mysql:host=localhost:3306;dbname=carrito_compras;', $usuario, $contrasena);

      return $conexion;
    }
  }

 ?>
