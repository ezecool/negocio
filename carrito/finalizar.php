<?php
    session_start();
    include 'productos.php';
    echo '<table>';
    foreach ($_SESSION['compras'] as $id_producto => $cantidad) {
        $producto = getProducto($id_producto);
        extract($producto);
        echo "<tr> <td>$desc</td> <td>$cantidad</td> <td>$precio</td> </tr>";
        $total += $precio * $cantidad;
    }
    echo '</table>';
    echo "Total: <strong>$total</strong>";
?>
