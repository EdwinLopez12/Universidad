<?php

  /**
   *
   */
  class Factura{

    public function paginar()
    {
      $rows = NULL;
      $contador = 0;
      $modelo = NEW Conexion();
      $conexion = $modelo->getConexion();
      $sql = "SELECT * FROM ventas";
      $statement = $conexion->prepare($sql);
      $statement->execute();
      $tamano_paginas = 5; //Numero de registros por pagina
      $pagina = 1;      //Pagina principal
      if(isset($_GET["pagina"])){
        if($_GET["pagina"]==1){
          //header("Location: index.php?pagina=1");
        }else{
          $pagina = $_GET["pagina"];
        }
      }else{
        $pagina=1;
      }
      $empezar_desde =(($pagina-1 )*$tamano_paginas); //registro desde el que se empieze dependiendo de la pagina;
      $num_filas = $statement->rowcount(); //Saber el total de registros
      $total_paginas =ceil($num_filas / $tamano_paginas);//ceil redondea el resultado.
      //$posicion = (int)$_GET['pagina'];
      echo "<strong>".$pagina." de ".$total_paginas." </strong>";
      echo " <nav aria-label='Page navigation example'>";
      echo  " <ul class='pagination justify-content-center'>";
      echo    "<li class='page-item'>";
      if($pagina>=2){
        $o = 1;
        echo "<a class='page-link' href='?pagina=1' tabindex='-1'>Primero</a>";
        echo "</li>";
      }
      for($i=1;$i<=$total_paginas;$i++)
      {
        echo "<li class='page-item'><a class='page-link' href='?pagina=".$i."'>".$i."</a></li>";
      }
      if($pagina < ($total_paginas))
      {
        echo "<a class='page-link' href='?pagina=".($total_paginas)."'>Ultimo</a>  ";
      }
      echo "</li></ul></nav>";
       echo "<br><br>";
    }

    public function index(){
      $rows = NULL;
      $contador = 0;
      $modelo = NEW Conexion();
      $conexion = $modelo->getConexion();
      $sql = "SELECT id_venta, fecha, nombre_usuario, valor_total FROM ventas INNER JOIN usuarios AS a ON ventas.id_usuario = a.id_usuario";
      $statement = $conexion->prepare($sql);
      $statement->execute();

      $tamano_paginas = 5; //Numero de registros por pagina
      $pagina = 1;      //Pagina principal
      if(isset($_GET["pagina"])){
        if($_GET["pagina"]==1)
        {
          //header("Location: index.php?pagina=1");
        }else{
          $pagina = $_GET["pagina"];
        }
      }else{
        $pagina=1;
      }
      $empezar_desde =(($pagina-1 )*$tamano_paginas); //registro desde el que se empieze dependiendo de la pagina;
      $num_filas = $statement->rowcount(); //Saber el total de registros
      $total_paginas =ceil($num_filas / $tamano_paginas);//ceil redondea el resultado.
      //$posicion = (int)$_GET['pagina'];
      $sql_limit = "SELECT id_venta, fecha, nombre_usuario, valor_total FROM ventas INNER JOIN usuarios AS a ON ventas.id_usuario = a.id_usuario LIMIT $empezar_desde,$tamano_paginas";
      $statement = $conexion->prepare($sql_limit);
      $statement->execute();

      while($resultado = $statement->fetch()){
        $contador +=1;
  			$rows[] = $resultado;
  		}
      if ($contador == 0) {
        return false;
      }else{
        return $rows;
      }
    }

    public function listarProductos(){
      $rows = NULL;
      $contador = 0;
      $modelo = NEW Conexion();
      $conexion = $modelo->getConexion();
      $sql = "SELECT id_producto, nombre_producto, descripcion, foto, cantidad, valor FROM productos WHERE cantidad > 0";
      $statement = $conexion->prepare($sql);
      $statement->execute();

      while($resultado = $statement->fetch()){
        $contador +=1;
        $rows[] = $resultado;
      }
      if ($contador == 0) {
        return false;
      }else{
        return $rows;
      }
    }

    public function mostrar($id){
      $modelo = new Conexion();
      $conexion = $modelo->getConexion();
      $sql = "SELECT * FROM productos WHERE id_producto = :id";
      $statement = $conexion->prepare($sql);
      $statement->bindParam(':id',$id);
      $statement->execute();
      $resultado= $statement->fetchAll();
      return $resultado;
    }

    public function search_productos($nombre){
      $contador = 0;
      $modelo = NEW Conexion();
      $conexion = $modelo->getConexion();
      $dato = "%".$nombre."%";
      $sql = "SELECT * FROM productos WHERE nombre_producto LIKE :dato OR descripcion LIKE :dato OR valor LIKE :dato AND cantidad > 0 ORDER BY nombre_producto DESC";
      $statement = $conexion->prepare($sql);
      $statement->bindParam(':dato', $dato);
      $statement->execute();

      while($resultado = $statement->fetch()){
        $contador +=1;
        $rows[] = $resultado;
      }
      if ($contador == 0) {
        return false;
      }else{
        return $rows;
      }
    }

    public function search_fac($parametro){
      $contador = 0;
      $modelo = NEW Conexion();
      $conexion = $modelo->getConexion();
      $dato = "%".$parametro."%";
      $sql = "SELECT *, nombre_usuario, email FROM ventas INNER JOIN usuarios ON ventas.id_usuario = usuarios.id_usuario WHERE fecha LIKE :dato OR valor_total LIKE :dato OR nombre_usuario LIKE :dato OR email LIKE :dato ORDER BY id_venta DESC";
      $statement = $conexion->prepare($sql);
      $statement->bindParam(':dato', $dato);
      $statement->execute();

      while($resultado = $statement->fetch()){
        $contador +=1;
        $rows[] = $resultado;
      }
      if ($contador == 0) {
        return false;
      }else{
        return $rows;
      }
    }

    public function search_factura($id)
    {
      // code...
    }

    public function save_venta($horario, $total, $usuario){
      $modelo = new Conexion();
      $conexion = $modelo->getConexion();
      $sql = "INSERT INTO ventas(fecha, valor_total,id_usuario) VALUES(:fecha,:total,:usuario)";
      $statement = $conexion->prepare($sql);
      $statement->bindParam(':fecha',$horario);
      $statement->bindParam(':total',$total);
      $statement->bindParam(':usuario',$usuario);


      if(!$statement){
        return false;
      }else{
        $statement->execute();
        return true;
      }
    }

    public function getVenta($fecha){
      $modelo = new Conexion();
      $conexion = $modelo->getConexion();
      $sql = "SELECT id_venta FROM ventas WHERE fecha = :fecha";
      $statement = $conexion->prepare($sql);
      $statement->bindParam(':fecha',$fecha);
      $statement->execute();
      $resultado= $statement->fetch();
      return $resultado['id_venta'];
    }

    public function save_factura($producto, $venta, $cantidad){
      $modelo = new Conexion();
      $conexion = $modelo->getConexion();
      $sql = "INSERT INTO producto_ventas(id_producto, id_venta,cantidad_vendidos) VALUES(:producto,:venta,:cantidad)";
      $statement = $conexion->prepare($sql);
      $statement->bindParam(':producto',$producto);
      $statement->bindParam(':venta',$venta);
      $statement->bindParam(':cantidad',$cantidad);


      if(!$statement){
        return false;
      }else{
        $statement->execute();
        return true;
      }
    }

    public function updateProducto($producto, $cantidad, $antigua){
      $modelo = NEW Conexion();
      $conexion = $modelo->getConexion();
      $nueva_cantidad = $antigua - $cantidad;
      $sql = "UPDATE productos SET cantidad = :cantidad WHERE id_producto =:id";
      $statement = $conexion->prepare($sql);
      $statement->bindParam(':cantidad',$nueva_cantidad);
      $statement->bindParam(':id',$producto);

      if(!$statement){
        return false;
      }else{
        $statement->execute();
        return true;
      }
    }

  }

  // $r = "SELECT ventas.id_venta, fecha, nombre_usuario, nombre_producto, producto_ventas.cantidad,  valor_total from ventas inner join usuarios as a on ventas.id_usuario = a.id_usuario inner join producto_ventas as b on venta.id_venta = b.id_venta inner join productos as c on b.id_producto = c.id_producto;"
 ?>


<!-- select id_venta, fecha, nombre_usuario, nombre_producto, valor_total from usuarios inner join ventas on usuarios.id_usuario = ventas.id_usuario;



obtiene la factura con los elementos

select ventas.id_venta, fecha, nombre_usuario, nombre_producto, valor, cantidad_vendidos, valor_total from usuarios inner join ventas on usuarios.id_usuario = ventas.id_usuario
inner join producto_ventas on ventas.id_venta = producto_ventas.id_venta
inner join productos on producto_ventas.id_producto = productos.id_producto
where usuarios.id_usuario = 1
; -->
