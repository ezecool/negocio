<?php
require 'conexion.php';
if ($conexion) {
   // Contruimos la sentencia SQL
   $sql = 'select id as id_de_rubro, nombre as nombre_rubro from rubros order by nombre';

   // Ejecutamos y obtenermos el resultado
   $resultado = mysqli_query($conexion, $sql);

   if ($resultado) {

      $campo_rubro = '<select name="id_rubro">';

      // Extraemos un registro del conjunto de resultados
      $elegido = '';
      while ($rubro = mysqli_fetch_assoc($resultado)) {
         extract($rubro);

         /*                 if ($fila['id'] == $id_rubro) {
                    $elegido = 'selected';
                } else {
                    $elegido = '';
                } */
         $elegido = ($id_de_rubro == $id_rubro) ? 'selected' : '';
         $campo_rubro = $campo_rubro . "<option $elegido value='$id_de_rubro'>$nombre_rubro</option>";
      }

      $campo_rubro = $campo_rubro . '</select>';
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
      <input type="submit" value="Guardar producto">
   </div>

</form>