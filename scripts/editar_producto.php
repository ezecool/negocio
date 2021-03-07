<?php

// Si le pasamos el parametro id por la URL, guardamos su valor en $id para obtener los datos de ese producto desde la base de datos
$id = $_GET['id'];

if ($id != '') {
   
   /* Este formulario servira tanto para crear un producto nuevo como para editar un producto existente */
   require 'conexion.php';
   if ($conexion) {   
      $sql = "select * from productos where id = $id";
      $resultado = mysqli_query($conexion, $sql);
      if (!$resultado) {
         echo 'No se puede acceder al producto elegido.';
      } else {
         
         $producto = mysqli_fetch_assoc($resultado);
         
         extract($producto);
   
         echo '<h2>Editar producto</h2>';
         include 'form_producto.php';      
      }      
   } else {
      echo 'No se puede acceder a los datos.';
   }
} else {
   echo '<h2>Crear producto</h2>';
   include 'form_producto.php';
}

?>

