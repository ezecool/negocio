<?php

extract($_POST); // $id_producto, $cantidad

// $id_producto = $_POST['id_producto'];

require 'conexion.php';

if ($conexion) {

    // Si se pudo iniciar una transaccion
    if (mysqli_query($conexion, 'begin') ) {
        
        $fecha = date('Y-m-d H:i');
        $id_cliente = ($id_cliente != '') ? $id_cliente : 0;
        $sql = "insert into ventas set id_producto = $id_producto, cantidad = $cantidad, fecha = '$fecha', id_cliente = $id_cliente";
        $resultado = mysqli_query($conexion, $sql);
        
        if ($resultado) {
    
            $sql = "update productos set cantidad = cantidad - $cantidad where id = $id_producto";
            $resultado = mysqli_query($conexion, $sql);
            
            if ($resultado) {
                echo 'Venta realizada';

                // Cofirmamos los cambios realizados en las tablas
                mysqli_query($conexion, 'commit');
            } else {
                echo 'No se pudo actualizar el stock ' . mysqli_error($conexion) . ' ' . mysqli_errno($conexion);

                // Cancelamos todos los cambios que se hayan realizado desde que comenzo la transaccion
                mysqli_query($conexion, 'rollback');
            }
    
        } else {
            echo 'No se pudo guardar la venta.   ' . $sql;
            mysqli_query($conexion, 'rollback');
        }

    } else {
        echo 'No se pudo iniciar la transaccion.';
    }
    

} else {
    echo 'Sin conexion a los datos.';
}



