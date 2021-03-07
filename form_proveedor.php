<?php
   // Si hay un id por get, recupero los datos de esa marca desde la BD para autocompletar el formulario con los datos de la marca que se quiere editar
   $id = isset($_GET['id']) ? $_GET['id'] : 0;
   require_once 'conexion.php';
   if ($conexion) {

      // Obtener las marcas para mostrar o elegir cuales son aquellas provistos por el proveedor que se esta editando
      $sql = "select id as id_marca, nombre as nombre_marca from marcas order by nombre";
      $marcas = mysqli_query($conexion, $sql);

      while ($marca = mysqli_fetch_assoc($marcas)) {
         extract($marca);
         $campoMarcas .= "<input type='checkbox' id='marca$id_marca' name='marcas[]' value='$id_marca'> <label for='marca$id_marca'>$nombre_marca</label> <br>";
      }
      mysqli_free_result($marcas);

      // Si se paso un id de proveedor por la url (click en editar)
      $sql = "select * from proveedores where id = $id";
      $resultado = mysqli_query($conexion, $sql);
      //var_dump($resultado);
      if ($resultado) {
         $provedor = mysqli_fetch_assoc($resultado);
         extract($provedor);
         mysqli_free_result($resultado);
         echo "
            <form action='index.php' method='post'>
            
               <input type='hidden' name='accion' value='proveedores'>
               <input type='hidden' name='tarea' value='guardar'>
               <input type='hidden' name='id' value='$id'>

               <div>
                  <label for=''>Razon social</label><br>
                  <input type='text' name='razon_social' value='$razon_social'>
               </div>

               <div>
                  <label for=''>Domicilio</label><br>
                  <input type='text' name='domicilio' value='$domicilio'>
               </div>

               <div>
                  <label for=''>Telefono</label><br>
                  <input type='text' name='telefono' value='$telefono'>
               </div>

               <div>
                  <label>Marcas provistas</label>
                  <br>
                  $campoMarcas
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