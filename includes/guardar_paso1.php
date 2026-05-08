<?php
// Usamos __DIR__ para asegurar que busque en la misma carpeta 'includes'
require_once __DIR__ . '/db_connect.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Generar código único
    $codigo = "DEN-" . strtoupper(substr(md5(uniqid(mt_rand(), true)), 0, 6));

    $tipo = $_POST['tipo'] ?? 'anonimo';
    $es_anonimo = ($tipo == 'anonimo') ? 1 : 0;

    $nombre = $_POST['nombre'] ?? null;
    $email  = $_POST['email'] ?? null;
    $tel    = $_POST['telefono'] ?? null;
    $area   = $_POST['area'] ?? null;

    // Aquí usamos $conexion que viene de db_connect.php
    $stmt = $conexion->prepare("INSERT INTO denuncias (codigo_seguimiento, tipo_denuncia, denunciante_nombre, denunciante_email, denunciante_telefono, denunciante_area) VALUES (?, ?, ?, ?, ?, ?)");

    if ($stmt) {
        $stmt->bind_param("ssssss", $codigo, $tipo, $nombre, $email, $tel, $area);
        if ($stmt->execute()) {
            $_SESSION['id_denuncia'] = $conexion->insert_id;
            $_SESSION['codigo_caso'] = $codigo;
            header("Location: ../templates/frame3_detalles.php");
            exit();
        } else {
            echo "Error de ejecución: " . $stmt->error;
        }
    } else {
        echo "Error de preparación: " . $conexion->error;
    }
}
