<?php
    session_start();
    include 'productos.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Carrito de compras</title>
</head>
<body>
    <h2>Compra online</h2>
    <form action="agregar_item.php">
        <label for="producto">Producto</label><br>
        <select name="id_producto" id="producto">
        <?php
            // Genero un option para cada elemento del array $productos definido en productos.php
            foreach ($productos as $key => $prod) {
                extract($prod);
                echo "<option value='$id_producto'>$id_producto | $desc</option>";
            }
        ?>
        </select>

        <br><br>
        
        <label for="cantidad">Cantidad</label><br>
        <input type="number" name="cantidad">
        
        <br><br>

        <input type="submit" value="Agregar a la lista">

    </form>

    <?php
        // Si existe la variable de sesion compras, 
        if (isset($_SESSION['compras'])) {

            echo '<h3>Productos elegidos</h3>';
            echo '<table>';
            echo '<tr> <th>Producto</th> <th>Cantidad</th> </tr>';

            // Para cada elemento del array compras, que esta guardado en la sesion, creo una fila de tabla para mostrar sus datos
            foreach ($_SESSION['compras'] as $id_producto => $cantidad) {
                // obtengo la descripcion del producto, usando una funcion declarada en productos.php
                $prod = getProducto($id_producto);
                echo "<tr> <td>" . $prod['desc'] ."</td> <td>$cantidad</td> </tr>";
            }
            echo '</table>';

        }
        ?>
        <br><a href="finalizar.php">Finalizar compra</a>
        <br><a href="limpiar.php">Nueva compra</a>
</body>
</html>