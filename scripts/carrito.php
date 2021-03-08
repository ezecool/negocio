<?php

//var_dump($_SESSION['carrito']);
include 'conexion.php';
if ($conexion) {

   // Si existe la variable de sesion carrito, 
   if (isset($_SESSION['carrito'])) {

      // Consulta sql para traer los datos de los productos en el carrito
      $query = 'select id, nombre from productos where id in (0 ';
      foreach ($_SESSION['carrito'] as $id_producto => $cantidad) {
         $query .= ", $id_producto";
      }
      $query .= ') order by nombre';
  //    echo $query;
      $resultado = mysqli_query($conexion, $query);
    //  echo mysqli_num_rows($resultado);
      if ($resultado) {
         while ($prod = mysqli_fetch_assoc($resultado)) {
            $productos[$prod['id']] = $prod['nombre'];
            // echo $prod['id'];
            //var_dump($prod);
         }
      }
      var_dump($productos);

      echo '<h3>Productos elegidos</h3>';
      echo '<table>';
      echo '<tr> <th>Producto</th> <th>Cantidad</th> </tr>';

      // Para cada elemento del array carrito, que esta guardado en la sesion, creamos una fila de tabla para mostrar sus datos

      foreach ($_SESSION['carrito'] as $id_producto => $cantidad) {
            // obtengo la descripcion del producto, usando una funcion declarada en productos.php
            //$nombre = $productos            
            echo "<tr> <td>" . $productos[$id_producto] ."</td> <td>$cantidad</td> </tr>";
      }
      echo '</table>';

   }
}
?>