<?php

// Funcion que recibe la conexion a mysql y genera un campo de formulario llamado id_marca
function crearCampoMarca($conexion, $id_marca_elegido = 0) {
   $sql = "select * from marcas where not borrado order by nombre";
   $marcas = mysqli_query($conexion, $sql);
   if ($marcas) {
      $campoMarca = '<select name="id_marca">';
      while ($marca = mysqli_fetch_assoc($marcas)) {
         extract($marca);
         $campoMarca .= "<option value='$id'>$nombre</option>";
      }
      $campoMarca .= '</select>';
      return $campoMarca;
   } else {
      return false;
   }
}

require 'conexion.php';

if ($conexion) {

   // Contruimos la sentencia SQL para consultar los rubros y construir el campo id_rubro
   $sql = 'select id as id_de_rubro, nombre as nombre_rubro from rubros order by nombre';

   // Ejecutamos y obtenemos el resultado
   $resultado = mysqli_query($conexion, $sql);

   if ($resultado) {

      $campo_rubro = '<select name="id_rubro">';

      // Extraemos un registro del conjunto de resultados
      $elegido = '';
      while ($rubro = mysqli_fetch_assoc($resultado)) {
         extract($rubro);

         $elegido = ($id_de_rubro == $id_rubro) ? 'selected' : '';
         $campo_rubro = $campo_rubro . "<option $elegido value='$id_de_rubro'>$nombre_rubro</option>";
      }

      $campo_rubro = $campo_rubro . '</select>';
   } else {
      $error = 1;
   }
}
?>

<form action="index.php" method="post">

   <input type="hidden" name="accion" value="guardar_producto">
   <input type="hidden" name="id" value="<?php echo $id; ?>">

   <div>
      <label for="">Nombre</label>
      <br>
      <input type="text" name="nombre" value="<?php echo $nombre; ?>">
   </div>

   <div>
      <label for="">Descripcion</label>
      <br>
      <textarea name="descripcion" id="" cols="30" rows="10"><?php echo $descripcion; ?></textarea>
   </div>

   <div>
      <label for="">Precio</label>
      <br>
      <input type="text" name="precio" value="<?= $precio; ?>">
   </div>

   <div>
      <label for="">Rubro</label>
      <br>
      <?= $campo_rubro ?>
   </div>

   <div>
      <label for="">Marca</label>
      <br>
      <?php echo crearCampoMarca($conexion, $id_marca); ?>
   </div>

   <div>
      <input type="submit" value="Guardar producto">
   </div>

</form>