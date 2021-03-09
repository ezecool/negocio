<?php

include 'helpers.php';

if (isset($_POST['username']) && isset($_POST['password'])) {

	include 'conexion.php';
	//include 'cifrado.inc.php';
	if (!$conexion) {
		//$error = 'No se puede acceder a la base de datos';
		// $error = mysqli_error($conexion);
		$_SESSION['mensaje'] = 'No se puede acceder a la base de datos';
	} else {
		// proceso de logueo
		extract($_POST);
		$consulta = "select * from usuarios where username = '$username' limit 1";
		$resultado = mysqli_query($conexion, $consulta);
		if ($resultado) {
			if (mysqli_num_rows($resultado) > 0) {

				// Comprobamos la contraseña
				$usuario = mysqli_fetch_assoc($resultado);
				//$hash = $usuario['password'];
				if ( password_verify($password, $usuario['password']) ) {
					// usuario y password correctos
					$_SESSION['username'] = $usuario['username'];
					$_SESSION['nivel'] = $usuario['nivel'];
					$_SESSION['id_usuario'] = $usuario['id'];
				} else {
					$_SESSION['mensaje'] = 'Password incorrecto';
				}
			} else {
				$_SESSION['mensaje'] = 'Usuario incorrecto';
			}
		} else {
			$_SESSION['mensaje'] = 'Error de comprobacion de credenciales';
		}

		// header("location: $path");
		header('location: index.php');
		exit();
	}
}
?>

<?php
if (isset($error)) {
	echo "<div class='container text-danger top20 text-center'><p>$error</p></div>";
}
if (isset($_SESSION['mensaje'])) {
	echo "<div class='container text-danger top20 text-center'><p>" . $_SESSION['mensaje'] . "</p></div>";
}
?>
<div>
	<form id="form-login" method="post" action="index.php">
		<div id='img-login'>
		</div>

		<input type="hidden" name="accion" value="login">

		<div class="form-group">
			<label>Usuario</label>
			<input type="text" id="username" name="username" class="form-control" autofocus>
			<span class="campo-invalido"></span>
		</div>

		<div>
			<div class="form-group">
				<label for="password">Contrase&ntilde;a</label>
				<input type="password" id="password" name="password" class="form-control">
				<span class="campo-invalido"></span>
			</div>
		</div>

		<button type="submit" class="btn btn-primary btn-block">Ingresar</button>
	</form>
</div>

<div>
	<a href="index.php?accion=registro">Registrame</a>
</div>

