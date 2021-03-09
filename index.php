<?php
   ini_set('display_errors', 0); // Activar/Desactivar los mensajes de error
   error_reporting(E_ALL); // Mostrar todos los tipos de errores
   set_include_path('scripts'); //establecer la carpeta desde donde se incluiran archivos

   session_start();

   // Si se accedio enviando el parametro accion = logout (index.php?accion=logout) se cierra la sesion
	if ($_REQUEST['accion'] == 'logout') {
		session_destroy();
		header("location: index.php");
		exit();
	}
      
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

      <!-- Mostramos las notificaciones guardadas en una variable de session -->
      <?php
         if (isset($_SESSION['mensaje'])) {
            echo $_SESSION['mensaje'];
            unset($_SESSION['mensaje']);
         }
      ?>

		<?php
		if (!isset($_SESSION['username'])) {
			
         if ($_REQUEST['accion'] == 'registro') {
            include 'registro.php';
         } else {
            include 'login.php';
         }

		} else {
      ?>
      <div>
         <h5>
            Usuario: <?= $_SESSION['username'] ?>
         </h5>
      </div>

         <?php include 'menu.php'; ?>

         <div id="cabecera">
            <h1>Negocio</h1>
         </div>

         <div id="contenido">

         <?php
            // Capturamos el parametro accion para determinar que archivo de codigo debemos cargar en el index
            $accion = $_REQUEST['accion'];

            switch ($accion) {
               case 'registro':
                  include 'form_registro.php';
                  break;
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
               case 'comprar':
                  include 'compra.php';
                  break;
               case 'carrito':
                  include 'carrito.php';
                  break;
               case 'guardar_compra':
                  include 'guardar_compra.php';
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
      <?php } ?>
   </div>
</body>
</html>