<?php
    // Capturamos el parametro tarea, para decidir que tarea debe ejecutar de las varias disponibles en este script
    $tarea = $_REQUEST['tarea'];

    switch ($tarea) {
        case 'editar':
            // Si elegimos Agregar o Editar, cargamos el formulario de proveedor
            require 'form_proveedor.php';
            break;
        case 'guardar':
            require 'conexion.php';
            if (!$conexion) {
                echo 'Sin acceso a los datos';
            } else {
                // Si se envio un formulario por POST
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                    extract($_POST); // -> $razon_social y $marcas

                    // Como se va a editar mas de una tabla, iniciamos una transaccion para asegurar la integridad de los datos
                    mysqli_query($conexion, 'begin');
                    
                    // Guardamos los datos del proveedor
                    if ( ($id == '') || ($id == 0) ) {
                        $sql = "insert into proveedores set razon_social = '$razon_social', domicilio = '$domicilio', telefono = '$telefono'";
                    } else {
                        $sql = "update proveedores set razon_social = '$razon_social', domicilio = '$domicilio', telefono = '$telefono' where id = $id";
                        $editando = 1; // Bandera para indicar que se esta editando un registro ya existente
                    }

                    // Ejecutamos el insert o update
                    $resultado = mysqli_query($conexion, $sql);
                    
                    // Si fue un insert, tomo el id generado automaticamente
                    $nuevo_id = mysqli_insert_id($conexion);
                    echo 'nuevo id: ' . $nuevo_id;

                    if ($resultado) {
                        // Guardamos los datos de las marcas elegidas para este proveedor. Si es un modificacion de una proveedor ya existente, borramos todas las marcas asociadas al mismo para crearlas nuevamente
                        if (isset($editando)) {
                            $sql = "delete from marcas_proveedor where id_proveedor = $id";
                            $resultado = mysqli_query($conexion, $sql);

                            if (!$resultado) {
                                $error = 1;
                            }
                        } else {
                            // Si es un insert, obtengo el ultimo id generado automaticamente
                            echo 'insertado - ' . $nuevo_id;
                        }

                        // Si no se produjo algun error al borrar las marcas de este proveedor
                        if (!isset($error)) {

                            if (sizeof($marcas) > 0) {

                                // Para cada marca tildada en el formulario, se insertara un registro en la tabla marcas_proveedor
                                $sql = '';
                                foreach ($marcas as $id_marca) {
                                    // Creamos un insert por cada marca, separadas por ;
                                    $sql .= "insert into marcas_proveedor set id_marca = $id_marca, id_proveedor = $id;";
                                }
    
                                // Insertamos las marcas asociadas al proveedor
                                $resultado = mysqli_query($conexion, $sql);
    
                                if (!$resultado) {
                                    $error = 1;
                                    echo mysqli_error($conexion);
                                    die($sql);
                                } else { 
                                    echo 'marcasssss';
                                }
                            }
                        }                        
                    } else {
                        $error = 1;
                    }
 
                    if (isset($error)) {
                        echo 'No se pudo realizar la operacion. --- ' . $sql;
                        mysqli_query($conexion, 'rollback');
                    } else {
                        mysqli_query($conexion, 'commit');
                        echo 'Cambios aplicados. ' . $sql;
                    }

                    echo '<div> <a href="index.php?accion=proveedores">Volver</a> </div>';
                }    
            }
            break;
        case 'borrar':

            $id = $_REQUEST['id'];

            if (isset($_POST['confirm'])) {
                // $sql = "delete from marcas where id = $id";
                $sql = "update proveedores set borrado = 1 where id = $id";
                require_once 'conexion.php';
                if (mysqli_query($conexion, $sql)) {
                    echo 'El proveedor fue eliminado correctamente.';
                } else {
                    echo 'Error. No se pudo eliminar el proveedor. ' . $sql;
                }

                echo '<div> <a href="index.php?accion=proveedores">Volver</a> </div>';

            } else {

                echo "Confirma el borrado del registro con #$id?";
                echo "
                    <form action='index.php' method='post'>
                        <input type='hidden' name='accion' value='proveedores'>
                        <input type='hidden' name='tarea' value='borrar'>
                        <input type='hidden' name='id' value='$id'>
                        <input type='hidden' name='confirm'>
                        <input type='submit' value='Aceptar'>
                    </form>
                ";
            }

            break;
        default:
            require 'conexion.php';
            if (!$conexion) {
                echo 'No hay acceso a los datos';
            } else {
               $consulta = 'select * from proveedores where not borrado order by razon_social';
               $data = mysqli_query($conexion, $consulta);
               if (!$data) {
                   echo 'No se pudo consultar los proveedores';
               } else {
                    echo '<h2>Proveedores</h2> <hr>';
                    echo '
                    <div>
                        <a href="index.php?accion=proveedores&tarea=editar">Agregar</a>
                    </div>            
                    ';
                  echo '<table border="1">';
                  echo '<tr> <th>#</th> <th>Razon Social</th> <th colspan="2">Tareas</th> </tr>';
                  while ($prov = mysqli_fetch_assoc($data)) {
                      extract($prov);
                      echo "
                          <tr>
                              <td>$id</td>
                              <td>$razon_social</td>
                              <td><a href='index.php?accion=proveedores&tarea=editar&id=$id'>Editar</a></td>
                              <td><a href='index.php?accion=proveedores&tarea=borrar&id=$id'>Borrar</a></td>
                          </tr>
                      ";
                  }
                  echo '</table>';
               }               
               mysqli_close($conexion);
            }
            
        break;
    }
