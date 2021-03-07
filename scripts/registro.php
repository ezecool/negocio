<?php
   include('helpers.php');

   if (isset($_POST['username']) && isset($_POST['password'])) {
      var_dump($_POST);
      // Registramos el usuario
      include 'conexion.php';
      if (!$conexion) {
         $_SESSION['mensaje'] = 'Sin conexion';
         header('location: index.php?accion=registro');
      }

      extract($_POST);
      $password = hashear($password);
      $query = "insert into usuarios set username = '$username', password = '$password', email = '$email'";
      $resultado = mysqli_query($conexion, $query);
      if ($resultado && (mysqli_affected_rows($conexion) > 0) ) {
         $_SESSION['mensaje'] = 'Usuario regiustrado exitosamente';
      } else {
         $_SESSION['mensaje'] = 'No se pudo registrar el usuario';
         $_SESSION['mensaje'] = $query;
      }
      //echo $query;
      header('location: index.php');
      exit();
   }
?>

<h3>Formulario de registro</h3>
<form action="index.php" method="post">
   <input type="text" name="accion" value="registro">
   <div>
      <label for="email">Email</label>
      <input type="text" name="email" id="email">
   </div>
   <div>
      <label for="username">Usuario</label>
      <input type="text" name="username" id="username">
   </div>
   <div>
      <label for="password">Password</label>
      <input type="password" name="password" id="password">
   </div>
   <div>
      <input type="submit" value="Registrarme">
   </div>
</form>