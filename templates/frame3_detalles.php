<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Canal de Denuncias Éticas - Paso 2</title>
    <!-- Tailwind CSS v4 -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

        body {
            font-family: 'Inter', sans-serif;
        }

        :root {
            --brand-blue: #007A99;
            --brand-yellow: #FEC221;
        }

        /* Clases de utilidad personalizadas */
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

<body class="bg-neutral-100 antialiased">
    <div class="min-h-screen flex flex-col">

        <!-- ========== HEADER (IDÉNTICO) ========== -->
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

        <!-- ========== CONTENIDO PRINCIPAL (FRAME 3) ========== -->
        <main class="flex-grow py-12 md:py-16">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

                <!-- Barra de progreso -->
                <div class="mb-8">
                    <div class="flex justify-between items-center mb-2">
                        <span class="text-sm font-medium text-primary-700">Paso 2 de 3</span>
                        <span class="text-sm text-neutral-500">Detalles del Incidente</span>
                    </div>
                    <div class="w-full bg-neutral-200 rounded-full h-2.5">
                        <div class="bg-primary-600 h-2.5 rounded-full" style="width: 66%"></div>
                    </div>
                </div>

                <!-- Título -->
                <div class="mb-8">
                    <h1 class="text-3xl md:text-4xl font-bold text-neutral-900 mb-4">Detalles del Incidente</h1>
                    <p class="text-neutral-600">Por favor, proporcione la mayor cantidad de información posible para facilitar la investigación.</p>
                </div>

                <!-- FORMULARIO PASO 2 -->
                <form action="../includes/guardar_paso2.php" method="POST" enctype="multipart/form-data" class="bg-white rounded-2xl shadow-xl p-6 md:p-8">

                    <!-- 1. Tipo de Incidente (obligatorio) -->
                    <div class="mb-8">
                        <label class="block text-sm font-medium text-neutral-700 mb-1">
                            Tipo de Incidente <span class="text-red-500">*</span>
                        </label>
                        <select name="tipo_incidente" required
                            class="w-full px-4 py-3 border border-neutral-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition">
                            <option value="">Seleccione una categoría</option>
                            <option value="acoso_laboral">Acoso laboral</option>
                            <option value="acoso_sexual">Acoso sexual</option>
                            <option value="discriminacion">Discriminación</option>
                            <option value="fraude">Fraude / Malversación</option>
                            <option value="conflicto_intereses">Conflicto de intereses</option>
                            <option value="violacion_seguridad">Violación de seguridad / privacidad</option>
                            <option value="incumplimiento_politicas">Incumplimiento de políticas internas</option>
                            <option value="violacion_leyes">Violación de leyes o regulaciones</option>
                            <option value="seguridad_salud">Riesgo de seguridad / salud</option>
                            <option value="otros">Otros</option>
                        </select>
                    </div>

                    <!-- 2. Personas involucradas -->
                    <div class="mb-8">
                        <label for="involucrados" class="block text-sm font-medium text-neutral-700 mb-1">
                            Persona(s) involucrada(s) <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="involucrados" name="involucrados" required
                            class="w-full px-4 py-3 border border-neutral-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition"
                            placeholder="Ej. Juan Pérez (Gerente Ventas), Marta Sánchez (Coordinadora)">
                        <p class="text-xs text-neutral-500 mt-1">Puedes incluir nombres, cargos o descripciones que ayuden a identificar a los involucrados.</p>
                    </div>

                    <!-- 3. Departamento del implicado -->
                    <div class="mb-8">
                        <label for="area_implicado" class="block text-sm font-medium text-neutral-700 mb-1">
                            Departamento / Área del implicado <span class="text-neutral-400 font-normal">(opcional)</span>
                        </label>
                        <input type="text" id="area_implicado" name="area_implicado"
                            class="w-full px-4 py-3 border border-neutral-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition"
                            placeholder="Ej. Ventas, Recursos Humanos, Finanzas">
                    </div>

                    <!-- 4. Fila doble: Fecha y hora + Frecuencia -->
                    <div class="grid md:grid-cols-2 gap-6 mb-8">
                        <div>
                            <label for="fecha_incidente" class="block text-sm font-medium text-neutral-700 mb-1">
                                Fecha y hora aproximada <span class="text-red-500">*</span>
                            </label>
                            <input type="datetime-local" id="fecha_incidente" name="fecha_incidente" required
                                class="w-full px-4 py-3 border border-neutral-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition">
                        </div>
                        <div>
                            <label for="frecuencia" class="block text-sm font-medium text-neutral-700 mb-1">
                                Frecuencia <span class="text-red-500">*</span>
                            </label>
                            <select name="frecuencia" required
                                class="w-full px-4 py-3 border border-neutral-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition">
                                <option value="">Seleccione...</option>
                                <option value="unica">Incidente aislado (ocurrió una sola vez)</option>
                                <option value="recurrente">Ha ocurrido múltiples ocasiones</option>
                                <option value="patron">Patrón continuo / sistemático</option>
                            </select>
                        </div>
                    </div>

                    <!-- 5. Ubicación -->
                    <div class="mb-8">
                        <label for="ubicacion" class="block text-sm font-medium text-neutral-700 mb-1">
                            Ubicación física o entorno <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="ubicacion" name="ubicacion" required
                            class="w-full px-4 py-3 border border-neutral-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition"
                            placeholder="Ej. Oficina central piso 3, Evento anual, Correo electrónico, Reunión virtual">
                    </div>

                    <!-- 6. Descripción detallada (textarea grande) -->
                    <div class="mb-8">
                        <label for="descripcion" class="block text-sm font-medium text-neutral-700 mb-1">
                            Descripción detallada de los hechos <span class="text-red-500">*</span>
                        </label>
                        <textarea id="descripcion" name="descripcion" required rows="8"
                            class="w-full px-4 py-3 border border-neutral-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition resize-y"
                            placeholder="Por favor, describa de manera clara y concisa la situación. Incluya:
