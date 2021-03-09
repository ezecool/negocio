<?php

include 'helpers.php';
chequearSesion();

if ($_SESSION['nivel'] != 0) {
    $_SESSION['mensaje'] = 'No tiene autorizacion para acceder a esta pagina';
    header('location: index.php');
}

extract($_POST); // $id_producto, $cantidad

require 'conexion.php';

if ($conexion) {

    $id_usuario = $_SESSION['id_usuario'];
    $fecha = date('Y-m-d H:i');

    $queryInsert = '';
    foreach ($_SESSION['carrito'] as $id_producto => $cantidad) {
        // SQL para insertar las compras/ventas
        $queryInsert .= "insert into ventas set id_producto = $id_producto, cantidad = $cantidad, fecha = '$fecha', id_usuario = $id_usuario;";
        //$queryInsert .= "INSERT INTO ventas (id_producto, cantidad, fecha, id_usuario) values($id_producto, $cantidad,'$fecha', $id_usuario); ";
    }

    // Si se pudo iniciar una transaccion
    if (mysqli_query($conexion, 'begin')) {

        $resultado = mysqli_multi_query($conexion, $queryInsert);

        if ($resultado) {
            // Confirmamos los cambios realizados en las tablas
            mysqli_query($conexion, 'commit');
            $_SESSION['mensaje'] = 'Compra realizada.';
            unset($_SESSION['carrito']);
            header('location: ./');
        } else {
            // Cancelamos todos los cambios que se hayan realizado desde que comenzo la transaccion
            echo 'No se pudo guardar la venta.   ' . mysqli_error($conexion);
            mysqli_query($conexion, 'rollback');
        }
    } else {
        echo 'No se pudo iniciar la transaccion.';
    }

} else {
    echo 'Sin conexion a los datos.';
}
