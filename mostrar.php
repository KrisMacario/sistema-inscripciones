<?php
$conexion = new mysqli("localhost", "root", "", "inscrprim");
$resultado = $conexion->query("SELECT * FROM logear");

while($fila = $resultado->fetch_assoc()){
    echo "Correo: " . $fila["email_o_usuario"] .
    " | contra: " . $fila["contraseña"] . "<br>";
}
?>
