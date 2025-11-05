<?php

$conexion = mysqli_connect("localhost","root","","sistema_inc");
if($conexion->connect_error){
    die("Error: ". $conexion->connect_error);
}

#insertar los datos del usuario
$nombre_alumno = $_POST['nombre_alumno'];
$fecha_nacimiento = $_POST['fecha_nacimiento'];

?>