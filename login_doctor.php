<?php
include 'conexion.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = Conexion::ConexionBD();

    $correo = $_POST["correo"];
    $pass = $_POST["pass"];

    $sqlDoctor = "SELECT * FROM doctor WHERE correo = '$correo' AND pass = '$pass'";
    $resultDoctor = $conn->query($sqlDoctor);

    if ($resultDoctor) {
        if ($resultDoctor->rowCount() > 0) {
            $_SESSION['correo_doctor'] = $correo;
            header("Location: perfil_doctor.php");
            exit;
        }
        else {
            echo "<script>alert('Usuario o contraseña incorrectos');</script>";
            header("Location: login.php");
        }
    } else {
        $errorInfoDoctor = isset($conn) ? $conn->errorInfo() : null;
        echo "Error: " . ($errorInfoDoctor ? $errorInfoDoctor[2] : "No se pudo obtener información del error");
        exit;
    }

    $sqlPaciente = "SELECT * FROM paciente WHERE correo = '$correo' AND pass = '$pass'";
    $resultPaciente = $conn->query($sqlPaciente);

    if ($resultPaciente) {
        if ($resultPaciente->rowCount() > 0) {
            $_SESSION['correo_paciente'] = $correo;
            header("Location: perfil_paciente.php");
            exit;
        } else {
            echo "<script>alert('Usuario o contraseña incorrectos');</script>";
            header("Location: login.php");
        }
    } else {
        $errorInfoPaciente = isset($conn) ? $conn->errorInfo() : null;
        echo "Error: " . ($errorInfoPaciente ? $errorInfoPaciente[2] : "No se pudo obtener información del error");
    }

    $conn = null;
}
?>
