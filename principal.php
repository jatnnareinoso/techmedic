<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        include_once ("conexion.php");
        $conn = Conexion::ConexionBD();

        $query = "SELECT * FROM especialidad";
        $result = $conn->query($query);

        if ($result) {
            while ($fila = $result->fetch(PDO::FETCH_ASSOC)) {
                echo "id_especialidad: " . $fila["id_especialidad"] . "<br>";
                echo "especialidad: " . $fila["especialidad"] . "<br>";
                echo "descripcion: " . $fila["descripcion"] . "<br>";
                echo "<hr>";
            }
        } else {
            echo "Error en la consulta: " . $conn->error;
        }
    ?>
</body>
</html>