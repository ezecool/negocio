<?php

include 'helpers.php';
chequearSesion();

if ($_SESSION['nivel'] != 0) {
    $_SESSION['mensaje'] = 'No tiene autorizacion para acceder a esta pagina';
    header('location: index.php');
}

require_once 'conexion.php';

if ($conexion) {

    // Si recibimos un producto y cantidad, lo agregamos al carrito que es una variable de sesion
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Tomamos los datos del formulario
        extract($_REQUEST); // $id_producto y $cantidad

        $_SESSION['carrito'][$id_producto] += $cantidad;
    }

    // Mostramos un formulario para elegir producto y cantidad que queremos comprar //

    // Obtenemos los productos para construir un campo select
    $sql = 'select * from productos order by nombre';
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
        $_SESSION['mensaje'] = 'No se puede acceder al listado de productos.';
        header('location: index.php');
    }

    ?>
        <form action="index.php" method="post" novalidate>
            <input type="hidden" name="accion" value="comprar">
            <label for="">Producto<label>
            <br>
            <?php echo $campoProd; ?>
            <br>
            <label for="">Cantidad</label>
            <br>
            <input type="number" name="cantidad">
            <br>
            <input type="submit" value="Agregar a la lista">
        </form>
    <?php

} else {
    $_SESSION['mensaje'] = 'No se puede acceder a los datos en este momento.';
    header('location: ./');
}
?>