<?php
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/db_connect.php';

// Protegemos la página: si no hay sesión, redirige al login
revisarAutenticacion();

// Consultar todas las denuncias
$query = "SELECT id, codigo_seguimiento, fecha_creacion, tipo_incidente, estado, frecuencia FROM denuncias ORDER BY fecha_creacion DESC";
$resultado = $conexion->query($query);

// Función para asignar colores a los estados
function obtenerColorEstado($estado)
{
    switch ($estado) {
        case 'Pendiente':
            return 'bg-red-100 text-red-700 border-red-200';
        case 'En Revision':
            return 'bg-blue-100 text-blue-700 border-blue-200';
        case 'Investigacion':
            return 'bg-yellow-100 text-yellow-700 border-yellow-200';
        case 'Resuelto':
            return 'bg-green-100 text-green-700 border-green-200';
        default:
            return 'bg-gray-100 text-gray-700 border-gray-200';
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Administrativo - FUNDEMAS</title>
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

<body class="bg-neutral-50 min-h-screen flex flex-col md:flex-row">

    <aside class="w-full md:w-64 bg-slate-900 text-white flex flex-col shrink-0">
        <div class="p-6 bg-brand-blue flex items-center gap-3">
            <span class="text-2xl">🛡️</span>
            <span class="font-bold tracking-tight uppercase text-sm">Canal Ético</span>
        </div>

        <nav class="flex-grow p-4 space-y-2">
            <a href="dashboard.php" class="flex items-center gap-3 p-3 bg-white/10 rounded-lg text-white font-medium">
                <i class="fas fa-home"></i> Inicio
            </a>
            <a href="#" class="flex items-center gap-3 p-3 text-slate-400 hover:bg-white/5 hover:text-white rounded-lg transition">
                <i class="fas fa-list-check"></i> Gestionar Casos
            </a>
            <a href="#" class="flex items-center gap-3 p-3 text-slate-400 hover:bg-white/5 hover:text-white rounded-lg transition">
                <i class="fas fa-chart-pie"></i> Reportes
            </a>
        </nav>

        <div class="p-4 border-t border-slate-800">
            <div class="flex items-center gap-3 mb-4 px-2">
                <div class="w-8 h-8 bg-brand-blue rounded-full flex items-center justify-center text-xs">
                    <?php echo substr($_SESSION['admin_nombre'], 0, 1); ?>
                </div>
                <div class="overflow-hidden">
                    <p class="text-xs font-bold truncate"><?php echo htmlspecialchars($_SESSION['admin_nombre']); ?></p>
                    <p class="text-[10px] text-slate-500 uppercase">Administrador</p>
                </div>
            </div>
            <a href="logout.php" class="flex items-center gap-3 p-3 text-red-400 hover:bg-red-500/10 rounded-lg transition text-sm">
                <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
            </a>
        </div>
    </aside>

    <main class="flex-grow p-8 overflow-y-auto">
        <header class="flex justify-between items-end mb-8">
            <div>
                <h1 class="text-3xl font-bold text-slate-900">Gestión de Denuncias</h1>
                <p class="text-slate-500">Listado general de casos recibidos a través del canal.</p>
            </div>
            <div class="bg-white px-4 py-2 rounded-lg shadow-sm border border-neutral-200 flex gap-4">
                <div class="text-center px-4">
                    <p class="text-[10px] text-neutral-400 font-bold uppercase">Total</p>
                    <p class="font-bold text-slate-800"><?php echo $resultado->num_rows; ?></p>
                </div>
            </div>
        </header>

        <div class="bg-white rounded-xl shadow-sm border border-neutral-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-neutral-50 border-b border-neutral-200">
                        <tr>
                            <th class="px-6 py-4 text-[10px] uppercase font-bold text-neutral-500 tracking-wider">Código</th>
                            <th class="px-6 py-4 text-[10px] uppercase font-bold text-neutral-500 tracking-wider">Fecha</th>
                            <th class="px-6 py-4 text-[10px] uppercase font-bold text-neutral-500 tracking-wider">Categoría</th>
                            <th class="px-6 py-4 text-[10px] uppercase font-bold text-neutral-500 tracking-wider">Estado</th>
                            <th class="px-6 py-4 text-[10px] uppercase font-bold text-neutral-500 tracking-wider text-right">Acción</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-neutral-100">
                        <?php while ($fila = $resultado->fetch_assoc()): ?>
                            <tr class="hover:bg-neutral-50 transition">
                                <td class="px-6 py-4">
                                    <span class="font-mono font-bold text-brand-blue text-sm">
                                        <?php echo htmlspecialchars($fila['codigo_seguimiento']); ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm text-slate-600">
                                    <?php echo date("d/m/Y", strtotime($fila['fecha_creacion'])); ?>
                                </td>
                                <td class="px-6 py-4 text-sm text-slate-800 font-medium">
                                    <?php echo htmlspecialchars($fila['tipo_incidente']); ?>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="px-3 py-1 rounded-full text-[10px] font-bold border <?php echo obtenerColorEstado($fila['estado']); ?>">
                                        <?php echo strtoupper($fila['estado']); ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <a href="detalle_caso.php?id=<?php echo $fila['id']; ?>"
                                        class="inline-flex items-center justify-center w-10 h-10 bg-slate-100 text-slate-600 rounded-lg hover:bg-brand-blue hover:text-white transition">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>

                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>

</body>

</html>