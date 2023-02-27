<?php 
session_start();
include 'bd/config.php';

if (isset($_SESSION['id_usuario'])) 
{
	header("Location: controlador/index.php");
}
else
{
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Inicio de Sesion</title>
</head>
<body style="background-color: lightblue; text-align: center;">

	<?php 
		require 'modelo/Modelo.php';

		$obj = new BD_PDO();

		if (isset($_POST['btniniciar'])) 
		{
			$usuario = $_POST['txtusuario'];
			$contrasena = $_POST['txtcontrasena'];
			$datos = $obj->Ejecutar_Instruccion("Select * from Usuarios where Usuario='$usuario' and Contrasena='$contrasena'");

			if ($datos[0][0]>0) 
			{
				echo "<script>alert('Bienvenido');</script>";
				$_SESSION['id_usuario'] = $datos[0][0];
				$_SESSION['nombre'] = $datos[0][1].' '.$datos[0][2].' '.$datos[0][3];
				$_SESSION['usuario'] = $datos[0][4];
				$_SESSION['privilegio'] = $datos[0][6];
				header("Location: controlador/index.php");
			}
			else
			{
				echo "<script>alert('Usuario no encontrado');</script>";
			}
		}

	 ?>
	<h1>Iniciando Sesion</h1>
	<style type="text/css"> .login100-form-btn {
  font-family: Montserrat-Bold;
  font-size: 15px;
  line-height: 1.5;
  color:  black;
  text-transform: uppercase;

  width: 20%;
  height: 45px;
  border-radius: 20px;
  background:89000;
  display: -webkit-box;
  display: -webkit-flex;
  display: -moz-box;
  display: -ms-flexbox;
  display: flex;
  justify-content: center;
  align-items: center;
  padding: 0 2px;

  -webkit-transition: all 0.4s;
  -o-transition: all 0.4s;
  -moz-transition: all 0.4s;
  transition: all 0.4s;
}

.login100-form-btn:hover {
  background: #3fd0fc;
}

</style>
	<form action="iniciar_sesion.php" method="post">
		<input class="login100-form-btn"  style="margin-left: 370px; height: 33px; width: 200px; margin-top: 30px; text-align: center;" type="text" id="txtusuario" name="txtusuario" placeholder="Usuario">
		<input class="login100-form-btn"  style="margin-left: 600px; height: 34px; width: 180px; margin-top: -37px; text-align: center;" type="text" id="txtcontrasena" name="txtcontrasena" placeholder="Contraseña">
		<input class="login100-form-btn" style="margin-left: 800px; height: 38px; width: 180px; margin-top: -37px; text-align: center;"  type="submit" id="btniniciar" name="btniniciar" value="Iniciar">
	</form>
</body>
</html>
<?php 

} ?>