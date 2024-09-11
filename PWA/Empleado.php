<!DOCTYPE html>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    
    <link rel="manifest" href="Manifest.json">

    <script>
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', () => {
                navigator.serviceWorker.register('Sw.js')
                    .then((registration) => {
                        console.log('Service Worker registrado con éxito:', registration.scope);
                    })
                    .catch((error) => {
                        console.error('Error en el registro del Service Worker:', error);
                    });
            });
        }
    </script>
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h2 class="mb-4">Lista de Empleados Activos</h2>
        <?php
        require_once('config.php');

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Error de conexión: " . $conn->connect_error);
        }

        $consulta = "SELECT * FROM Empleado WHERE Status = 1";
        $datos = $conn->query($consulta);

        if ($datos->num_rows > 0) {
            echo '<table class="table table-hover table-bordered table-striped">';
            echo '<thead class="table-dark">';
            echo "<tr>";
            echo "<th><p>Nombre</p></th>";
            echo "<th><p>Puesto</p></th>";
            echo "<th><p>Fecha de Contratación</p></th>";
            echo "<th><p>Acciones</p></th>";
            echo "</tr>";
            echo '</thead>';
            echo '<tbody>';

            while ($registro = $datos->fetch_assoc()) {
                echo '
                    <tr>           
                        <td>'.$registro["Nombre"].'</td>
                        <td>'.$registro["Puesto"].'</td>
                        <td>'.$registro["Contratacion"].'</td>
                        <td>
                            <a href="FormUpdEmpleado.php?IDEmpleado='.$registro["IDEmpleado"].'" class="btn btn-warning btn-sm">
                                <i class="bi bi-pencil-square"></i> Editar
                            </a>
                            <a href="DelEmpleado.php?IDEmpleado='.$registro["IDEmpleado"].'" onclick="return confirm(\'¿Estás seguro de que deseas eliminar este registro?\')" class="btn btn-danger btn-sm">
                                <i class="bi bi-trash-fill"></i> Eliminar
                            </a>
                        </td>
                    </tr>';
            }
            echo '</tbody>';
            echo "</table>";
        } else {
            echo '<div class="alert alert-warning" role="alert">No se encontraron empleados activos.</div>';
        }

        echo '<a href="ForminserEmpleado.html" class="btn btn-primary mt-3"><i class="bi bi-plus-square"></i> Añadir nuevo empleado</a>';

        $conn->close();
        ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>
