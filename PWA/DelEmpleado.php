<?php

require_once('Config.php');

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
$id = $_GET["IDEmpleado"];

$sql = "UPDATE Empleado SET Status = 0 WHERE IDEmpleado = ". $id;

$resultado = mysqli_query($conn, $sql);

header("Location: Empleado.php");

mysqli_close($conn);

?>
