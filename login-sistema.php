<?php
$conexion = new mysqli("localhost", "root", "", "sistema_inc");

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

$correo = $_POST['correo'];
$contraseña = $_POST['contraseña'];
$exito = false;

// ✅ Incluye el rol en la consulta
$sql_verificar = "SELECT email, contraseña, nombre, apellido, fk_rol FROM usuarios WHERE email = ? AND contraseña = ?";
$stmt = $conexion->prepare($sql_verificar);
$stmt->bind_param("ss", $correo, $contraseña);
$stmt->execute();
$resultado = $stmt->get_result();

while ($row = $resultado->fetch_assoc()) {
    session_start();
    $_SESSION['usuario'] = $row["nombre"];
    $_SESSION['apellido'] = $row["apellido"];
    $_SESSION['rol'] = $row["fk_rol"]; // ✅ Guarda el rol en sesión

    // ✅ Redirige según el rol
    if ($row["fk_rol"] == 2) {
        header("Location: vista-director-inicio.php"); // Vista exclusiva para director
    } else if($row["fk_rol"] == 1){
        header("Location: vista-admin-inicio.php"); // Vista para admin
    }

    $exito = true;
    break;
}

if ($exito == false) {
    echo "<p>Correo o contraseña incorrectos</p>";
}
?>
