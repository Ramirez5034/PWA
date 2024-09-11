<?php


require('config.php');
$conn = new mysqli($servername, $username, $password, $dbname);

$id = $_POST["IDEmpleado"];
$nombre = $_POST["nombre"];
$puesto = $_POST["puesto"];
$contratacion = $_POST["contratacion"];

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

$sql = "UPDATE Empleado 
        SET Nombre = '$nombre', Puesto = '$puesto', Contratacion = '$contratacion'
        WHERE IDEmpleado = $id";

if (mysqli_query($conn, $sql)) {
    header("Location: Empleado.php"); 
} else {
    echo "Error al actualizar el empleado: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
