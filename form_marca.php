<?php
   // Si hay un id por get, recupero los datos de esa marca desde la BD para autocompletar el formulario con los datos de la marca que se quiere editar
   $id = isset($_GET['id']) ? $_GET['id'] : 0;
   require_once 'conexion.php';
   if ($conexion) {

      // Obtener los productos para indicar cuales son aquellos provistos por la marca que se esta editando
      $sql = "select id as id_prod, nombre as nombre_prod from productos order by nombre";
      $productos = mysqli_query($conexion, $sql);
      
      while ($prod = mysqli_fetch_assoc($productos)) {
         extract($prod);
         $campoProductos = $campoProductos . "<input type='checkbox' id='prod$id_prod' name='productos' value='$id_prod'> <label for='prod$id_prod'>$nombre_prod</label> <br>";
      }
      mysqli_free_result($productos);

      $sql = "select * from marcas where id = $id";
      $resultado = mysqli_query($conexion, $sql);
      //var_dump($resultado);
      if ($resultado) {
         $marca = mysqli_fetch_assoc($resultado);
         extract($marca);
         mysqli_free_result($resultado);
         echo "
            <form action='index.php' method='post'>
            
               <input type='hidden' name='accion' value='marcas'>
               <input type='hidden' name='tarea' value='guardar'>
               <input type='hidden' name='id' value='$id'>

               <div>
                  <label for=''>Nombre</label><br>
                  <input type='text' name='nombre' value='$nombre'>
               </div>

               <div>
                  <label>Productos vendidos por esta marca</label>
                  <br>
                  $campoProductos
               </div>

               <div>
                  <input type='submit' value='Aceptar'>
               </div>
         
            </form>
         ";
      } else {
         include '404.html';
      }
   }
?>