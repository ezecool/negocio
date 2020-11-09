<?php

    $tarea = $_REQUEST['tarea'];
    switch ($tarea) {
        case 'editar':
            require 'form_marca.php';
            break;
        case 'guardar':
            require 'conexion.php';
            if (!$conexion) {
                echo 'Sin acceso a los datos';
            } else {
                // Si se envio un formulario por POST
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                    extract($_POST);

                    
                    
                    // Guardamos los datos
                    if ( ($id == '') || ($id == 0) ) {
                        $sql = "insert into marcas set nombre = '$nombre'";
                    } else {
                        $sql = "update marcas set nombre = '$nombre' where id = $id";
                    }

                    $resultado = mysqli_query($conexion, $sql);

                    if ($resultado) {
                        echo 'Cambios aplicados';
                    } else {
                        echo 'Error. No se aplicaron los cambios. ' . $sql;
                    }

                    echo '<div> <a href="index.php?accion=marcas">Volver</a> </div>';
                }    
            }
            break;
        case 'borrar':

            $id = $_REQUEST['id'];

            if (isset($_POST['confirm'])) {
                // $sql = "delete from marcas where id = $id";
                $sql = "update marcas set borrado = 1 where id = $id";
                require_once 'conexion.php';
                if (mysqli_query($conexion, $sql)) {
                    echo 'La marca fue eliminada correctamente.';
                } else {
                    echo 'Error. No se pudo eliminar la marca. ' . $sql;
                }

                echo '<div> <a href="index.php?accion=marcas">Volver</a> </div>';

            } else {

                echo "Confirma el borrado del registro con #$id?";
                echo "
                    <form action='index.php' method='post'>
                        <input type='hidden' name='accion' value='marcas'>
                        <input type='hidden' name='tarea' value='borrar'>
                        <input type='hidden' name='id' value='$id'>
                        <input type='hidden' name='confirm'>
                        <input type='submit' value='Aceptar'>
                    </form>
                ";
            }

            break;
        default:
            echo '
                <div>
                    <a href="?accion=marcas&tarea=editar">Agregar</a>
                </div>            
            ';
            require 'conexion.php';
            if (!$conexion) {
                echo 'No hay acceso a los datos';
            } else {
                $consulta = 'select * from marcas where not borrado order by nombre';
                $data = mysqli_query($conexion, $consulta);
                if (!$data) {
                    echo 'No se pudo consultar las marcas';
                } else {
                    echo '<table border="1">';
                    echo '<tr> <th>#</th> <th>Marca</th> <th colspan="2">Tareas</th> </tr>';
                    while ($marca = mysqli_fetch_assoc($data)) {
                        extract($marca);
                        echo "
                            <tr>
                                <td>$id</td>
                                <td>$nombre</td>
                                <td><a href='index.php?accion=marcas&tarea=editar&id=$id'>Editar</a></td>
                                <td><a href='index.php?accion=marcas&tarea=borrar&id=$id'>Borrar</a></td>
                            </tr>
                        ";
                    }
                    echo '</table>';
                }

                mysqli_close($conexion);
            }
            
        break;
    }
?>
