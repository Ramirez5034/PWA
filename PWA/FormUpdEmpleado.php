<!DOCTYPE html>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>
<body>  
<?php

$id = $_GET["IDEmpleado"];

require('config.php');

$conn = new mysqli($servername, $username, $password, $dbname);

$consulta = "SELECT * FROM Empleado WHERE IDEmpleado = $id";
$datos = $conn->query($consulta);

if ($datos->num_rows > 0) {
    $registro = $datos->fetch_assoc();
    echo '
    <center>
    <form class="col-3" action="UpdEmpleado.php" method="post">
        <!-- Nombre del empleado -->
        <label class="form-label" for="nombre"><h1>Nombre:</h1></label><br>
        <input class="form-control" type="text" id="nombre" name="nombre" value="'.$registro["Nombre"].'"><br>
        
        <!-- Puesto del empleado -->
        <label class="form-label" for="puesto"><h1>Puesto:</h1></label><br>
        <input class="form-control" type="text" id="puesto" name="puesto" value="'.$registro["Puesto"].'"><br>
        
        <!-- Fecha de contratación -->
        <label class="form-label" for="contratacion"><h1>Fecha de Contratación:</h1></label><br>
        <input class="form-control" type="date" id="contratacion" name="contratacion" value="'.$registro["Contratacion"].'"><br>
        
        <!-- Botón para modificar el registro -->
        <input class="btn btn-primary" type="submit" value="Modificar">
        
        <!-- Campo oculto para enviar el ID del empleado -->
        <input type="hidden" id="IDEmpleado" name="IDEmpleado" value="'.$id.'">
    </form>
    </center>';
}
?>
</body>
</html>
