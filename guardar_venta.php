<?php

extract($_POST); // $id_producto, $cantidad

// $id_producto = $_POST['id_producto'];

require 'conexion.php';

if ($conexion) {

    if (mysqli_query($conexion, 'begin') ) {
        
        $fecha = date('Y-m-d H:i');
        $sql = "insert into ventas set id_producto = $id_producto, cantidad = $cantidad, fecha = '$fecha'";
        $resultado = mysqli_query($conexion, $sql);
        
        if ($resultado) {
    
            $sql = "update productos set cantidad = cantidad - $cantidad where id = $id_producto";
            $resultado = mysqli_query($conexion, $sql);
            
            if ($resultado) {
                echo 'Venta realizada';

                mysqli_query($conexion, 'commit');
            } else {
                echo 'No se pudo actualizar el stock ' . mysqli_error($conexion) . ' ' . mysqli_errno($conexion);
                mysqli_query($conexion, 'rollback');
            }
    
        } else {
            echo 'No se pudo guardar la venta.   ' . $sql;

            mysqli_query($conexion, 'rollback');

        }

    } else {
        echo 'No se pudo iniciar la tranasaccion.';
    }
    

} else {
    echo 'Sin conexion a los datos.';
}



