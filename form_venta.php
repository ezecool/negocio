<?php
require_once 'conexion.php';

if ($conexion) {

    // Contruimos la sentencia SQL
    $sql = 'SELECT * FROM productos';

    // Ejecutamos y obtenermos el resultado
    $resultado = mysqli_query($conexion, $sql);

    if ($resultado) {

        $campoProd = '<select name="id_producto">';

        // Extraemos un registro del conjunto de resultados
        while ($fila = mysqli_fetch_assoc($resultado)) {

            $id = $fila['id'];
            $nombre = $fila['nombre'];

            $campoProd .= "<option value='$id'>$nombre</option>";
        }

        $campoProd .= '</select>';
    } else {
        $error = 1;
    }

    // Contruimos la sentencia SQL para generar el campo de cliente
    $sql = 'SELECT id, nombre, apellido FROM clientes order by apellido';

    // Ejecutamos y obtenermos el resultado
    $resultado = mysqli_query($conexion, $sql);
    //var_dump($resultado);
    if ($resultado) {

        $campoCli = '<select name="id_cliente">';

        // Extraemos un registro del conjunto de resultados
        while ($cliente = mysqli_fetch_assoc($resultado)) {

            extract($cliente);

            $campoCli .= "<option value='$id'>$apellido, $nombre</option>";
        }

        $campoCli .= '</select>';
    } else {
        $error = 1;
    }

    if ($error) {
        echo 'No se puede mostrar esta pagina en este momento.';
    } else {
    ?>
        <form action="index.php" method="post">
            <input type="hidden" name="accion" value="guardar_venta">
            <label for="">Producto<label>
                    <br>
                    <?php echo $campoProd; ?>
                    <br>
                    <label for="">Cantidad</label>
                    <br>
                    <input type="text" name="cantidad">
                    <br>
                    <label for="">Cliente</label><br>
                    <?= $campoCli ?>
                    <br>
                    <input type="submit" value="Vender">
        </form>
<?php
    }
} else {
    echo 'Sin conexion.';
}
?>