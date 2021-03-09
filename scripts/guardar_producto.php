<?php
include 'helpers.php';
chequearSesion();

if ($_SESSION['nivel'] == 0) {
    $_SESSION['mensaje'] = 'No tiene autorizacion para acceder a esta pagina';
    header('location: index.php');
}

// Validaciones
extract($_POST);

if ($id == '') {
    $sql = "insert into productos set nombre = '$nombre', descripcion = '$descripcion', precio = $precio, id_rubro = $id_rubro, id_marca = $id_marca";
} else {
    $sql = "update productos set nombre = '$nombre', descripcion = '$descripcion', precio = $precio, id_rubro = $id_rubro, id_marca = $id_marca where id = $id";
}

require 'conexion.php';

// Verificar conexion
if ($conexion) {

    $resultado = mysqli_query($conexion, $sql);

    if ($resultado) {
        //header('location: index.php?accion=productos');
        //exit;
        echo 'Producto guardado';
        echo '<a href="?accion=productos">Volver</a>';
    } else {
        echo 'Error, no se pudo guardar el producto';
    }

} else {
    echo 'No se puede acceder a los datos';
}
