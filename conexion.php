<?php

class Conexion {

    public static function ConexionBD() {
        $host = "localhost";
        $dbname = "techmedic";
        $username = "root";
        $password = "";

        try {
            $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exp) {
            echo "Error de conexión: " . $exp->getMessage();
        }

        return $conn;
    }

}
?>
