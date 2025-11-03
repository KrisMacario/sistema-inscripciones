<?php

            $conexion = mysqli_connect("localhost","root","","sistema_inc");

            if($conexion->connect_error){
                die("Error de conexion: ". $conexion->connect_error);
            }

            //insertar los datos del usuario

?>