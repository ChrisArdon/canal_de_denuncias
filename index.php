<!doctype html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Canal de Denuncias Éticas</title>
  <link rel="icon" href="assets/cropped-Favicon_Fundemas-32x32-1.png" type="image/x-icon" />
  <link rel="shortcut icon" href="assets/cropped-Favicon_Fundemas-32x32-1.png" type="image/x-icon" />
  <!-- Tailwind CSS v4 (CDN para desarrollo rápido) -->
  <script src="https://cdn.tailwindcss.com"></script>

  <script>
    //Function to make vibrate de button
    function vibrarBoton() {
      const button = document.querySelector('a[href="/formulario"]');

      if (button) {
        //Agregar clase de vibracion
        button.classList.add("vibrating");

        //quitar la clase despues de 500ms
        setTimeout(() => {
          button.classList.remove("vibrating");
        }, 500);
      }
    }
    //Ejecutar cada 30 segundos
    setInterval(vibrarBoton, 10000); // 30000ms = 30 segundos
    // También ejecutar al cargar la página
    setTimeout(vibrarBoton, 5000); // Primera vibración a los 5 segundos
  </script>
  <!-- Font Awesome para iconos -->
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
  <!-- Configuración personalizada (opcional) -->
  <style>
    @import url("https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap");

    body {
      font-family: "Inter", sans-serif;
    }

    .vibrating {
      animation: subtleVibration 0.5s ease-in-out;
    }

    /* Subtle vibration */
    @keyframes subtleVibration {

      0%,
      100% {
        transform: translateX(0);
      }

      10% {
        transform: translateX(-2px);
      }

      20% {
        transform: translateX(2px);
      }

      30% {
        transform: translateX(-2px);
      }

      40% {
        transform: translateX(2px);
      }

      50% {
        transform: translateX(-1px);
      }

      60% {
        transform: translateX(1px);
      }

      70% {
        transform: translateX(0);
      }

    }

    a[href="/formulario"] {
      transition: all 0.3s ease;
    }

    /*Colores FUNDEMAS*/
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

    /* Nuevo degradado institucional con profundidad */
    .bg-gradient-fundemas {
      background: radial-gradient(circle at top right, #008eb3, #007A99, #004d61);
      position: relative;
    }

    /* Opcional: Agregar un patrón sutil de puntos para textura */
    .bg-pattern {
      background-image: radial-gradient(rgba(255, 255, 255, 0.1) 1px, transparent 1px);
      background-size: 30px 30px;
    }
  </style>
</head>

<body class="bg-neutral-100 antialiased">
  <!-- CONTENEDOR PRINCIPAL -->
  <div class="min-h-screen flex flex-col">
    <!-- ========== NAVBAR ========== -->
    <header class="bg-white shadow-sm sticky top-0 z-50">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16 md:h-20">
          <div class="flex items-center">
            <a href="index.php" class="flex items-center">
              <img
                src="assets/logo_fundemas.png"
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

    <!-- ========== HERO SECTION ========== -->
    <main class="flex-grow">
      <!-- Imagen de fondo -->
      <div class="relative py-12 md:py-24 overflow-hidden bg-gradient-fundemas">
        <div class="absolute inset-0 z-0 bg-pattern opacity-30"></div>

        <div class="absolute -top-24 -left-24 w-96 h-96 bg-brand-yellow opacity-10 rounded-full blur-3xl"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
          <div class="grid md:grid-cols-2 gap-12 items-center">
            <div class="space-y-6">
              <div class="inline-flex items-center bg-white/10 backdrop-blur-md px-4 py-2 rounded-full border border-white/20">
                <i class="fas fa-shield-alt mr-2 text-brand-yellow"></i>
                <span class="text-sm font-medium text-white">Compromiso con la Integridad</span>
              </div>

              <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold leading-tight text-white">
                Canal de Denuncias<br /><span class="text-brand-yellow">y Ética</span>
              </h1>


              <p class="text-blue-50 text-lg md:xl max-w-lg leading-relaxed">
                Un espacio seguro, anónimo y confiable para reportar conductas contrarias a nuestros valores institucionales.
              </p>

              <!-- Cuadro 1: Integridad -->
              <div class="grid sm:grid-cols-2 gap-4 pt-4">
                <!-- Cuadro 1: Compromiso -->
                <div
                  class="bg-white/10 backdrop-blur-sm p-5 rounded-xl border border-white/20 hover:bg-white/15 transition">
                  <div class="flex items-start gap-3">
                    <div class="bg-primary-500/30 p-2 rounded-lg">
                      <i class="fas fa-handshake text-white text-xl"></i>
                    </div>
                    <div>
                      <h3 class="font-semibold text-white text-base mb-1">
                        Compromiso con la integridad
                      </h3>
                      <p class="text-primary-100 text-xs leading-relaxed">
                        Apreciamos su compromiso con la integridad y la
                        transparencia de nuestra Fundación. La información que
                        proporcionará es crucial para mantener un ambiente
                        ético, seguro y profesional.
                      </p>
                    </div>
                  </div>
                </div>

                <!-- Cuadro 2: Confidencialidad -->
                <div
                  class="bg-white/10 backdrop-blur-sm p-5 rounded-xl border border-white/20 hover:bg-white/15 transition">
                  <div class="flex items-start gap-3">
                    <div class="bg-primary-500/30 p-2 rounded-lg">
                      <i class="fas fa-lock text-white text-xl"></i>
                    </div>
                    <div>
                      <h3 class="font-semibold text-white text-base mb-1">
                        Garantía de Confidencialidad
                      </h3>
                      <p class="text-primary-100 text-xs leading-relaxed">
                        Le aseguramos que todas las denuncias serán tratadas
                        con la máxima confidencialidad. Estamos comprometidos
                        con una política de cero represalias. Su valentía nos
                        ayuda a preservar nuestros estándares más altos.
                      </p>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Botones CTA -->
              <div class="flex flex-col sm:flex-row gap-4 pt-6">
                <a href="templates/frame2_tipo_denuncia.php"
                  class="bg-brand-yellow hover:bg-yellow-400 text-neutral-900 font-bold px-8 py-4 rounded-xl shadow-lg hover:shadow-yellow-500/20 transition transform hover:-translate-y-1 text-center uppercase tracking-wider">
                  <i class="fas fa-pen mr-2"></i>
                  Hacer una denuncia
                </a>
                <a href="templates/seguimiento.php"
                  class="bg-white/10 hover:bg-white/20 backdrop-blur-sm text-white font-bold px-8 py-4 rounded-xl border border-white/30 transition text-center uppercase tracking-wider">
                  <i class="fas fa-search mr-2"></i>
                  Seguimiento
                </a>
              </div>

              <!-- Garantías rápidas -->
              <div class="flex flex-wrap gap-4 pt-6 text-sm">
                <span class="flex items-center"><i class="fas fa-lock mr-2 text-accent-300"></i>
                  Confidencial</span>
                <span class="flex items-center"><i class="fas fa-check-circle mr-2 text-accent-300"></i>
                  Sin represalias</span>
                <span class="flex items-center"><i class="fas fa-clock mr-2 text-accent-300"></i> Respuesta
                  5 días</span>
              </div>
            </div>

            <!-- Columna derecha: imagen ilustrativa (opcional) -->
            <div class="hidden md:flex justify-center">
              <div class="relative">
                <div class="w-72 h-72 bg-white/5 rounded-full flex items-center justify-center border border-white/10 animate-pulse">
                  <i class="fas fa-balance-scale text-9xl text-white/20"></i>
                </div>
                <div class="absolute inset-0 flex items-center justify-center">
                  <div class="bg-white p-8 rounded-3xl shadow-2xl transform rotate-3 hover:rotate-0 transition-transform duration-500">
                    <i class="fas fa-user-shield text-7xl text-brand-blue"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- ========== SECCIÓN "CÓMO FUNCIONA" ========== -->
      <div class="py-16 md:py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-neutral-900">
              ¿Cómo funciona?
            </h2>
            <p class="text-neutral-600 mt-4 max-w-2xl mx-auto">
              Un proceso simple, seguro y transparente para garantizar la
              integridad de nuestra fundación.
            </p>
          </div>

          <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Paso 1 -->
            <div
              class="bg-neutral-50 p-6 rounded-xl border border-neutral-200 hover:shadow-lg transition">
              <div
                class="w-12 h-12 bg-primary-100 rounded-full flex items-center justify-center text-primary-700 font-bold text-xl mb-4">
                1
              </div>
              <i class="fas fa-flag text-3xl text-primary-600 mb-3"></i>
              <h3 class="font-semibold text-lg mb-2">Reporta</h3>
              <p class="text-neutral-600 text-sm">
                Anónimo o identificado, tú eliges el nivel de privacidad.
              </p>
            </div>
            <!-- Paso 2 -->
            <div
              class="bg-neutral-50 p-6 rounded-xl border border-neutral-200 hover:shadow-lg transition">
              <div
                class="w-12 h-12 bg-primary-100 rounded-full flex items-center justify-center text-primary-700 font-bold text-xl mb-4">
                2
              </div>
              <i class="fas fa-search text-3xl text-primary-600 mb-3"></i>
              <h3 class="font-semibold text-lg mb-2">Investigación</h3>
              <p class="text-neutral-600 text-sm">
                Comité de Ética analiza el caso de forma imparcial.
              </p>
            </div>
            <!-- Paso 3 -->
            <div
              class="bg-neutral-50 p-6 rounded-xl border border-neutral-200 hover:shadow-lg transition">
              <div
                class="w-12 h-12 bg-primary-100 rounded-full flex items-center justify-center text-primary-700 font-bold text-xl mb-4">
                3
              </div>
              <i class="fas fa-gavel text-3xl text-primary-600 mb-3"></i>
              <h3 class="font-semibold text-lg mb-2">Resolución</h3>
              <p class="text-neutral-600 text-sm">
                Se determinan acciones correctivas y medidas.
              </p>
            </div>
            <!-- Paso 4 -->
            <div
              class="bg-neutral-50 p-6 rounded-xl border border-neutral-200 hover:shadow-lg transition">
              <div
                class="w-12 h-12 bg-primary-100 rounded-full flex items-center justify-center text-primary-700 font-bold text-xl mb-4">
                4
              </div>
              <i
                class="fas fa-check-circle text-3xl text-primary-600 mb-3"></i>
              <h3 class="font-semibold text-lg mb-2">Cierre y Seguimiento</h3>
              <p class="text-neutral-600 text-sm">
                Se informa resultado y se previenen recurrencias.
              </p>
            </div>
          </div>
        </div>
      </div>

      <!-- ========== COMPROMISOS ========== -->
      <div class="py-16 bg-primary-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div class="grid md:grid-cols-2 gap-8 items-center">
            <div>
              <h2 class="text-3xl font-bold text-neutral-900 mb-6">
                Nuestros Compromisos
              </h2>
              <div class="space-y-4">
                <div class="flex items-start">
                  <div class="bg-primary-100 p-2 rounded-full mr-4">
                    <i class="fas fa-check text-primary-700"></i>
                  </div>
                  <div>
                    <h3 class="font-semibold text-lg">
                      Confidencialidad absoluta
                    </h3>
                    <p class="text-neutral-600">
                      Tus datos están protegidos y solo los maneja el Comité
                      de Ética.
                    </p>
                  </div>
                </div>
                <div class="flex items-start">
                  <div class="bg-primary-100 p-2 rounded-full mr-4">
                    <i class="fas fa-check text-primary-700"></i>
                  </div>
                  <div>
                    <h3 class="font-semibold text-lg">Cero represalias</h3>
                    <p class="text-neutral-600">
                      Garantizamos protección total al denunciante de buena
                      fe.
                    </p>
                  </div>
                </div>
                <div class="flex items-start">
                  <div class="bg-primary-100 p-2 rounded-full mr-4">
                    <i class="fas fa-check text-primary-700"></i>
                  </div>
                  <div>
                    <h3 class="font-semibold text-lg">
                      Investigación imparcial
                    </h3>
                    <p class="text-neutral-600">
                      Cada caso se analiza sin sesgos ni conflictos de
                      interés.
                    </p>
                  </div>
                </div>
                <div class="flex items-start">
                  <div class="bg-primary-100 p-2 rounded-full mr-4">
                    <i class="fas fa-check text-primary-700"></i>
                  </div>
                  <div>
                    <h3 class="font-semibold text-lg">Respuesta oportuna</h3>
                    <p class="text-neutral-600">
                      Recibirás actualizaciones en un máximo de 5 días
                      hábiles.
                    </p>
                  </div>
                </div>
              </div>
            </div>
            <div class="bg-white p-8 rounded-2xl shadow-lg">
              <i class="fas fa-shield-alt text-6xl text-primary-300 mb-4"></i>
              <h3 class="text-xl font-semibold mb-2">
                Cifrado de extremo a extremo
              </h3>
              <p class="text-neutral-600 mb-4">
                Toda la información se transmite y almacena con los más altos
                estándares de seguridad.
              </p>
              <div
                class="bg-neutral-100 p-3 rounded-lg text-sm font-mono text-neutral-700">
                AES-256 · TLS 1.3 · HTTPS
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>

    <!-- ========== FOOTER ========== -->
    <footer class="bg-neutral-900 text-neutral-300 py-12">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
          <div class="col-span-1 md:col-span-2">
            <div class="flex items-center mb-6">
              <img
                src="assets/logo_fundemas.png"
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
  </div>

  <!-- Script para menú móvil (básico) -->
  <script>
    // Aquí se puede agregar funcionalidad para el menú hamburguesa
  </script>
</body>

</html>
<!-- Chris Ardon était ici 20260515 -->