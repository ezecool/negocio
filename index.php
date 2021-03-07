<?php
   ini_set('display_errors', 0);
   set_include_path('includes');
?>

<!DOCTYPE html>
<html lang="es">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Negocio</title>
</head>
<body>
   <div id="marco">

      <div id="cabecera">
         <h1>Negocio</h1>
      </div>

      <div id="menu">
         <nav>
            <ul>
               <li><a href="index.php">Inicio</a></li>
               <li><a href="index.php?accion=productos">Productos</a></li>
               <li><a href="index.php?accion=marcas">Marcas</a></li>
               <li><a href="index.php?accion=proveedores">Proveedores</a></li>
               <li><a href="">Rubros</a></li>
               <li><a href="">Categorias</a></li>
               <li><a href="index.php?accion=ventas">Ventas</a></li>
            </ul>
         </nav>
      </div>

      <div id="contenido">

      <?php
         // Capturamos el parametro accion para determinar que archivo de codigo debemos cargar en el index
         $accion = $_REQUEST['accion'];

         switch ($accion) {
            case 'productos':
               include 'productos.php';
               break;
            case 'editar_producto':
               include 'editar_producto.php';
               break;
            case 'borrar_producto':
               include 'borrar_producto.php';
               break;
            case 'guardar_producto';
               include 'guardar_producto.php';
               break;
            case 'marcas':
               include 'marcas.php';
               break;
            case 'proveedores':
               include 'proveedores.php';
               break;
            case 'ventas':
               include 'form_venta.php';
               break;
            case 'guardar_venta':
               include 'guardar_venta.php';
               break;
            default:
               # code...
               break;
         }
      ?>

      </div>

      <div>
         <div id="pie">
         </div>
      </div>
   </div>
</body>
</html>