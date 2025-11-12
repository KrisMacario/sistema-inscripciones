<?php

$conexion = new mysqli("localhost","root","","sistema_inc");
if($conexion->connect_error){
    die("Error: ". $conexion->connect_error);
}

#insertar los datos del usuario
$anuncio_titulo = $_POST['anuncio-titulo'];
$anuncio_mensaje = $_POST['anuncio-mensaje'];

$conexion -> begin_transaction();

try{
    $conexion -> query("INSERT INTO anuncios(titulo, anuncio) VALUES('$anuncio_titulo', '$anuncio_mensaje')");
    $pk_alumno = $conexion -> insert_id;

    $conexion -> commit();

    echo "anuncio publicado";

}catch(Exception $e){
    $conexion -> rollback();
    echo "Error: ". $e -> getMessage() ."";
}

?>