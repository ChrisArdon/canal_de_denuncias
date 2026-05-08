<?php
session_start();
require_once __DIR__ . '/../includes/db_connect.php';

// Obtenemos el código de la URL
$codigo_caso = $_GET['caso'] ?? 'ERROR-000';

// Consultamos si es anónima para la lógica del correo
$stmt = $conexion->prepare("SELECT tipo_denuncia, denunciante_email FROM denuncias WHERE codigo_seguimiento = ?");
$stmt->bind_param("s", $codigo_caso);
$stmt->execute();
$resultado = $stmt->get_result()->fetch_assoc();

$es_anonimo = ($resultado['tipo_denuncia'] == 'anonimo') ? 1 : 0;
$email_usuario = $resultado['denunciante_email'] ?? '';

function enmascararEmail($email)
{
    if (!$email) return '';
    $partes = explode("@", $email);
    return substr($partes[0], 0, 1) . "***@" . $partes[1];
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Denuncia Recibida - Canal de Ética</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap");

        body {
            font-family: "Inter", sans-serif;
        }
    </style>
</head>

<body class="bg-neutral-100 antialiased min-h-screen flex flex-col">

    <header class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16 md:h-20">
                <div class="flex items-center space-x-2">
                    <div class="w-8 h-8 md:w-10 md:h-10 bg-blue-700 rounded-lg flex items-center justify-center">
                        <span class="text-white font-bold text-lg md:text-xl">🛡️</span>
                    </div>
                    <span class="font-semibold text-neutral-900 text-sm md:text-base">
                        FUNDEMAS
                    </span>
                </div>
                <nav class="hidden md:flex space-x-8">
                    <a href="../index.php" class="text-neutral-700 hover:text-blue-600 transition text-sm font-medium">Inicio</a>
                    <a href="#" class="text-neutral-700 hover:text-blue-600 transition text-sm font-medium">La Fundación</a>
                    <a href="#" class="text-blue-700 font-semibold text-sm border-b-2 border-blue-700 pb-1">Canal de Denuncias</a>
                </nav>
                <div class="flex items-center space-x-3">
                    <div class="flex items-center border border-neutral-300 rounded-md px-2 py-1 text-sm">
                        <span class="font-medium text-neutral-800">ES</span>
                        <span class="mx-1 text-neutral-400">|</span>
                        <span class="text-neutral-500">EN</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <main class="flex-grow flex items-center justify-center p-6">
        <div class="max-w-2xl w-full bg-white shadow-xl rounded-2xl overflow-hidden border border-neutral-200">

            <div class="p-8 space-y-8">
                <div class="text-center">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-green-100 text-green-600 rounded-full mb-4">
                        <i class="fas fa-check text-3xl"></i>
                    </div>
                    <h2 class="text-3xl font-bold text-neutral-900 uppercase tracking-tight">¡Denuncia Recibida!</h2>
                    <p class="text-neutral-600 mt-3 text-lg">
                        Su reporte ha sido ingresado correctamente al sistema y será procesado en un máximo de <span class="font-bold text-neutral-900">5 días hábiles</span>.
                    </p>
                </div>

                <div class="bg-neutral-50 border border-neutral-200 rounded-xl p-6 text-center">
                    <h3 class="text-neutral-500 font-bold flex justify-center items-center gap-2 text-sm tracking-wider uppercase">
                        <i class="fas fa-key text-yellow-500"></i> Su Número de Seguimiento
                    </h3>

                    <div class="my-5 p-5 bg-white border-2 border-dashed border-blue-300 rounded-xl">
                        <span class="text-2xl md:text-3xl font-mono font-bold text-blue-800 tracking-widest" id="caseID">
                            <?php echo htmlspecialchars($codigo_caso); ?>
                        </span>
                    </div>

                    <p class="text-xs text-red-500 font-medium mb-5">
                        <i class="fas fa-exclamation-circle mr-1"></i> GUARDE ESTE NÚMERO. Es indispensable para consultar avances.
                    </p>

                    <div class="flex flex-col sm:flex-row gap-3">
                        <button onclick="copyToClipboard()" class="flex-1 bg-neutral-900 text-white px-6 py-3 rounded-lg hover:bg-black transition flex items-center justify-center gap-2 font-semibold">
                            <i class="fas fa-copy"></i> COPIAR CÓDIGO
                        </button>
                        <button onclick="window.print()" class="flex-1 border-2 border-neutral-900 text-neutral-900 px-6 py-3 rounded-lg hover:bg-neutral-50 transition flex items-center justify-center gap-2 font-semibold">
                            <i class="fas fa-file-pdf"></i> DESCARGAR PDF
                        </button>
                    </div>
                </div>

                <?php if (!$es_anonimo && !empty($email_usuario)): ?>
                    <div class="flex items-start bg-blue-50 border-l-4 border-blue-600 p-5 rounded-r-lg">
                        <i class="fas fa-envelope text-blue-600 mt-1 mr-4 text-xl"></i>
                        <div>
                            <p class="text-xs font-bold text-blue-900 uppercase tracking-widest mb-1">Confirmación Enviada</p>
                            <p class="text-sm text-blue-800">Se han enviado los detalles de recepción a: <strong><?php echo enmascararEmail($email_usuario); ?></strong></p>
                        </div>
                    </div>
                <?php endif; ?>

                <div class="pt-6 border-t border-neutral-100 text-center">
                    <a href="../index.php" class="inline-flex items-center justify-center w-full bg-blue-700 text-white py-4 rounded-xl font-bold hover:bg-blue-800 transition-all shadow-lg hover:shadow-blue-200 uppercase tracking-wider">
                        Ir al Seguimiento de Caso <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
            </div>
        </div>
    </main>

    <footer class="bg-neutral-900 text-neutral-400 py-8 border-t border-neutral-800">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <p class="text-sm">© 2026 FUNDEMAS. Todos los derechos reservados.</p>
            <p class="text-xs mt-2 italic">¿Reportaste por error? Contáctanos: etica@fundacion.org</p>
        </div>
    </footer>

    <script>
        function copyToClipboard() {
            const text = document.getElementById('caseID').innerText;
            navigator.clipboard.writeText(text).then(() => {
                alert("Código copiado al portapapeles correctamente.");
            });
        }
    </script>
</body>

</html>