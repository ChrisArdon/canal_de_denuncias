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

        :root {
            --brand-blue: #007A99;
            --brand-yellow: #FEC221;
        }

        .bg-brand-blue {
            background-color: var(--brand-blue);
        }

        .text-brand-blue {
            color: var(--brand-blue);
        }

        .bg-brand-yellow {
            background-color: var(--brand-yellow);
        }

        .text-brand-yellow {
            color: var(--brand-yellow);
        }

        /* Bordes y estados hover */
        .border-brand-blue {
            border-color: var(--brand-blue);
        }

        .hover\:bg-brand-blue-dark:hover {
            background-color: #006680;
        }
    </style>
</head>

<body class="bg-neutral-100 antialiased min-h-screen flex flex-col">

    <header class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16 md:h-20">
                <div class="flex items-center">
                    <a href="index.php" class="flex items-center">
                        <img
                            src="../assets/logo_fundemas.png"
                            alt="Logo FUNDEMAS"
                            class="h-10 md:h-14 w-auto object-contain" />
                    </a>
                </div>

                <nav class="hidden md:flex space-x-8">
                    <a href="https://fundemas.org/" class="text-neutral-700 hover:text-brand-blue transition text-sm font-medium">Inicio</a>
                    <a href="https://fundemas.org/quienes-somos/" class="text-neutral-700 hover:text-brand-blue transition text-sm font-medium">La Fundación</a>
                    <!-- <a href="#" class="text-neutral-700 hover:text-brand-blue transition text-sm font-medium">Transparencia</a> -->
                    <a href="#" class="text-brand-blue font-semibold text-sm border-b-2 border-brand-blue pb-1">Canal de Denuncias</a>
                    <a href="https://fundemas.org/contacto/" class="text-neutral-700 hover:text-brand-blue transition text-sm font-medium">Contacto</a>
                </nav>

                <div class="flex items-center space-x-3">
                    <!-- <div class="flex items-center border border-neutral-300 rounded-md px-2 py-1 text-sm">
              <span class="font-medium text-neutral-800">ES</span>
              <span class="mx-1 text-neutral-400">|</span>
              <span class="text-neutral-500">EN</span>
            </div> -->
                    <button class="md:hidden text-neutral-700 hover:text-brand-blue">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
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
                    <a href="seguimiento.php?caso=<?php echo urlencode($codigo_caso); ?>" class="inline-flex items-center justify-center w-full bg-brand-blue text-white py-4 rounded-xl font-bold hover:bg-blue-800 transition-all shadow-lg hover:shadow-blue-200 uppercase tracking-wider">
                        Ir al Seguimiento de Caso <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
            </div>
        </div>
    </main>

    <footer class="bg-neutral-900 text-neutral-300 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="col-span-1 md:col-span-2">
                    <div class="flex items-center mb-6">
                        <img
                            src="../assets/logo_fundemas.png"
                            alt="Logo FUNDEMAS"
                            class="h-12 w-auto brightness-0 invert" />
                    </div>
                    <p class="text-sm text-neutral-400 max-w-md leading-relaxed">
                        Fundación Empresarial para la Acción Social. Comprometidos con la transparencia, la ética y la integridad en todas nuestras operaciones para sumar al desarrollo sostenible.
                    </p>
                </div>

                <div>
                    <h4 class="text-white font-semibold mb-4 border-b border-neutral-800 pb-2">Legal</h4>
                    <ul class="space-y-3 text-sm">
                        <li>
                            <a href="https://fundemas.org/politicasdeprivacidad/" target="_blank" class="hover:text-brand-yellow transition flex items-center">
                                <i class="fas fa-chevron-right text-[10px] mr-2 opacity-50"></i> Aviso de Privacidad
                            </a>
                        </li>
                        <li>
                            <a href="https://fundemas.org/wp-content/uploads/2026/02/codigo-de-Etica_-FUNDEMAS-2026-.pdf" target="_blank" class="hover:text-brand-yellow transition flex items-center">
                                <i class="fas fa-chevron-right text-[10px] mr-2 opacity-50"></i> Código de Ética
                            </a>
                        </li>
                        <li>
                            <a href="https://fundemas.org/wp-content/uploads/2026/02/P-RH-006-Politica-de-Salvaguardia-2026-.pdf" target="_blank" class="hover:text-brand-yellow transition flex items-center">
                                <i class="fas fa-chevron-right text-[10px] mr-2 opacity-50"></i> Política de Salvaguardia
                            </a>
                        </li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-white font-semibold mb-4 border-b border-neutral-800 pb-2">Contacto</h4>
                    <ul class="space-y-3 text-sm">
                        <li class="flex items-start italic">
                            <i class="fas fa-envelope mr-3 mt-1 text-brand-yellow"></i>
                            <span>integridad@fundemas.org</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-phone-alt mr-3 mt-1 text-brand-yellow"></i>
                            <span>PBX: (503) 2212 - 1799<br><span class="text-xs opacity-60">Fax: (503) 2212 - 1798</span></span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-map-marker-alt mr-3 mt-1 text-brand-yellow"></i>
                            <span class="text-xs">Edificio FEPADE, primer nivel, Calle el Pedregal, Antiguo Cuscatlán.</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-neutral-800 mt-12 pt-8 flex flex-col md:flex-row justify-between items-center text-xs tracking-wide">
                <p class="uppercase font-medium">© 2026 <span class="text-brand-yellow">FUNDEMAS</span>. Todos los derechos reservados.</p>

                <div class="flex space-x-6 mt-6 md:mt-0">
                    <a href="https://www.facebook.com/fundemas/" class="text-neutral-400 hover:text-white transition text-lg" title="Facebook">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="https://www.instagram.com/fundemassv/" class="text-neutral-400 hover:text-white transition text-lg" title="Instagram">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#" class="text-neutral-400 hover:text-white transition text-lg" title="X (Twitter)">
                        <i class="fab fa-x-twitter"></i>
                    </a>
                </div>
            </div>
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