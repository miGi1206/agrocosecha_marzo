<?php
// variables de conexion
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bd_agrocosecha";

// creando la conexion
$conn = mysqli_connect($servername, $username, $password, $dbname);

//chack la conecion
if(!$conn)
{
    die("connection failed: " . mysqli_connect_error());
}
// echo "conexion exitosa";
?>