• ¿Qué sucedió exactamente?
• ¿Cómo sucedió?
• ¿Quiénes fueron testigos?
• ¿Cuándo comenzó?
• ¿Ha reportado esto anteriormente?"></textarea>
                        <div class="flex justify-end mt-1">
                            <span id="charCount" class="text-xs text-neutral-500">0 / 2000 caracteres</span>
                        </div>
                    </div>

                    <!-- 7. Evidencia y respaldo (subida de archivos) -->
                    <div class="mb-8 p-6 bg-neutral-50 rounded-xl border border-neutral-200">
                        <label class="block text-sm font-medium text-neutral-700 mb-3">
                            <i class="fas fa-paperclip mr-2"></i>
                            Evidencia y Respaldo <span class="text-neutral-400 font-normal">(opcional - máximo 5 archivos)</span>
                        </label>

                        <!-- Área de dropzone simple -->
                        <div id="dropzone" class="border-2 border-dashed border-neutral-300 rounded-xl p-8 text-center cursor-pointer hover:border-primary-400 transition bg-white">
                            <i class="fas fa-cloud-upload-alt text-4xl text-neutral-400 mb-3"></i>
                            <p class="text-neutral-600 mb-2">Arrastra tus archivos aquí o haz clic para subirlos</p>
                            <p class="text-xs text-neutral-400">Formatos aceptados: PDF, JPG, PNG, DOC, DOCX (Máx. 5MB por archivo)</p>
                            <input type="file" id="archivos" name="archivos" multiple accept=".pdf,.jpg,.jpeg,.png,.doc,.docx" class="hidden">
                            <button type="button" id="btnSeleccionar" class="mt-4 bg-primary-100 text-primary-700 px-4 py-2 rounded-lg text-sm font-medium hover:bg-primary-200 transition">
                                <i class="fas fa-folder-open mr-1"></i>
                                Seleccionar archivos
                            </button>
                        </div>

                        <!-- Lista de archivos seleccionados -->
                        <div id="listaArchivos" class="mt-4 space-y-2"></div>

                        <input type="hidden" name="archivos_json" id="archivos_json">
                    </div>

                    <!-- 8. Botones de navegación -->
                    <div class="flex flex-col sm:flex-row justify-between gap-4 pt-4 border-t border-neutral-200">
                        <a href="../templates/frame2_tipo_denuncia.php" class="px-8 py-3 border border-neutral-300 text-neutral-700 font-medium rounded-lg hover:bg-neutral-50 transition text-center">
                            <i class="fas fa-arrow-left mr-2"></i>
                            PASO ANTERIOR
                        </a>
                        <button type="submit" class="bg-brand-yellow hover:bg-primary-700 text-white font-semibold px-8 py-3 rounded-lg shadow-lg hover:shadow-xl transition transform hover:-translate-y-1 text-center">
                            CONTINUAR A VERIFICACIÓN
                            <i class="fas fa-arrow-right ml-2"></i>
                        </button>
                    </div>
                </form>

                <!-- Texto de ayuda -->
                <p class="text-xs text-center text-neutral-500 mt-6">
                    <i class="fas fa-shield-alt mr-1"></i>
                    Toda la información será tratada con estricta confidencialidad y bajo los más altos estándares de seguridad.
                </p>
            </div>
        </main>

        <!-- ========== FOOTER (IDÉNTICO) ========== -->
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
    </div>

    <!-- Scripts para funcionalidad avanzada -->
    <script>
        // Contador de caracteres
        const textarea = document.getElementById('descripcion');
        const charCount = document.getElementById('charCount');

        textarea.addEventListener('input', function() {
            const count = this.value.length;
            charCount.textContent = `${count} / 2000 caracteres`;

            if (count > 1800) {
                charCount.classList.add('text-amber-600');
            } else {
                charCount.classList.remove('text-amber-600');
            }
            if (count > 2000) {
                this.value = this.value.substring(0, 2000);
                charCount.textContent = `2000 / 2000 caracteres`;
            }
        });

        // Sistema de subida de archivos
        const fileInput = document.getElementById('archivos');
        const btnSeleccionar = document.getElementById('btnSeleccionar');
        const dropzone = document.getElementById('dropzone');
        const listaArchivos = document.getElementById('listaArchivos');
        let archivosSeleccionados = [];

        btnSeleccionar.addEventListener('click', () => fileInput.click());

        fileInput.addEventListener('change', (e) => {
            archivosSeleccionados = Array.from(e.target.files);
            mostrarListaArchivos();
        });

        dropzone.addEventListener('dragover', (e) => {
            e.preventDefault();
            dropzone.classList.add('border-primary-500', 'bg-primary-50');
        });

        dropzone.addEventListener('dragleave', () => {
            dropzone.classList.remove('border-primary-500', 'bg-primary-50');
        });

        dropzone.addEventListener('drop', (e) => {
            e.preventDefault();
            dropzone.classList.remove('border-primary-500', 'bg-primary-50');
            archivosSeleccionados = Array.from(e.dataTransfer.files).filter(file => validarArchivo(file));
            mostrarListaArchivos();
            actualizarInputFile();
        });

        function validarArchivo(file) {
            const extensionesPermitidas = ['pdf', 'jpg', 'jpeg', 'png', 'doc', 'docx'];
            const ext = file.name.split('.').pop().toLowerCase();
            if (!extensionesPermitidas.includes(ext)) {
                alert(`El archivo ${file.name} no es válido. Formatos permitidos: PDF, JPG, PNG, DOC`);
                return false;
            }
            if (file.size > 5 * 1024 * 1024) {
                alert(`El archivo ${file.name} excede el límite de 5MB`);
                return false;
            }
            return true;
        }

        function mostrarListaArchivos() {
            if (archivosSeleccionados.length === 0) {
                listaArchivos.innerHTML = '';
                return;
            }

            listaArchivos.innerHTML = archivosSeleccionados.map((file, index) => `
                <div class="flex items-center justify-between bg-white border border-neutral-200 rounded-lg p-3">
                    <div class="flex items-center gap-3">
                        <i class="fas ${file.type.includes('pdf') ? 'fa-file-pdf text-red-500' : file.type.includes('image') ? 'fa-file-image text-blue-500' : 'fa-file-word text-blue-600'} text-xl"></i>
                        <div>
                            <p class="text-sm font-medium text-neutral-700">${file.name}</p>
                            <p class="text-xs text-neutral-400">${(file.size / 1024).toFixed(1)} KB</p>
                        </div>
                    </div>
                    <button type="button" onclick="eliminarArchivo(${index})" class="text-red-500 hover:text-red-700">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </div>
            `).join('');

            actualizarInputFile();
        }

        function eliminarArchivo(index) {
            archivosSeleccionados.splice(index, 1);
            mostrarListaArchivos();
            actualizarInputFile();
        }

        function actualizarInputFile() {
            // Crear nuevo FileList no es posible directamente, así que usamos DataTransfer
            const dataTransfer = new DataTransfer();
            archivosSeleccionados.forEach(file => dataTransfer.items.add(file));
            fileInput.files = dataTransfer.files;
        }

        // Validar submit
        document.querySelector('form').addEventListener('submit', function(e) {
            if (textarea.value.length < 20) {
                e.preventDefault();
                alert('Por favor, proporcione una descripción más detallada (mínimo 20 caracteres)');
                textarea.focus();
            }
        });
    </script>
</body>

</html>