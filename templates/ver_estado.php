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
function determinarFase($estado_db) {
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
        :root { --brand-blue: #007A99; --brand-yellow: #FEC221; }
        .bg-brand-blue { background-color: var(--brand-blue); }
        .text-brand-blue { color: var(--brand-blue); }
    </style>
</head>
<body class="bg-neutral-100 min-h-screen flex flex-col">

    <header class="bg-white shadow-sm sticky top-0 z-50">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center h-16">
          <div class="flex items-center space-x-2">
            <a href="seguimiento.php" class="text-neutral-500 hover:text-brand-blue transition mr-4"><i class="fas fa-arrow-left"></i></a>
            <span class="font-bold text-neutral-900">Estado de la Denuncia</span>
          </div>
          <div class="text-xs font-mono text-neutral-400 bg-neutral-50 px-3 py-1 rounded-full border border-neutral-200">
            REF: <?php echo htmlspecialchars($codigo); ?>
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

    <footer class="p-6 text-center text-[10px] text-neutral-400 uppercase tracking-widest font-medium">
        Fundación para la Sostenibilidad • Canal Ético
    </footer>
</body>
</html>