<?php
session_start();

include 'conexion.php';
$conn = Conexion::ConexionBD();

if (isset($_SESSION['correo_doctor'])) {
    $correo_doctor = $_SESSION['correo_doctor'];

    $sql = "SELECT * FROM doctor WHERE correo = '$correo_doctor'";
    $result = $conn->query($sql);

    if ($result) {
        $doctor = $result->fetch(PDO::FETCH_ASSOC);
        $id_doctor = $doctor['id_doctor'];
    } else {
        $errorInfo = isset($conn) ? $conn->errorInfo() : null;
        echo "Error: " . ($errorInfo ? $errorInfo[2] : "No se pudo obtener información del doctor");
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id_receptor = $_POST['id_receptor'];
        $contenido = $_POST['contenido'];

        $sqlInsertMensaje = "INSERT INTO mensaje (id_emisor, id_receptor, fecha_envio, contenido) VALUES (:id_doctor, :id_receptor, NOW(), :contenido)";
        $stmt = $conn->prepare($sqlInsertMensaje);

        if ($stmt) {
            $stmt->bindParam(':id_doctor', $id_doctor, PDO::PARAM_INT);
            $stmt->bindParam(':id_receptor', $id_receptor, PDO::PARAM_INT);
            $stmt->bindParam(':contenido', $contenido, PDO::PARAM_STR);

            if ($stmt->execute()) {
                echo "Mensaje enviado correctamente";
                header("Location: mensajeria.php");

            } else {
                $errorInfoInsert = $stmt->errorInfo();
                echo "Error al enviar el mensaje: " . ($errorInfoInsert ? $errorInfoInsert[2] : "No se pudo obtener información del error");
            }
        } else {
            $errorInfoStmt = isset($conn) ? $conn->errorInfo() : null;
            echo "Error al preparar la consulta: " . ($errorInfoStmt ? $errorInfoStmt[2] : "No se pudo obtener información del error");
        }
    }
} else {
    header("Location: login_doctor.php");
    exit;
}

$conn = null;
?>
