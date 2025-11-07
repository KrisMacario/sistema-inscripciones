<?php

$conexion = mysqli_connect("localhost","root","","sistema_inc");
if($conexion->connect_error){
    die("Error: ". $conexion->connect_error);
}

#insertar los datos del usuario
$nombre_alumno = $_POST['nombre_alumno'];
$fecha_nacimiento = $_POST['fecha_nacimiento'];
$curp = $_POST['curp'];
$nombre_padre = $_POST['nombre_padre'];
$telefono = $_POST['telefono'];
$email = $_POST['email'];
$grado = $_POST['grado'];

//iniciar transiccion
$conexion -> begin_transaction();

try{

    //insertar alumno
    $conexion -> query("INSERT INTO usuarios(nombre, apellido, fk_rol, estado) VALUES('$nombre_alumno', 6, 1)");
    $pk_usuario = $conexion -> insert_id;

    //datos del alumno
    $conexion -> query("INSERT INTO alumno_datos(curp, fecha_nacimiento, fk_usuarios grado) VALUES('$curp', '$fecha_nacimiento', '$grado')");
    $pk_alumno = $conexion -> insert_id;

    //datos del padre
    $conexion -> query("INSERT INTO usuarios(nombre, apellido, telefono, email, fk_rol) VALUES('$nombre_padre', '$telefono', '$email', 3 )");
    $pk_usuario = $conexion -> insert_id;

    $conexion -> commit();

    echo "inscrito exitosamente";

}catch(Exception $e){
    $conexion -> rollback();
    echo "Error: ". $e -> getMessage() ."";
}

?>