<?php
session_start();
require_once __DIR__ . '/../includes/db_connect.php';

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'] ?? '';
    $password = $_POST['password'] ?? '';

    $stmt = $conexion->prepare("SELECT id, nombre_completo, password_hash FROM usuarios_admin WHERE usuario = ?");
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($user = $resultado->fetch_assoc()) {
        if (password_verify($password, $user['password_hash'])) {
            // ÉXITO: Guardar datos en sesión
            $_SESSION['admin_id'] = $user['id'];
            $_SESSION['admin_nombre'] = $user['nombre_completo'];

            // Actualizar último acceso
            $conexion->query("UPDATE usuarios_admin SET ultimo_acceso = NOW() WHERE id = " . $user['id']);

            header("Location: dashboard.php");
            exit();
        } else {
            $error = "Contraseña incorrecta.";
        }
    } else {
        $error = "El usuario no existe.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Acceso Administrativo - FUNDEMAS</title>
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

<body class="bg-slate-900 min-h-screen flex items-center justify-center p-6">

    <div class="max-w-md w-full bg-white rounded-2xl shadow-2xl overflow-hidden">
        <div class="bg-brand-blue p-8 text-center">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-white/10 rounded-full mb-4 text-white">
                <i class="fas fa-user-shield text-3xl"></i>
            </div>
            <h1 class="text-white text-xl font-bold uppercase tracking-tight">Panel de Control</h1>
            <p class="text-blue-100 text-sm opacity-80">Canal de Denuncias Éticas</p>
        </div>

        <div class="p-8">
            <?php if ($error): ?>
                <div class="bg-red-50 border-l-4 border-red-500 p-3 mb-6 text-red-700 text-sm italic">
                    <i class="fas fa-times-circle mr-2"></i> <?php echo $error; ?>
                </div>
            <?php endif; ?>

            <form action="login.php" method="POST" class="space-y-6">
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Usuario</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                            <i class="fas fa-user"></i>
                        </span>
                        <input type="text" name="usuario" required
                            class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition"
                            placeholder="Ej: admin_etica">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Contraseña</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                            <i class="fas fa-lock"></i>
                        </span>
                        <input type="password" name="password" required
                            class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition"
                            placeholder="••••••••">
                    </div>
                </div>

                <button type="submit"
                    class="w-full bg-brand-blue text-white font-bold py-4 rounded-xl shadow-lg hover:opacity-90 transition transform hover:-translate-y-1 uppercase tracking-widest text-sm">
                    Ingresar al Panel <i class="fas fa-sign-in-alt ml-2"></i>
                </button>
            </form>
        </div>

        <div class="p-4 bg-gray-50 border-t border-gray-100 text-center">
            <a href="../index.php" class="text-xs text-gray-400 hover:text-gray-600 transition">
                <i class="fas fa-arrow-left mr-1"></i> Volver al sitio público
            </a>
        </div>
    </div>

</body>

</html>