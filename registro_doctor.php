<?php
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = Conexion::ConexionBD();

    $especialidad = $_POST["id_especialidad"];
    $queryEspecialidadId = "SELECT id_especialidad FROM especialidad WHERE id_especialidad = :especialidad";
    $stmtEspecialidadId = $conn->prepare($queryEspecialidadId);
    $stmtEspecialidadId->bindParam(':especialidad', $especialidad);

    if ($stmtEspecialidadId->execute()) {
        $rowsEspecialidad = $stmtEspecialidadId->fetchAll(PDO::FETCH_ASSOC);

        if (count($rowsEspecialidad) > 0) {
            $id_especialidad = $rowsEspecialidad[0]['id_especialidad'];
        } else {
            echo "Error: No se encontró ninguna coincidencia para la especialidad: $especialidad";
            exit();
        }
    } else {
        $errorInfo = $stmtEspecialidadId->errorInfo();
        echo "Error al ejecutar la consulta: " . $errorInfo[2];
        exit();
    }


    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $fecha_nacimiento = $_POST["fecha_nacimiento"];
    $correo = $_POST["correo"];
    $sexo = $_POST["sexo"];
    $telefono = $_POST["telefono"];
    $cedula = $_POST["cedula"];
    $colegiatura = $_POST["colegiatura"];
    $lugar_trabajo = $_POST["lugar_trabajo"];
    $seguro = $_POST["seguro"];
    $estudio_sec = $_POST["estudio_sec"];
    $universidad = $_POST["universidad"];
    $especialidad_uni = $_POST["especialidad_uni"];
    $titulo = $_POST["titulo"];
    $curso = $_POST["curso"];
    $experiencia = $_POST["experiencia"];
    $nacionalidad = $_POST["nacionalidad"];
    $provincia = $_POST["provincia"];
    $ciudad = $_POST["ciudad"];
    $direccion = $_POST["direccion"];
    $pass = $_POST["pass"];

    $sql = "INSERT INTO doctor (nombre, apellido, fecha_nacimiento, correo, sexo, telefono, cedula, colegiatura, id_especialidad, lugar_trabajo, seguro, estudio_sec, universidad, especialidad_uni, titulo, curso, experiencia, nacionalidad, provincia, ciudad, direccion, pass)
    VALUES (:nombre, :apellido, :fecha_nacimiento, :correo, :sexo, :telefono, :cedula, :colegiatura, :id_especialidad, :lugar_trabajo, :seguro, :estudio_sec, :universidad, :especialidad_uni, :titulo, :curso, :experiencia, :nacionalidad, :provincia, :ciudad, :direccion, :pass)";

    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':apellido', $apellido);
    $stmt->bindParam(':fecha_nacimiento', $fecha_nacimiento);
    $stmt->bindParam(':correo', $correo);
    $stmt->bindParam(':sexo', $sexo);
    $stmt->bindParam(':telefono', $telefono);
    $stmt->bindParam(':cedula', $cedula);
    $stmt->bindParam(':colegiatura', $colegiatura);
    $stmt->bindParam(':id_especialidad', $id_especialidad);
    $stmt->bindParam(':lugar_trabajo', $lugar_trabajo);
    $stmt->bindParam(':seguro', $seguro);
    $stmt->bindParam(':estudio_sec', $estudio_sec);
    $stmt->bindParam(':universidad', $universidad);
    $stmt->bindParam(':especialidad_uni', $especialidad_uni);
    $stmt->bindParam(':titulo', $titulo);
    $stmt->bindParam(':curso', $curso);
    $stmt->bindParam(':experiencia', $experiencia);
    $stmt->bindParam(':nacionalidad', $nacionalidad);
    $stmt->bindParam(':provincia', $provincia);
    $stmt->bindParam(':ciudad', $ciudad);
    $stmt->bindParam(':direccion', $direccion);
    $stmt->bindParam(':pass', $pass);

    if ($stmt->execute()) {
        echo "Registro exitoso";
        header("Location: login.php");
        exit();
    } else {
        $errorInfo = isset($stmt) ? $stmt->errorInfo() : null;
        echo "Error: " . ($errorInfo ? $errorInfo[2] : "No se pudo obtener información del error");
    }

    if (isset($conn)) {
        $conn = null;
    }
}
?>
