<?php
require_once __DIR__ . '/db_connect.php';
session_start();

// Verificamos que exista la sesión de la denuncia iniciada
if (!isset($_SESSION['id_denuncia'])) {
    header("Location: ../index.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_registro = $_SESSION['id_denuncia'];
    $codigo_caso = $_SESSION['codigo_caso'];

    // 1. Captura de datos
    $tipo_incidente  = $_POST['tipo_incidente'] ?? '';
    $involucrados    = $_POST['involucrados'] ?? '';
    $area_implicado  = $_POST['area_implicado'] ?? '';
    $fecha_incidente = $_POST['fecha_incidente'] ?? null;
    $ubicacion       = $_POST['ubicacion'] ?? '';
    $descripcion     = $_POST['descripcion'] ?? '';

    // 2. Manejo de Archivos Local (Simulacro de Drive)
    $nombres_archivos = [];
    if (isset($_FILES['evidencias'])) {
        // Creamos carpeta con el nombre del caso si no existe
        $directorio = "../uploads/" . $codigo_caso . "/";
        if (!file_exists($directorio)) {
            mkdir($directorio, 0777, true);
        }

        foreach ($_FILES['evidencias']['tmp_name'] as $key => $tmp_name) {
            $nombre_original = $_FILES['evidencias']['name'][$key];
            if ($nombre_original != "") {
                $ruta_destino = $directorio . $nombre_original;
                if (move_uploaded_file($tmp_name, $ruta_destino)) {
                    $nombres_archivos[] = $nombre_original;
                }
            }
        }
    }
    $evidencias_texto = implode(", ", $nombres_archivos);

    // 3. Actualizar la base de datos
    $sql = "UPDATE denuncias SET
            tipo_incidente = ?, 
            implicados_nombres = ?, 
            implicados_area = ?, 
            fecha_incidente_estimada = ?, 
            ubicacion_entorno = ?, 
            descripcion_hechos = ?,
            drive_folder_id = ? 
            WHERE id = ?";

    $stmt = $conexion->prepare($sql);
    // Usamos el código de caso como drive_folder_id temporalmente
    $stmt->bind_param("sssssssi", $tipo_incidente, $involucrados, $area_implicado, $fecha_incidente, $ubicacion, $descripcion, $codigo_caso, $id_registro);

    if ($stmt->execute()) {
        // Destruimos la sesión para que no se dupliquen datos si recarga
        session_destroy();
        // Redirigir a una página de éxito
        header("Location: ../templates/frame_exito.php?caso=" . $codigo_caso);
    } else {
        echo "Error al actualizar: " . $conexion->error;
    }
}
