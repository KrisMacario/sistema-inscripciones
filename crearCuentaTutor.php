<?php
$conexion = new mysqli("localhost", "root", "", "inscrprim");

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

$correo = $_POST['crearCuentaTutor_correo'];
$contraseña = $_POST['crearCuentaTutor_contraseña'];

$sql_logear = "INSERT INTO logear (pk_logear,email_o_usuario,contraseña) VALUES (Null,'$correo', '$contraseña')";


$nombreTutor = $_POST['crearCuentaTutor_nombre'];
$apellidosTutor = $_POST['crearCuentaTutor_apellidos'];
$numeroTutor = $_POST['crearCuentaTutor_numero'];
$direccionTutor = $_POST['crearCuentaTutor_dirección'];
$sql_conseguir_id = "SELECT pk_logear FROM logear WHERE pk_logear = SELECT MAX(pk_logear)";

$sql_padre_tutor = "INSERT INTO padre_tutor (pk_padre_tutor, nombre, apellido, telefono, direccion, fk_logear) VALUES (Null, '$nombreTutor','$apellidosTutor','$numeroTutor','$direccionTutor','(int)$sql_conseguir_id[pk_logear]')";

if ($conexion->query($sql_logear) === TRUE && $conexion->query($sql_padre_tutor) === TRUE) {
    echo "Cuenta creada exitosamente.<br>";
    echo "<a href='mostrar.php'>Ver registros</a>";
} else {
    echo "Error: " . $conexion->error;
}
?>
