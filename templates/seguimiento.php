<?php
session_start();
require_once __DIR__ . '/../includes/db_connect.php';
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seguimiento de Casos - Canal de Ética</title>
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

        .border-brand-blue {
            border-color: var(--brand-blue);
        }
    </style>
</head>

<body class="bg-neutral-100 antialiased min-h-screen flex flex-col">

    <header class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16 md:h-20">
                <div class="flex items-center space-x-2">
                    <a href="../index.php" class="text-neutral-500 hover:text-brand-blue transition mr-4">
                        <i class="fas fa-arrow-left"></i> <span class="hidden sm:inline">Volver al inicio</span>
                    </a>
                    <div class="w-8 h-8 bg-brand-blue rounded-lg flex items-center justify-center">
                        <span class="text-white font-bold">🛡️</span>
                    </div>
                    <span class="font-semibold text-neutral-900">Seguimiento de Casos</span>
                </div>
            </div>
        </div>
    </header>

    <main class="flex-grow flex items-center justify-center p-6">
        <div class="max-w-2xl w-full space-y-6">

            <div class="bg-white shadow-xl rounded-2xl overflow-hidden border border-neutral-200 p-8">
                <div class="flex items-center gap-3 mb-6">
                    <div class="bg-blue-50 p-3 rounded-full">
                        <i class="fas fa-search text-brand-blue text-xl"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-neutral-900 tracking-tight">Consulta el estado de tu denuncia</h2>
                </div>

                <p class="text-neutral-600 mb-8">
                    Ingresa el número de caso que recibiste al realizar tu reporte para conocer los avances de la investigación.
                </p>

                <form action="../includes/procesar_seguimiento.php" method="POST" class="space-y-4">
                    <div class="bg-neutral-50 border border-neutral-200 rounded-xl p-6">
                        <label for="codigo_caso" class="block text-xs font-bold text-neutral-500 uppercase tracking-widest mb-3">
                            Número de Caso
                        </label>
                        <input type="text" id="codigo_caso" name="codigo_caso" required
                            placeholder="EJ: DEN-4F7A-2B9C"
                            class="w-full bg-white border-2 border-neutral-200 rounded-lg px-4 py-4 text-center font-mono text-xl font-bold text-brand-blue focus:border-brand-blue focus:ring-0 transition uppercase">

                        <button type="submit" class="w-full mt-6 bg-brand-yellow hover:bg-yellow-500 text-neutral-900 font-bold py-4 rounded-xl shadow-lg transition-all transform hover:-translate-y-1 uppercase tracking-wider">
                            Consultar Estado <i class="fas fa-arrow-right ml-2"></i>
                        </button>
                    </div>
                </form>
            </div>

            <div class="bg-white shadow-lg rounded-2xl border border-neutral-200 p-8 border-l-4 border-l-brand-yellow">
                <div class="flex items-center gap-3 mb-4">
                    <i class="fas fa-thumbtack text-brand-yellow"></i>
                    <h3 class="font-bold text-neutral-900">¿Perdiste tu número de caso?</h3>
                </div>

                <p class="text-sm text-neutral-600 mb-6">
                    Si realizaste una denuncia <strong>identificada</strong>, ingresa tu correo electrónico para reenviarte tu código de seguimiento.
                </p>

                <form action="recuperar_codigo.php" method="POST" class="flex flex-col sm:flex-row gap-3">
                    <input type="email" name="email_recuperacion" required
                        placeholder="tu-correo@ejemplo.com"
                        class="flex-grow bg-neutral-50 border border-neutral-200 rounded-lg px-4 py-3 text-sm focus:border-brand-blue outline-none">
                    <button type="submit" class="bg-neutral-900 text-white px-6 py-3 rounded-lg font-bold text-sm hover:bg-black transition uppercase tracking-widest">
                        Enviar
                    </button>
                </form>
            </div>

        </div>
    </main>

    <footer class="bg-neutral-900 text-neutral-400 py-8 border-t border-neutral-800">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <p class="text-sm">© 2026 FUNDEMAS. Todos los derechos reservados.</p>
            <p class="text-xs mt-2 italic font-mono opacity-50">CANAL_DE_DENUNCIAS // v1.0</p>
        </div>
    </footer>

</body>

</html>