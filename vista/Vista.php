<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Productos</title>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
	function eliminar(id)
	{
		if (confirm("¿ Estas seguro de eliminar el registro ?")) 
		{
			window.location = "../controlador/index.php?ideliminar=" + id;
		}
	}

	function modificar(id)
	{
		window.location = "../controlador/index.php?idmodificar=" + id;
	}

	function cerrar_sesion()
	{
		if (confirm("¿ Estas seguro de cerrar la sesión ?")) 
		{
			window.location = "../cerrar_sesion.php";
		} 	
	}

	function validar()
	{
		var nombre = document.getElementById("txtnombre").value;
		var id = document.getElementById("lstcategorias").value;

		if (nombre.trim().length<1) 
		{
			alert("Nombre esta vacio");
			return false;
		}

		if (nombre.trim().length != nombre.length) 
		{
			alert("Tienes espacios de mas en el nombre");
			return false;
		}

		$.getJSON("../validaciones/verificar_categorias.php?c=" + id).done(function(datos)  
	    {
	      if ((isset(datos[0][0]))) 
	      {
	        alert("Categoria no existe, No te quieras pasar de listo");
	        return false;
	      }        
	    }); 
		return true;
	}

	function verificar_producto(id)
	{
	  $.getJSON("../validaciones/verificar_producto.php?p=" + id).done(function(datos)  
	    {
	      if (datos[0][0]>0) 
	      {
	        alert("Producto ya existe, verifique");
	      }        
	    });  
	}
</script>

</head>  
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
<body style="background-color: lightblue;">
	
<?php 
if ($_SESSION['privilegio']=='Admin') 
{
?>
	<h1 style="text-align: center;">Productos</h1>
	<br>
	<form style="text-align: center;" action="../controlador/index.php" method="post" id="frminsertar" name="frminsertar" 
	onsubmit="return validar();">
		<input type="text" id="txtid" name="txtid" placeholder="Numero" value="<?php echo @$prod_mod[0]['id_producto']; ?>" hidden>
		<input class="login100-form-btn" style="margin-left: 230px; height: 33px; width: 180px; text-align: center;" type="text" id="txtnombre" name="txtnombre" onblur="javascript: verificar_producto(this.value);" maxlength="30" placeholder="Nombre" value="<?php echo @$prod_mod[0][1]; ?>" required>
		<input class="login100-form-btn" style="margin-left: 430px; height: 33px; width: 180px; margin-top: -36px; text-align: center;" type="text" id="txtcantidad" name="txtcantidad" maxlength="5" placeholder="Cantidad" value="<?php echo @$prod_mod[0][2]; ?>" required>
		<select class="login100-form-btn" style="margin-left: 630px; height: 35px; width: 220px; margin-top: -35px; text-align: center;" name="lstproveedores" id="lstproveedores" required>
			<option value="">Seleccione Proveedor</option>
			<?php echo $datos_proveedores; ?>
		</select>

		<select name="lstcategorias" id="lstcategorias" class="login100-form-btn" style="margin-left: 860px; height: 35px; width: 220px; margin-top: -35px; text-align: center;" required>
			<option value="">Seleccione Categorias</option>
			<?php echo $datos_categorias; ?>
		</select>

		<input class="login100-form-btn" style="margin-left: 1090px; height: 36px; width: 120px; margin-top: -35px;" type="submit" id="btnregistrar" name="btnregistrar" value="<?php
		if(isset($_GET['idmodificar']))
		{
			echo 'Guardar';
		}
		else
		{
			echo 'Insertar';
		}?>">		
	</form>
<?php } ?>

	<h1 style="text-align: center;">Listado de Productos</h1>
	<form style="text-align: center;" action="../controlador/index.php" id="frmbuscar" name="frmbuscar" method="post">
		<input class="login100-form-btn" style="margin-left: 470px; height: 28px; width: 180px;text-align: center;"  type="text" id="txtbuscar" name="txtbuscar" placeholder="Buscar nombre">
		<input class="login100-form-btn" style="margin-left: 680px; height: 34px; width: 120px; margin-top: -33px" type="submit" id="btnbuscar" name="btnbuscar" value="Buscar">
		<br>
		<br>
	</form>
		<center><table border="2">
			<div >
			<tr>
				<td>Num</td>
				<td>Nombre</td>
				<td>Cantidad</td>
				<td>Proveedor</td>
				<td>Categoria</td>
				<td colspan="2" align="center">Accion</td>
			</tr>
		</div>
			<?php foreach ($datos_buscar as $renglon) { ?>
			<tr>
				<td style="text-align: center;"><?php echo $renglon[0]; ?></td>
				<td style="text-align: center;"><?php echo $renglon[1]; ?></td>
				<td style="text-align: center;"><?php echo $renglon[2]; ?></td>
				<td style="text-align: center;"><?php echo $renglon[3]; ?></td>
				<td style="text-align: center;"><?php echo $renglon[4]; ?></td>
			 <?php 

if ($_SESSION['privilegio']=='Admin') 
{
?>	
				<td><input type="button" class="login100-form-btn" style="width: 85px; height: 32px" id="btneliminar" name="btneliminar" value="Eliminar" onclick="javascript: eliminar('<?php echo $renglon[0]; ?>');"></td>
				<td><input class="login100-form-btn" style="width: 100px; height: 32px" type="button" id="btnmodificar" name="btnmodificar" value="Modificar" onclick="javascript: modificar('<?php echo $renglon[0]; ?>');"></td>
<?php } ?>
		</tr>
<?php } ?>
		</table>
		</center>

<br><br>
<h2 style="text-align: center;">Sesiones</h2>
<center><a style="margin-right: 150px;" href="../iniciar_sesion.php">Iniciar Sesion</a>
<input class="login100-form-btn" style="width: 130px; height: 28px; margin-left: 100px; margin-top: -23px" type="button" id="btncerrarsesion" name="btncerrarsesion"  value="Cerrar Sesion" onclick="javascript: cerrar_sesion();">
</center>
</body>
</html>