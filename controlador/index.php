<?php 
error_reporting(1);
session_start();
include '../modelo/Modelo.php';
include '../bd/config.php';
$obj = new BD_PDO();
if (isset($_POST['btnregistrar'])) 
{
	$nombre = $_POST['txtnombre'];
	$cantidad = $_POST['txtcantidad'];
	$idproveedor = $_POST['lstproveedores'];
	$idcategoria = $_POST['lstcategorias'];

	if ($_POST['btnregistrar']=='Insertar') 
	{
		$obj->Ejecutar_Instruccion("Insert into productos(Nombre,Cantidad,id_proveedor,id_categoria) values('$nombre','$cantidad','$idproveedor','$idcategoria')");
		header("Location: index.php");
	}
		else if ($_POST['btnregistrar']=='Guardar')
		{
			$idproducto = $_POST['txtid'];
			$obj->Ejecutar_Instruccion("Update productos set Nombre='$nombre',Cantidad='$cantidad',id_proveedor='$idproveedor',id_categoria='$idcategoria' where id_producto = '$idproducto'");
		}
}
	else if(isset($_GET['ideliminar']))
	{
		$id = $_GET['ideliminar'];
		$obj->Ejecutar_Instruccion("Delete from productos where id_producto = '$id'");
	}
		else if(isset($_GET['idmodificar']))
		{
			$id = $_GET['idmodificar'];
			$prod_mod = $obj->Ejecutar_Instruccion("Select * from productos where id_producto = '$id'");
		}

	$buscar = $_POST['txtbuscar'];
	$datos_buscar = $obj->Ejecutar_Instruccion("Select productos.id_producto,productos.Nombre,productos.Cantidad,concat(proveedores.Nombres,' ',proveedores.Apellido_p,' ',proveedores.Apellido_m) as Nombre_prov,id_categoria from productos INNER JOIN proveedores ON productos.id_proveedor=proveedores.id_proveedor where Nombre like '%$buscar%'");

	$datos_proveedores = $obj->listados("Select id_proveedor,concat(Nombres,' ',Apellido_p,' ',Apellido_m) as Nombre_comp from proveedores","Select id_proveedor from productos where 
		id_producto='".$_GET['idmodificar']."'");
	 

	$datos_categorias = $obj->listados("Select id_categoria,Nombre from categorias","Select id_categoria from productos where 
		id_producto='".$_GET['idmodificar']."'");
	
require '../vista/Vista.php';
?>

	