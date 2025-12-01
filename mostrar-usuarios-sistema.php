<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body>


    <h1 class="text-center">Usuarios</h1>

    <table class="table table-dark table-striped">

        <!--Aqui se integra el php-->
        <?php
        $conexion = new mysqli("localhost", "root", "", "sistema_inc");

        if ($conexion->connect_error) {
            die("Error de conexión: " . $conexion->connect_error);
        }

        $sql_verificar = "SELECT usuarios.pk_usuario, usuarios.nombre, usuarios.apellido, usuarios.direccion, usuarios.telefono, usuarios.email, rol.nombre_rol FROM usuarios JOIN rol ON usuarios.fk_rol = rol.pk_rol";
        $resultado = $conexion->query($sql_verificar);

        echo " <tr> <th>ID</th> <th>Nombre</th><th>Apellido/s</th><th>Dirección</th><th>Telefono</th><th>Email</th><th>Rol</th></tr>";
        while ($row = $resultado->fetch_assoc()){
            echo "<tr> <th> ".$row["pk_usuario"]."</th>".
            "<th>".$row["nombre"]."</th>".
            "<th>".$row["apellido"]."</th>".
            "<th>".$row["direccion"]."</th>".
            "<th>".$row["telefono"]."</th>".
            "<th>".$row["email"]."</th>".
            "<th>".$row["nombre_rol"]."</th>".
            "</tr>";
        }

        ?>

    </table>


    <!--Los estilos-->
 @media (max-width: 768px) {

        /* --- GLOBAL --- */
        
        /* Asegura que el cuerpo no tenga márgenes que causen scroll lateral */
        body {
            padding: 0 10px; /* Un poco de padding en los lados */
        }

        /* Ajusta el padding general de los contenedores */
        .container {
            padding: 0 10px;
        }

        /* --- NAVEGACIÓN (nav-menu) --- */
        
        /* Ocultar el menú horizontal y mostrarlo como columna */
        .nav-menu {
            display: none; /* Oculta el menú grande por defecto */
            flex-direction: column;
            width: 100%;
            text-align: center;
            background: #4A90A4; /* Fondo del menú */
            position: absolute;
            top: 60px; /* Justo debajo de la barra de navegación */
            left: 0;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        
        /* Mostrar el menú si el usuario decide implementar un botón de "menú hamburguesa" */
        /* Por ahora, solo lo preparamos para que se muestre como columna. */
        .nav-container {
            flex-direction: column; /* Apila el logo y el menú (si se muestra) */
            align-items: flex-start;
            padding: 10px;
        }
        
        /* El botón del sistema debe ocupar todo el ancho */
        .btn-sistema {
            width: 90%;
            margin-top: 10px;
            text-align: center;
        }
        
        /* --- GRID DE TARJETAS (como en pruebaVerUsuarios_direcor.php) --- */

        /* Cambia la vista de 3 columnas a 1 columna para que las tarjetas se apilen */
        main {
            grid-template-columns: 1fr !important; /* !important es para asegurar que anule el grid existente */
            gap: 30px !important;
            margin: 20px 0 !important;
        }
        
        /* Ajusta el tamaño de la imagen del perfil en las tarjetas */
        .card-container-user img, #card-add-user img {
            width: 80px !important;
            height: 80px !important;
        }
        
        /* Ajusta el tamaño de los botones en las tarjetas de usuario */
        .group-buttons {
            flex-direction: column;
            gap: 10px;
        }
        
        .group-buttons a, .group-buttons button {
            width: 100%;
        }


        /* --- TABLAS (como en mostrar-usuarios-sistema.php) --- */

        /* Hace que la tabla no se salga de la pantalla forzando un scroll horizontal solo para ella */
        .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        /* Las tablas de Bootstrap se vuelven responsivas con una clase en un div contenedor */
        /* Para esto, envuelve tu tabla en un div con esta clase: */
        /* <div class="table-responsive">
            <table class="table table-dark table-striped">...</table>
        </div> */
        
        /* --- FORMULARIOS --- */
        
        /* Ajusta el ancho de los elementos de formulario y botones para que sean más grandes */
        .form-group, button {
            width: 100%;
            max-width: 400px; /* Ancho máximo para que no se extienda demasiado en tabletas */
        }
        
        /* Ajusta el ancho de botones grandes */
        #regresar_btn, button {
            width: 80%; 
            margin: 10px auto;
            padding: 15px;
            font-size: 1.1rem;
        }
        
        /* --- ANUNCIOS (en nosotros.php) --- */

        /* Cambia el grid de anuncios a una sola columna */
        .anuncios-grid {
            grid-template-columns: 1fr !important;
            gap: 20px !important;
        }

        /* --- Ficha de Inscripción Específica (Para este archivo) --- */

        /* Apila los grupos de datos en la ficha */
        .datos-grupo {
            flex-direction: column;
            gap: 10px;
        }

        /* Las tarjetas de documentos ocupan todo el ancho, no el 45% */
        #documentos-container {
            flex-direction: column;
            gap: 15px;
        }

        .documento-card {
            width: 100%;
            max-width: 350px;
            margin: 0 auto;
        }

        /* Apila los botones de Aceptar/Rechazar */
        .boones {
            flex-direction: column;
            gap: 15px;
            width: 90%;
        }

        .aceptar, .rechazar {
            width: 100%;
        }
    }
    <style>

        

    </style>

    
</body>
</html>
