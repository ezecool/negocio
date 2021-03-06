<?php
    include 'helpers.php';
    chequearSesion();

    /* Verificamos que no sea un usuario comun el que quiere acceder a esta pagina, lo sacamos de la pagina y colocamos un mensaje que se mostrara en el index */
    if ($_SESSION['nivel'] == 0) {
        $_SESSION['mensaje'] = 'No tiene autorizacion para acceder a esta pagina';
        header('location: index.php');
    }
?>

<div>
    <form action="index.php" method="get">
        <input type="hidden" name="accion" value="productos">
        <div>
            Buscar producto: 
            <input type="text" name="buscado"><br>
            <button type="submit">Filtrar</button>
        </div>
    </form>
</div>

<div>
    <a href="?accion=editar_producto">Nuevo producto</a>
</div>

<?php

// Incluimos el archivo que hace la conexion a la base de datos
require 'conexion.php';

// Verificar conexion
if ($conexion) {
    
    if (isset($_GET['buscado'])) {
        extract($_GET);
        $filtro = " where nombre like '%$buscado%'";
    }

    // Contruimos la sentencia SQL
    $sql = "SELECT * FROM productos $filtro";

    // Ejecutamos y obtenermos el resultado
    $resultado = mysqli_query($conexion, $sql);
    
    // Verificar el resultado de la ejecucion del SQL anterior
    if ($resultado) {
        
        // Trabajar con los datos //

        echo '<table border="1">'; // Creamos una tabla HTML para mostrar los datos
        
        // Extraemos un registro del conjunto de resultados
        while ($fila = mysqli_fetch_assoc($resultado)) {

            // Usamos los datos segun las necesidades de la aplicacion
            
            extract($fila); // Genera las variables $id, $nombre, $descripcion, $precio, $id_rubro
            
            // Creamos una fila en la tabla HTML para cada registro de producto
            echo "<tr> 
                    <td>$nombre</td>
                    <td>$precio</td>
                    <td>
                        <a href='?accion=editar_producto&id=$id'>Editar</a>
                    </td>
                    <td>
                        <a href='?accion=borrar_producto&id=$id'>Eliminar</a>
                    </td>
                </tr>";
        }

        // Cerramos la tabla abierta mas arriba
        echo '</table>';

        // Liberamos los resultados de la consulta
        mysqli_free_result($resultado);

    } else {

        // Por algun motivo, no se pudo ejecutar la sentencia SQL
        echo 'Error accediendo a los datos ' . mysqli_error($conexion);

    }

    // Cerramos la conexion
    mysqli_close($conexion);

} else {
    // No se pudo establecer una conexion a a BD
    echo 'Error de conexion ' . mysqli_connect_error();
}


