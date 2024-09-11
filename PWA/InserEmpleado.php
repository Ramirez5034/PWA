<!DOCTYPE html>
<html>
<head>
</head>
<body>
    <?php
    // Incluir la configuración para la conexión a la base de datos
    require_once('Config.php');

    // Crear la conexión
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar si la conexión fue exitosa
    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    // Obtener los valores del formulario
    $Nombre = $_POST["nombre"];
    $Puesto = $_POST["puesto"];
    $Contratacion = $_POST["contratacion"];

    // Preparar la consulta SQL para insertar el empleado
    $sql = "INSERT INTO Empleado (Nombre, Puesto, Contratacion, Status) 
            VALUES ('".$Nombre."', '".$Puesto."', '".$Contratacion."', 1)";

    // Ejecutar la consulta
    if (mysqli_query($conn, $sql)) {
        // Redirigir al usuario de vuelta a la página principal de empleados después de la inserción
        header("Location: Empleado.php"); 
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    // Cerrar la conexión
    mysqli_close($conn);
    ?>
</body>
</html>
