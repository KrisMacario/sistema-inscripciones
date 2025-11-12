<?php
// 1. Conexión a la base de datos (copiado de pruebaverUsuarios.php)
$conexion = new mysqli("localhost", "root", "", "sistema_inc");

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// 2. Verificar que el ID del usuario exista y prepararlo
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id_usuario = $_GET['id'];

    // 3. Consulta SQL para eliminar el usuario
    $sql_eliminar = "DELETE FROM usuarios WHERE pk_usuario = ?";
    // *IMPORTANTE: La tabla se llama 'usuarios' y el ID es 'pk_usuario', según tu código*

    // Usar sentencia preparada (¡Más seguro!)
    if ($stmt = $conexion->prepare($sql_eliminar)) {
        // 'i' indica que el valor es un entero (integer)
        $stmt->bind_param("i", $id_usuario); 

        // 4. Ejecutar la eliminación
        if ($stmt->execute()) {
            $mensaje = "Usuario eliminado exitosamente.";
        } else {
            $mensaje = "Error al eliminar el usuario: " . $stmt->error;
        }

        $stmt->close();
    } else {
        $mensaje = "Error al preparar la consulta de eliminación.";
    }

} else {
    $mensaje = "ID de usuario inválido o no proporcionado.";
}

// 5. Cerrar la conexión y redirigir al usuario de vuelta a la lista
$conexion->close();

// Redirección de vuelta a la lista de usuarios con un mensaje
header("Location: pruebaverUsuarios.php?resultado=" . urlencode($mensaje));
exit();
?>