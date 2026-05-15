<?php
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/db_connect.php';

revisarAutenticacion();

$id = $_GET['id'] ?? 0;

// Lógica para actualizar el caso
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['actualizar_caso'])) {
    $nuevo_estado = $_POST['estado'];
    $obs_internas = $_POST['observaciones_internas'];
    $com_publico = $_POST['comentario_publico'];

    $stmt_update = $conexion->prepare("UPDATE denuncias SET estado = ?, observaciones_internas = ?, comentario_publico = ? WHERE id = ?");
    $stmt_update->bind_param("sssi", $nuevo_estado, $obs_internas, $com_publico, $id);

    if ($stmt_update->execute()) {
        $mensaje_exito = "Caso actualizado correctamente.";
    }
}

// Consultar los datos de la denuncia
$stmt = $conexion->prepare("SELECT * FROM denuncias WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$denuncia = $stmt->get_result()->fetch_assoc();

if (!$denuncia) {
    header("Location: dashboard.php");
    exit();
}

function obtenerBadgeEstado($estado)
{
    switch ($estado) {
        case 'Pendiente':
            return 'bg-red-100 text-red-700';
        case 'En Revision':
            return 'bg-blue-100 text-blue-700';
        case 'Investigacion':
            return 'bg-yellow-100 text-yellow-700';
        case 'Resuelto':
            return 'bg-green-100 text-green-700';
        default:
            return 'bg-gray-100 text-gray-700';
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Detalle del Caso - FUNDEMAS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --brand-blue: #007A99;
        }

        .bg-brand-blue {
            background-color: var(--brand-blue);
        }

        .text-brand-blue {
            color: var(--brand-blue);
        }
    </style>
</head>

<body class="bg-neutral-50 min-h-screen flex flex-col md:flex-row">

    <aside class="w-full md:w-64 bg-slate-900 text-white flex flex-col shrink-0">
        <div class="p-6 bg-brand-blue flex items-center gap-3">
            <span class="text-2xl">🛡️</span>
            <span class="font-bold tracking-tight uppercase text-sm">Gestión Ética</span>
        </div>
        <nav class="flex-grow p-4 space-y-2">
            <a href="dashboard.php" class="flex items-center gap-3 p-3 text-slate-400 hover:bg-white/10 hover:text-white rounded-lg transition">
                <i class="fas fa-arrow-left"></i> Volver al Listado
            </a>
        </nav>
    </aside>

    <main class="flex-grow p-8 overflow-y-auto">
        <div class="max-w-5xl mx-auto">

            <?php if (isset($mensaje_exito)): ?>
                <div class="bg-green-50 border-l-4 border-green-500 p-4 mb-6 text-green-700 flex items-center gap-3">
                    <i class="fas fa-check-circle"></i> <?php echo $mensaje_exito; ?>
                </div>
            <?php endif; ?>

            <div class="flex flex-col md:flex-row justify-between items-start gap-4 mb-8">
                <div>
                    <div class="flex items-center gap-3 mb-2">
                        <span class="font-mono text-2xl font-bold text-brand-blue"><?php echo htmlspecialchars($denuncia['codigo_seguimiento']); ?></span>
                        <span class="px-3 py-1 rounded-full text-xs font-bold <?php echo obtenerBadgeEstado($denuncia['estado']); ?>">
                            <?php echo strtoupper($denuncia['estado']); ?>
                        </span>
                    </div>
                    <p class="text-slate-500">Recibido el: <?php echo date("d/m/Y H:i", strtotime($denuncia['fecha_creacion'])); ?></p>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                <div class="lg:col-span-2 space-y-6">
                    <div class="bg-white rounded-xl shadow-sm border border-neutral-200 p-6">
                        <h3 class="text-lg font-bold text-slate-800 mb-4 border-b pb-2">Datos del Reporte</h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm mb-6">
                            <div>
                                <p class="text-neutral-400 font-bold uppercase text-[10px]">Tipo de Incidente</p>
                                <p class="font-medium"><?php echo htmlspecialchars($denuncia['tipo_incidente']); ?></p>
                            </div>
                            <div>
                                <p class="text-neutral-400 font-bold uppercase text-[10px]">Relación con Empresa</p>
                                <p class="font-medium"><?php echo htmlspecialchars($denuncia['denunciante_relacion'] ?? 'No especificado'); ?></p>
                            </div>
                            <div>
                                <p class="text-neutral-400 font-bold uppercase text-[10px]">Frecuencia</p>
                                <p class="font-medium">
                                    <?php
                                    $frec_map = [
                                        'unica' => '<span class="text-blue-600">Aislado (Una vez)</span>',
                                        'recurrente' => '<span class="text-orange-600">Múltiples veces</span>',
                                        'patron' => '<span class="text-red-600 font-bold">Patrón continuo</span>'
                                    ];
                                    echo $frec_map[$denuncia['frecuencia']] ?? 'No especificada';
                                    ?>
                                </p>
                            </div>
                        </div>

                        <div class="mb-6">
                            <p class="text-neutral-400 font-bold uppercase text-[10px] mb-2">Descripción de los Hechos</p>
                            <div class="bg-neutral-50 p-4 rounded-lg text-slate-700 leading-relaxed whitespace-pre-wrap border border-neutral-100">
                                <?php echo htmlspecialchars($denuncia['descripcion_hechos']); ?>
                            </div>
                        </div>

                        <?php if ($denuncia['tipo_denuncia'] === 'identificado'): ?>
                            <div class="bg-blue-50 p-4 rounded-lg border border-blue-100">
                                <h4 class="text-blue-800 font-bold text-xs uppercase mb-2">
                                    <i class="fas fa-user-tag mr-1"></i> Datos del Denunciante
                                </h4>
                                <p class="text-sm"><strong>Nombre:</strong> <?php echo htmlspecialchars($denuncia['denunciante_nombre']); ?></p>
                                <p class="text-sm"><strong>Email:</strong> <?php echo htmlspecialchars($denuncia['denunciante_email']); ?></p>
                                <p class="text-sm"><strong>Teléfono:</strong> <?php echo htmlspecialchars($denuncia['denunciante_telefono']); ?></p>
                            </div>
                        <?php else: ?>
                            <div class="bg-neutral-100 p-4 rounded-lg border border-neutral-200 text-neutral-500 text-sm italic">
                                <i class="fas fa-user-secret mr-1"></i> Esta denuncia fue presentada de forma anónima.
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="space-y-6">
                    <form action="detalle_caso.php?id=<?php echo $id; ?>" method="POST" class="bg-white rounded-xl shadow-sm border border-neutral-200 p-6">
                        <h3 class="text-lg font-bold text-slate-800 mb-4">Gestión del Caso</h3>

                        <div class="mb-4">
                            <label class="block text-[10px] font-bold text-neutral-500 uppercase mb-2">Cambiar Estado</label>
                            <select name="estado" class="w-full border border-neutral-200 rounded-lg p-3 text-sm outline-none focus:border-brand-blue">
                                <option value="Pendiente" <?php echo $denuncia['estado'] == 'Pendiente' ? 'selected' : ''; ?>>Pendiente</option>
                                <option value="En Revision" <?php echo $denuncia['estado'] == 'En Revision' ? 'selected' : ''; ?>>En Revisión</option>
                                <option value="Investigacion" <?php echo $denuncia['estado'] == 'Investigacion' ? 'selected' : ''; ?>>Investigación</option>
                                <option value="Resuelto" <?php echo $denuncia['estado'] == 'Resuelto' ? 'selected' : ''; ?>>Resuelto</option>
                                <option value="Desestimado" <?php echo $denuncia['estado'] == 'Desestimado' ? 'selected' : ''; ?>>Desestimado</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="block text-[10px] font-bold text-neutral-500 uppercase mb-2">Observaciones Internas (Privado)</label>
                            <textarea name="observaciones_internas" rows="4" class="w-full border border-neutral-200 rounded-lg p-3 text-sm outline-none focus:border-brand-blue" placeholder="Notas solo para el comité..."><?php echo htmlspecialchars($denuncia['observaciones_internas'] ?? ''); ?></textarea>
                        </div>

                        <div class="mb-6">
                            <label class="block text-[10px] font-bold text-blue-600 uppercase mb-2"><i class="fas fa-eye mr-1"></i> Comentario para el Denunciante</label>
                            <textarea name="comentario_publico" rows="4" class="w-full border border-blue-200 bg-blue-50 rounded-lg p-3 text-sm outline-none focus:border-brand-blue" placeholder="Lo que el usuario verá en su seguimiento..."><?php echo htmlspecialchars($denuncia['comentario_publico'] ?? ''); ?></textarea>
                            <p class="text-[9px] text-neutral-400 mt-2 italic">Este texto será visible para quien tenga el código de seguimiento.</p>
                        </div>

                        <button type="submit" name="actualizar_caso" class="w-full bg-brand-blue text-white font-bold py-3 rounded-lg shadow-md hover:opacity-90 transition uppercase text-xs tracking-widest">
                            Guardar Cambios
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </main>
</body>

</html>