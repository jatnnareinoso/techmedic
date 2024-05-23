<?php
include 'conexion.php';
session_start();

$conn = Conexion::ConexionBD();

if (isset($_SESSION['correo_doctor'])) {
    $correo_doctor = $_SESSION['correo_doctor'];

    $sql = "SELECT * FROM doctor WHERE correo = :correo";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':correo', $correo_doctor);
    $stmt->execute();

    $doctor = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($doctor) {
        $idEspecialidad = $doctor['id_especialidad'];
        echo "ID de especialidad: $idEspecialidad <br>";

        $sqlEspecialidad = "SELECT especialidad FROM especialidad WHERE id_especialidad = :id_especialidad";
        $stmtEspecialidad = $conn->prepare($sqlEspecialidad);
        $stmtEspecialidad->bindParam(':id_especialidad', $idEspecialidad);
        $stmtEspecialidad->execute();
    } else {
        $errorInfo = isset($conn) ? $conn->errorInfo() : null;
        echo "Error: " . ($errorInfo ? $errorInfo[2] : "No se pudo obtener información del doctor");
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_paciente = isset($_POST['id_paciente']) ? $_POST['id_paciente'] : '';
    $fecha_consulta = isset($_POST['fecha_consulta']) ? $_POST['fecha_consulta'] : '';
    $diagnostico = isset($_POST['diagnostico']) ? $_POST['diagnostico'] : '';
    $tratamiento = isset($_POST['tratamiento']) ? $_POST['tratamiento'] : '';
    $cita = isset($_POST['cita']) ? $_POST['cita'] : '';
    $observacion = isset($_POST['observacion']) ? $_POST['observacion'] : '';

    $id_doctor = isset($doctor['id_doctor']) ? $doctor['id_doctor'] : '';

    if (empty($id_doctor)) {
        echo "El doctor no tiene un ID válido.";
        exit;
    }

    $sqlInsertConsulta = "INSERT INTO consulta (id_paciente, id_doctor, fecha_consulta, diagnostico, tratamiento, cita, observacion) 
                         VALUES (:id_paciente, :id_doctor, :fecha_consulta, :diagnostico, :tratamiento, :cita, :observacion)";
    $stmtInsertConsulta = $conn->prepare($sqlInsertConsulta);
    $stmtInsertConsulta->bindParam(':id_paciente', $id_paciente);
    $stmtInsertConsulta->bindParam(':id_doctor', $id_doctor);
    $stmtInsertConsulta->bindParam(':fecha_consulta', $fecha_consulta);
    $stmtInsertConsulta->bindParam(':diagnostico', $diagnostico);
    $stmtInsertConsulta->bindParam(':tratamiento', $tratamiento);
    $stmtInsertConsulta->bindParam(':cita', $cita);
    $stmtInsertConsulta->bindParam(':observacion', $observacion);

    if ($stmtInsertConsulta->execute()) {
        header("Location: citas.php");
        exit;
    } else {
        $errorInfoInsertConsulta = isset($conn) ? $conn->errorInfo() : null;
        echo "Error al insertar la consulta: " . ($errorInfoInsertConsulta ? $errorInfoInsertConsulta[2] : "No se pudo insertar la consulta");
    }
} else {
    echo "El formulario no se ha enviado correctamente.";
}
?>
