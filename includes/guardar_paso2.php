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
    $frecuencia = $_POST['frecuencia'] ?? '';
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
            frecuencia = ?, 
            implicados_nombres = ?, 
            implicados_area = ?, 
            fecha_incidente_estimada = ?, 
            ubicacion_entorno = ?, 
            descripcion_hechos = ?,
            drive_folder_id = ? 
            WHERE id = ?";

    $stmt = $conexion->prepare($sql);
    // Usamos el código de caso como drive_folder_id temporalmente
    $stmt->bind_param("ssssssssi", $tipo_incidente, $frecuencia, $involucrados, $area_implicado, $fecha_incidente, $ubicacion, $descripcion, $codigo_caso, $id_registro);

    if ($stmt->execute()) {
        // 1. Obtener el email del registro actual
        $id_denuncia_actual = $_SESSION['id_denuncia'];
        $check_mail = $conexion->prepare("SELECT denunciante_email FROM denuncias WHERE id = ?");
        $check_mail->bind_param("i", $id_denuncia_actual);
        $check_mail->execute();
        $resultado_db = $check_mail->get_result()->fetch_assoc();

        $email_destino = $resultado_db['denunciante_email'] ?? '';

        // 2. Lógica de envío si el email no está vacío
        if (!empty($email_destino)) {
            require_once __DIR__ . '/mail_config.php';
            enviarCorreoConfirmacion($email_destino, $codigo_caso);
        }

        $codigo_final = $codigo_caso;
        session_destroy();
        header("Location: ../templates/frame_exito.php?caso=" . urlencode($codigo_final));
        exit();
    }
}
