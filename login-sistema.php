<?php
$conexion = new mysqli("localhost", "root", "", "sistema_inc");

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

$correo = $_POST['correo'];
$contraseña = $_POST['contraseña'];
$exito = false;

$sql_verificar = "Select email,contraseña, nombre, apellido from usuarios where email ='$correo' and contraseña ='$contraseña'";
$resultado = $conexion->query($sql_verificar);
//$sql_logear = "INSERT INTO logear (pk_logear,email_o_usuario,contraseña) VALUES (Null,'$correo', '$contraseña')";


while ($row = $resultado->fetch_assoc()){
    if ($row["email"] == $correo and $row["contraseña"] == $contraseña){
        session_start();
        $_SESSION['usuario'] = $row["nombre"]; //guardar el nombre del usuario en la sesión
        $_SESSION['apellido'] = $row["apellido"]; //guardar el apellido del usuario en la sesión
        header("location: vista-admin-inicio.php");
        $exito = true;
        break;
    }
}
if ($exito == false){
    echo "<p>email o contraseña incorrectos</p>";
}

?>
