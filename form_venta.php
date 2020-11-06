<?php
    require 'conexion.php';
    
    if ($conexion) {
        // Contruimos la sentencia SQL
        $sql = 'SELECT * FROM productos';

        // Ejecutamos y obtenermos el resultado
        $resultado = mysqli_query($conexion, $sql);

        
        if ($resultado) {
            
            $campo = '<select name="id_producto">';

            // Extraemos un registro del conjunto de resultados
            while ($fila = mysqli_fetch_assoc($resultado)) {
                
                //extract($fila);
                
                $id = $fila['id'];
                $nombre = $fila['nombre'];
                
                $campo = $campo . "<option value='$id'>$nombre</option>";
            }

            $campo = $campo . '</select>';
        }
    }
?>


<form action="guardar_venta.php" method="post">
    <label for="">Producto<label>
    <br>
    <?php echo $campo; ?>
    <br>
    <label for="">Cantidad</label>
    <br>
    <input type="text" name="cantidad">
    <br>
    <input type="submit" value="Vender">
</form>