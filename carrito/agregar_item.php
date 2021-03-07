<?php
    // Recupero la sesion
    session_start();

    // Tomo los datos del formulario
    extract($_REQUEST);

    if (isset($_SESSION['compras'])) {        
        $_SESSION['compras'][$id_producto] += $cantidad;
    } else {
        $_SESSION['compras'] = array($id_producto => $cantidad);
    }

    //var_dump($compras);

    //$_SESSION['compras'] = $compras;

    // var_dump($_SESSION['compras']);

    // Luego de agregar los datos al array de sesion compras, redirecciono a index
    header('location: index.php');
?>