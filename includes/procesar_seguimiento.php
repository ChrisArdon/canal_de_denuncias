<?php
// includes/procesar_seguimiento.php
require_once __DIR__ . '/db_connect.php'; // Al estar en la misma carpeta, solo se llama así
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $codigo = trim($_POST['codigo_caso']);

    $stmt = $conexion->prepare("SELECT codigo_seguimiento FROM denuncias WHERE codigo_seguimiento = ?");
    $stmt->bind_param("s", $codigo);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        // Encontrado: Salimos de includes y vamos a templates
        header("Location: ../templates/ver_estado.php?caso=" . urlencode($codigo));
        exit();
    } else {
        // No encontrado: Salimos de includes y vamos a templates
        header("Location: ../templates/seguimiento.php?error=no_encontrado");
        exit();
    }
}