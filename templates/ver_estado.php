<?php
// templates/ver_estado.php
require_once __DIR__ . '/../includes/db_connect.php';

$codigo = $_GET['caso'] ?? '';

// Consultamos los datos incluyendo el estado y el comentario público
$stmt = $conexion->prepare("SELECT fecha_creacion, tipo_incidente, denunciante_area, estado, comentario_publico FROM denuncias WHERE codigo_seguimiento = ?");
$stmt->bind_param("s", $codigo);
$stmt->execute();
$denuncia = $stmt->get_result()->fetch_assoc();

if (!$denuncia) {
    header("Location: seguimiento.php?error=no_encontrado");
    exit();
}

// Función para determinar la fase visual según el estado de la DB
function determinarFase($estado_db)
{
    $fases = [
        'Pendiente' => 1,
        'En Revision' => 2,
        'Investigacion' => 3,
        'Resuelto' => 4,
        'Desestimado' => 4
    ];
    return $fases[$estado_db] ?? 1;
}

$fase_actual = determinarFase($denuncia['estado']);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estado del Caso - FUNDEMAS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
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
    </style>
</head>

<body class="bg-neutral-100 min-h-screen flex flex-col">

    <header class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16 md:h-20">
                <div class="flex items-center">
                    <a href="../index.php" class="flex items-center">
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

    <main class="flex-grow p-6">
        <div class="max-w-3xl mx-auto space-y-6">

            <div class="bg-white shadow-xl rounded-2xl overflow-hidden border border-neutral-200">
                <div class="bg-brand-blue p-6 text-white flex justify-between items-center">
                    <div>
                        <p class="text-blue-100 text-xs uppercase font-bold tracking-widest mb-1">Estado Actual</p>
                        <h2 class="text-xl font-bold uppercase"><?php echo htmlspecialchars($denuncia['estado']); ?></h2>
                    </div>
                    <div class="bg-white/20 p-3 rounded-xl">
                        <i class="fas <?php echo ($denuncia['estado'] == 'Resuelto') ? 'fa-check-double' : 'fa-spinner fa-spin'; ?> text-2xl"></i>
                    </div>
                </div>

                <div class="p-8">
                    <?php if (!empty($denuncia['comentario_publico'])): ?>
                        <div class="mb-8 bg-blue-50 border-l-4 border-brand-blue p-6 rounded-r-xl">
                            <h3 class="text-brand-blue font-bold text-xs uppercase mb-2">Mensaje del Comité de Ética:</h3>
                            <p class="text-slate-700 text-sm italic leading-relaxed">
                                "<?php echo htmlspecialchars($denuncia['comentario_publico']); ?>"
                            </p>
                        </div>
                    <?php endif; ?>

                    <div class="relative space-y-12">
                        <div class="absolute left-4 top-2 bottom-2 w-0.5 bg-neutral-100"></div>

                        <div class="relative flex items-start gap-6">
                            <div class="z-10 w-8 h-8 rounded-full <?php echo ($fase_actual >= 1) ? 'bg-green-500' : 'bg-neutral-200'; ?> flex items-center justify-center text-white shrink-0">
                                <i class="fas fa-check text-xs"></i>
                            </div>
                            <div>
                                <h4 class="font-bold <?php echo ($fase_actual == 1) ? 'text-brand-blue' : 'text-neutral-900'; ?>">Denuncia Recibida</h4>
                                <p class="text-xs text-neutral-500 mt-1">Su reporte ha sido ingresado al sistema.</p>
                            </div>
                        </div>

                        <div class="relative flex items-start gap-6 <?php echo ($fase_actual < 2) ? 'opacity-40' : ''; ?>">
                            <div class="z-10 w-8 h-8 rounded-full <?php echo ($fase_actual > 2) ? 'bg-green-500' : (($fase_actual == 2) ? 'bg-brand-blue ring-4 ring-blue-50' : 'bg-neutral-200'); ?> flex items-center justify-center text-white shrink-0">
                                <i class="fas <?php echo ($fase_actual > 2) ? 'fa-check' : 'fa-search'; ?> text-xs"></i>
                            </div>
                            <div>
                                <h4 class="font-bold <?php echo ($fase_actual == 2) ? 'text-brand-blue' : 'text-neutral-900'; ?>">En Revisión</h4>
                                <p class="text-xs text-neutral-500 mt-1">El comité está validando la información recibida.</p>
                            </div>
                        </div>

                        <div class="relative flex items-start gap-6 <?php echo ($fase_actual < 3) ? 'opacity-40' : ''; ?>">
                            <div class="z-10 w-8 h-8 rounded-full <?php echo ($fase_actual > 3) ? 'bg-green-500' : (($fase_actual == 3) ? 'bg-brand-blue ring-4 ring-blue-50' : 'bg-neutral-200'); ?> flex items-center justify-center text-white shrink-0">
                                <i class="fas <?php echo ($fase_actual > 3) ? 'fa-check' : 'fa-gavel'; ?> text-xs"></i>
                            </div>
                            <div>
                                <h4 class="font-bold <?php echo ($fase_actual == 3) ? 'text-brand-blue' : 'text-neutral-900'; ?>">Investigación</h4>
                                <p class="text-xs text-neutral-500 mt-1">Se están realizando las gestiones e indagaciones correspondientes.</p>
                            </div>
                        </div>

                        <div class="relative flex items-start gap-6 <?php echo ($fase_actual < 4) ? 'opacity-40' : ''; ?>">
                            <div class="z-10 w-8 h-8 rounded-full <?php echo ($fase_actual == 4) ? ($denuncia['estado'] == 'Desestimado' ? 'bg-gray-500' : 'bg-green-500 ring-4 ring-green-50') : 'bg-neutral-200'; ?> flex items-center justify-center text-white shrink-0">
                                <i class="fas fa-flag-checkered text-xs"></i>
                            </div>
                            <div>
                                <h4 class="font-bold <?php echo ($fase_actual == 4) ? 'text-neutral-900' : 'text-neutral-900'; ?>">Resolución Final</h4>
                                <p class="text-xs text-neutral-500 mt-1">El caso ha concluido su proceso en el canal ético.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="pt-4">
                <a href="../index.php" class="flex items-center justify-center w-full bg-brand-blue text-white py-4 rounded-xl font-bold hover:opacity-90 transition-all uppercase tracking-widest text-sm shadow-lg">
                    <i class="fas fa-home mr-2"></i> Finalizar y Volver al Inicio
                </a>
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
</body>

</html>