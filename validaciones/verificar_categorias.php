<?php 
session_start();
 
require '../bd/conexion_bd.php';

$obj = new BD_PDO();

$id = $_GET['c'];
$datos = $obj->Ejecutar_Instruccion("Select * from categorias where id_categoria='$id'");

echo json_encode($datos);	

	 ?>	