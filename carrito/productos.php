<?php
    $productos = array(
        ['id_producto' => 1, 'precio' => 45,  'desc' => 'Azucar'], 
        ['id_producto' => 2, 'precio' => 120, 'desc' => 'Yerba'], 
        ['id_producto' => 3, 'precio' => 43,  'desc' => 'Arroz'], 
        ['id_producto' => 4, 'precio' => 75,  'desc' => 'Fideos'], 
        ['id_producto' => 5, 'precio' => 90,  'desc' => 'Gaseosa']
    );

    function getProducto($id_producto) {
        global $productos;
        foreach ($productos as $key => $prod) {
            if ($prod['id_producto'] == $id_producto) {
                return $prod;
            }
        }

    }    
?>