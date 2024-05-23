<?php
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $conn = Conexion::ConexionBD();

    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $fecha_nacimiento = $_POST["fecha_nacimiento"];
    $correo = $_POST["correo"];
    $sexo = $_POST["sexo"];
    $telefono = $_POST["telefono"];
    $cedula = $_POST["cedula"];
    $ocupacion = $_POST["ocupacion"];
    $seguro = $_POST["seguro"];
    $sangre = $_POST["sangre"];
    $nacionalidad = $_POST["nacionalidad"];
    $provincia = $_POST["provincia"];
    $ciudad = $_POST["ciudad"];
    $direccion = $_POST["direccion"];
    $familiar_nombre = $_POST["familiar_nombre"];
    $familiar_apellido = $_POST["familiar_apellido"];
    $familiar_direccion = $_POST["familiar_direccion"];
    $familiar_correo = $_POST["familiar_correo"];
    $familiar_telefono = isset($_POST["familiar_telefono"]) ? $_POST["familiar_telefono"] : '';
    $pass = $_POST["pass"];

    $sql = "INSERT INTO paciente (nombre, apellido, fecha_nacimiento, correo, sexo, telefono, cedula, ocupacion, seguro, sangre, nacionalidad, provincia, ciudad, direccion, familiar_nombre, familiar_apellido, familiar_direccion, familiar_correo, familiar_telefono, pass)
    VALUES (:nombre, :apellido, :fecha_nacimiento, :correo, :sexo, :telefono, :cedula, :ocupacion, :seguro, :sangre, :nacionalidad, :provincia, :ciudad, :direccion, :familiar_nombre, :familiar_apellido, :familiar_direccion, :familiar_correo, :familiar_telefono, :pass)";

    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':apellido', $apellido);
    $stmt->bindParam(':fecha_nacimiento', $fecha_nacimiento);
    $stmt->bindParam(':correo', $correo);
    $stmt->bindParam(':sexo', $sexo);
    $stmt->bindParam(':telefono', $telefono);
    $stmt->bindParam(':cedula', $cedula);
    $stmt->bindParam(':ocupacion', $ocupacion);
    $stmt->bindParam(':seguro', $seguro);
    $stmt->bindParam(':sangre', $sangre);
    $stmt->bindParam(':nacionalidad', $nacionalidad);
    $stmt->bindParam(':provincia', $provincia);
    $stmt->bindParam(':ciudad', $ciudad);
    $stmt->bindParam(':direccion', $direccion);
    $stmt->bindParam(':familiar_nombre', $familiar_nombre);
    $stmt->bindParam(':familiar_apellido', $familiar_apellido);
    $stmt->bindParam(':familiar_direccion', $familiar_direccion);
    $stmt->bindParam(':familiar_correo', $familiar_correo);
    $stmt->bindParam(':familiar_telefono', $familiar_telefono);
    $stmt->bindParam(':pass', $pass);

    if ($stmt->execute()) {
        echo "Registro exitoso";
        header("Location: login.php");
    } else {
        $errorInfo = $stmt->errorInfo();
        echo "Error: " . ($errorInfo ? $errorInfo[2] : "No se pudo obtener información del error");
    }
}

if (isset($conn)) {
    $conn = null;
}
?>
