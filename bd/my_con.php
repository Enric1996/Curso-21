<?php
const HOST = "localhost";
const DB_USER = "root";
const DB_PWD = "";
const DB_NAME = "lliga1213";


function conectar($host = HOST, $usuario = DB_USER, 
                    $contraseña = DB_PWD, $dbname = DB_NAME)
{
    $conexion = @mysqli_connect($host, $usuario, $contraseña, $dbname);
    return $conexion;
}
// Definición de una pequeña función que cierra una conexión. 
function desconectar($conexion)
{
    if ($conexion) {
        $ok = @mysqli_close($conexion);
    }
}


?>