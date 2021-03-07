<?php

// Validaciones pendientes

// Obtengo el id de producto pasado por el enlace Eliminar
extract($_GET);

// Incluimos el archivo que hace la conexion a la base de datos
require 'conexion.php';

// Verificar conexion
if ($conexion) {

    // Hacemos el borrado fisico del registro
    $sql = "delete from productos where id = $id";
    $resultado = mysqli_query($conexion, $sql);
    
    // Verificamos el resultado
    if ($resultado) {
        if (mysqli_affected_rows($conexion) > 0) {
            echo '<p>Se ha eliminado el producto <strong>' . $id . '</strong></p>';
        }
    } else {
        echo '<p>Error, no se pudo borrar el producto</p>';
    }
    
} else {
    echo '<p>No se puede acceder a los datos</p>';
}

echo '<a href="?accion=productos">Volver</a>';
