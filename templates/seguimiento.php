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