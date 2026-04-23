<?php $pageTitle = 'Alumnos Inscritos'; ?>
<?php include_once('layouts/headerAdmin.php'); ?>

    <!-- Modal de aviso (errores de sistema / éxito) -->
    <div class="modal fade" id="avisoModal" tabindex="-1" aria-labelledby="avisoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header modal-header-primary">
                    <h5 class="modal-title" id="avisoModalLabel">Aviso</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body text-center py-4">
                    <?php if (isset($datos['errores']) && !empty($datos['errores'])): ?>
                        <i class="bi bi-exclamation-triangle-fill text-warning" style="font-size: 3rem;" aria-hidden="true"></i>
                        <h4 class="mt-3 text-danger">¡Atención!</h4>
                        <p class="lead"><strong><?php echo htmlspecialchars($datos['errores']); ?></strong></p>
                    <?php endif; ?>
                    <?php if (isset($datos['mensaje_exito'])): ?>
                        <i class="bi bi-check-circle-fill text-success" style="font-size: 3rem;" aria-hidden="true"></i>
                        <h4 class="mt-3 text-success">¡Éxito!</h4>
                        <p class="lead"><strong><?php echo htmlspecialchars($datos['mensaje_exito']); ?></strong></p>
                    <?php endif; ?>
                </div>
                <div class="modal-footer border-0 justify-content-center">
                    <button type="button" class="btn btn-volver" data-bs-dismiss="modal">Aceptar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de confirmación de baja -->
    <div class="modal fade" id="bajaModal" tabindex="-1" aria-labelledby="bajaModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header modal-header-primary">
                    <h5 class="modal-title" id="bajaModalLabel">
                        <i class="bi bi-person-dash me-2" aria-hidden="true"></i>Dar de baja
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body text-center py-4">
                    <i class="bi bi-exclamation-triangle-fill text-warning" style="font-size: 3rem;" aria-hidden="true"></i>
                    <p class="mt-3 mb-0">¿Seguro que quieres dar de baja a <strong id="bajaModalNombre"></strong>?</p>
                    <p class="text-danger small mt-1">Esta acción eliminará el alumno, sus asistencias y sus recibos.</p>
                </div>
                <div class="modal-footer border-0 justify-content-center">
                    <a href="#" id="btnConfirmarBaja" class="btn btn-danger px-4">
                        <i class="bi bi-person-dash me-1" aria-hidden="true"></i> Dar de baja
                    </a>
                    <button type="button" class="btn btn-cancelar px-4" data-bs-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de inscripción (añadir / modificar) -->
    <div class="modal fade" id="inscripcionModal" tabindex="-1" aria-labelledby="inscripcionModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header modal-header-primary">
                    <h5 class="modal-title" id="inscripcionModalLabel">AÑADIR ALUMNO</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>

                <form method="post" id="formInscripcion" action="index.php?c=GestionInscripciones&m=insertar" novalidate>
                    <div class="modal-body">

                        <?php if (isset($datos['errores_formulario']) && !empty($datos['errores_formulario'])): ?>
                            <div class="alert alert-danger alert-dismissible fade show mb-3" role="alert" id="erroresFormularioDiv">
                                <i class="bi bi-exclamation-triangle-fill me-2" aria-hidden="true"></i>
                                <strong>Por favor, corrija los siguientes errores:</strong>
                                <ul class="mb-0 mt-1">
                                    <?php foreach ($datos['errores_formulario'] as $error): ?>
                                        <li><?php echo htmlspecialchars($error); ?></li>
                                    <?php endforeach; ?>
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
                            </div>
                        <?php else: ?>
                            <div id="erroresFormularioDiv" class="d-none"></div>
                        <?php endif; ?>

                        <div class="row g-4">
                            <!-- Datos del tutor -->
                            <div class="col-md-6">
                                <div class="card h-100 shadow-sm">
                                    <div class="card-header card-header-primary">
                                        <h6 class="mb-0"><i class="bi bi-person-vcard me-2" aria-hidden="true"></i>DATOS DEL PADRE/MADRE/TUTOR</h6>
                                    </div>
                                    <div class="card-body card-body-form">
                                        <div class="row g-2">
                                            <div class="col-sm-6">
                                                <label for="nombrePadre" class="form-label">NOMBRE</label>
                                                <input type="text" id="nombrePadre" name="nombrePadre"
                                                       value="<?php echo htmlspecialchars($datos['form_data']['nombrePadre'] ?? ''); ?>"
                                                       class="form-control bg-light" placeholder="Nombre del tutor">
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="apellidosPadre" class="form-label">APELLIDOS</label>
                                                <input type="text" id="apellidosPadre" name="apellidosPadre"
                                                       value="<?php echo htmlspecialchars($datos['form_data']['apellidosPadre'] ?? ''); ?>"
                                                       class="form-control bg-light" placeholder="Apellidos del tutor">
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="DNI" class="form-label">DNI/NIE/PASAPORTE</label>
                                                <input type="text" id="DNI" name="DNI"
                                                       value="<?php echo htmlspecialchars($datos['form_data']['DNI'] ?? ''); ?>"
                                                       class="form-control bg-light" placeholder="DNI del tutor">
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="telefono" class="form-label">TELÉFONO</label>
                                                <input type="tel" id="telefono" name="telefono"
                                                       value="<?php echo htmlspecialchars($datos['form_data']['telefono'] ?? ''); ?>"
                                                       class="form-control bg-light" placeholder="Teléfono del tutor">
                                            </div>
                                            <div class="col-12">
                                                <label for="correo" class="form-label">CORREO ELECTRÓNICO</label>
                                                <input type="email" id="correo" name="correo"
                                                       value="<?php echo htmlspecialchars($datos['form_data']['correo'] ?? ''); ?>"
                                                       class="form-control bg-light" placeholder="correo@ejemplo.com">
                                            </div>
                                            <div class="col-12">
                                                <label for="IBAN" class="form-label">IBAN</label>
                                                <input type="text" id="IBAN" name="IBAN"
                                                       value="<?php echo htmlspecialchars($datos['form_data']['IBAN'] ?? ''); ?>"
                                                       class="form-control bg-light" placeholder="ES00 0000 0000 0000 0000 0000">
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="titularCuenta" class="form-label">TITULAR DE LA CUENTA</label>
                                                <input type="text" id="titularCuenta" name="titularCuenta"
                                                       value="<?php echo htmlspecialchars($datos['form_data']['titularCuenta'] ?? ''); ?>"
                                                       class="form-control bg-light" placeholder="Nombre del titular">
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="fechaMandato" class="form-label">FECHA MANDATO</label>
                                                <input type="date" id="fechaMandato" name="fechaMandato"
                                                       value="<?php echo htmlspecialchars($datos['form_data']['fechaMandato'] ?? ''); ?>"
                                                       class="form-control bg-light">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Datos del alumno -->
                            <div class="col-md-6">
                                <div class="card h-100 shadow-sm">
                                    <div class="card-header card-header-primary">
                                        <h6 class="mb-0"><i class="bi bi-mortarboard me-2" aria-hidden="true"></i>DATOS DEL ALUMNO</h6>
                                    </div>
                                    <div class="card-body card-body-form">
                                        <div class="row g-2">
                                            <div class="col-sm-6">
                                                <label for="nombreAlumno" class="form-label">NOMBRE</label>
                                                <input type="text" id="nombreAlumno" name="nombreAlumno"
                                                       value="<?php echo htmlspecialchars($datos['form_data']['nombreAlumno'] ?? ''); ?>"
                                                       class="form-control bg-light" placeholder="Nombre del alumno">
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="apellidosAlumno" class="form-label">APELLIDOS</label>
                                                <input type="text" id="apellidosAlumno" name="apellidosAlumno"
                                                       value="<?php echo htmlspecialchars($datos['form_data']['apellidosAlumno'] ?? ''); ?>"
                                                       class="form-control bg-light" placeholder="Apellidos del alumno">
                                            </div>
                                            <div class="col-12">
                                                <label for="idClase" class="form-label">CLASE</label>
                                                <select id="idClase" name="idClase" class="form-select bg-light">
                                                    <option value="">Seleccione una clase</option>
                                                    <?php
                                                    $preselectedClase = $datos['form_data']['idClase'] ?? null;
                                                    foreach ($datos['clases'] as $clase): ?>
                                                        <option value="<?php echo (int)$clase['idClase']; ?>"
                                                            <?php echo ($preselectedClase == $clase['idClase']) ? 'selected' : ''; ?>>
                                                            <?php echo htmlspecialchars($clase['clase']); ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-volver px-4">
                            <i class="bi bi-floppy me-1" aria-hidden="true"></i> GUARDAR
                        </button>
                        <button type="button" class="btn btn-cancelar px-4" data-bs-dismiss="modal">
                            CANCELAR
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="container dias-no-lectivos-container mb-5">
        <div class="d-flex flex-column align-items-center mb-4">
            <div class="section-header">
                <i class="bi bi-people-fill me-2" aria-hidden="true"></i>ALUMNOS INSCRITOS
            </div>
        </div>

        <!-- Barra de herramientas -->
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
            <div class="d-flex flex-wrap gap-2">
                <button type="button" id="btnAnadirAlumno" class="btn add-button d-inline-flex align-items-center gap-1">
                    <i class="bi bi-person-plus" aria-hidden="true"></i> Añadir alumno
                </button>
                <a href="index.php?c=GenerarPdf&m=generarpdf" target="_blank" rel="noopener noreferrer" class="btn add-button d-inline-flex align-items-center gap-1">
                    <i class="bi bi-printer" aria-hidden="true"></i> Imprimir
                </a>
                <a href="index.php?c=GestionInscripciones&m=inscripcionesincompletas" class="btn add-button d-inline-flex align-items-center gap-1">
                    <i class="bi bi-clipboard-check" aria-hidden="true"></i> Completar Inscripciones
                </a>
                <a href="index.php?c=GestionInscripciones&m=exportarCSV" class="btn add-button d-inline-flex align-items-center gap-1">
                    <i class="bi bi-filetype-csv" aria-hidden="true"></i> Exportar CSV
                </a>
            </div>
            <div class="d-flex align-items-center gap-2" style="flex-shrink: 0;">
                <select class="form-select form-select-sm" id="filtroClase" aria-label="Filtrar por clase" style="width: 160px;">
                    <option value="">Todas las clases</option>
                    <?php foreach ($datos['clases'] as $clase): ?>
                        <option value="<?php echo htmlspecialchars($clase['clase']); ?>">
                            <?php echo htmlspecialchars($clase['clase']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <div class="input-group input-group-sm" style="width: 230px;">
                    <span class="input-group-text bg-custom-secondary" aria-hidden="true">
                        <i class="bi bi-search"></i>
                    </span>
                    <input type="text" class="form-control" id="buscadorAlumnos"
                           placeholder="Buscar por nombre" aria-label="Buscar alumno por nombre">
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table mb-0 text-center align-middle" aria-label="Listado de alumnos inscritos">
                <thead>
                    <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Clase</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (isset($datos['noalumnos'])): ?>
                        <tr>
                            <td colspan="3">
                                <p class="text-danger fw-bold mb-0"><?php echo htmlspecialchars($datos['noalumnos']); ?></p>
                            </td>
                        </tr>
                    <?php endif; ?>
                    <?php if (isset($datos['datos'])): ?>
                        <?php foreach ($datos['datos'] as $dato): ?>
                            <tr data-fila-alumno="true">
                                <td>
                                    <a href="index.php?c=GestionInscripciones&m=consultardatos&id=<?php echo (int)$dato['idInscripcion']; ?>"
                                       class="text-decoration-none fw-medium">
                                        <?php echo htmlspecialchars($dato['apellidosAlumno'] . ', ' . $dato['nombreAlumno']); ?>
                                    </a>
                                </td>
                                <td><?php echo htmlspecialchars($dato['clase']); ?></td>
                                <td>
                                    <button type="button"
                                            class="btn btn-sm action-button"
                                            data-accion="modificar"
                                            data-id="<?php echo (int)$dato['idInscripcion']; ?>"
                                            data-nombre-padre="<?php echo htmlspecialchars($dato['nombrePadre']); ?>"
                                            data-apellidos-padre="<?php echo htmlspecialchars($dato['apellidosPadre']); ?>"
                                            data-dni="<?php echo htmlspecialchars($dato['DNI']); ?>"
                                            data-telefono="<?php echo htmlspecialchars($dato['telefono']); ?>"
                                            data-correo="<?php echo htmlspecialchars($dato['correo']); ?>"
                                            data-iban="<?php echo htmlspecialchars($dato['IBAN']); ?>"
                                            data-titular="<?php echo htmlspecialchars($dato['titularCuenta']); ?>"
                                            data-fecha-mandato="<?php echo htmlspecialchars($dato['fechaMandato'] ?? ''); ?>"
                                            data-nombre-alumno="<?php echo htmlspecialchars($dato['nombreAlumno']); ?>"
                                            data-apellidos-alumno="<?php echo htmlspecialchars($dato['apellidosAlumno']); ?>"
                                            data-id-clase="<?php echo (int)$dato['idClase']; ?>"
                                            title="Modificar" aria-label="Modificar inscripción de <?php echo htmlspecialchars($dato['nombreAlumno']); ?>">
                                        <i class="bi bi-pencil" aria-hidden="true"></i>
                                    </button>
                                    <button type="button"
                                            class="btn btn-sm btn-outline-danger"
                                            data-accion="baja"
                                            data-id="<?php echo (int)$dato['idInscripcion']; ?>"
                                            data-nombre="<?php echo htmlspecialchars($dato['apellidosAlumno'] . ', ' . $dato['nombreAlumno']); ?>"
                                            title="Dar de baja" aria-label="Dar de baja a <?php echo htmlspecialchars($dato['nombreAlumno']); ?>">
                                        <i class="bi bi-person-dash" aria-hidden="true"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- Paginación -->
        <div class="d-flex flex-wrap justify-content-between align-items-center mt-3 gap-2">
            <small class="text-muted" id="paginacionInfo"></small>
            <nav aria-label="Paginación alumnos">
                <ul class="pagination pagination-sm mb-0" id="paginacionControles"></ul>
            </nav>
            <select class="form-select form-select-sm" id="filasPorPagina" aria-label="Filas por página" style="width: auto;">
                <option value="10">10 por página</option>
                <option value="25">25 por página</option>
                <option value="50">50 por página</option>
                <option value="0">Todos</option>
            </select>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const inscripcionModalEl = document.getElementById('inscripcionModal');
            const formInscripcion    = document.getElementById('formInscripcion');
            const modalTitulo        = document.getElementById('inscripcionModalLabel');
            const erroresDiv         = document.getElementById('erroresFormularioDiv');

            function limpiarErrores() {
                erroresDiv.classList.add('d-none');
                erroresDiv.innerHTML = '';
            }

            // Añadir alumno — abre el modal en blanco
            document.getElementById('btnAnadirAlumno').addEventListener('click', function () {
                modalTitulo.textContent = 'AÑADIR ALUMNO';
                formInscripcion.action  = 'index.php?c=GestionInscripciones&m=insertar';
                formInscripcion.reset();
                limpiarErrores();
                new bootstrap.Modal(inscripcionModalEl).show();
            });

            // Modificar alumno — delegación de eventos sobre la tabla
            document.addEventListener('click', function (e) {
                const btn = e.target.closest('[data-accion="modificar"]');
                if (!btn) return;

                modalTitulo.textContent = 'MODIFICAR ALUMNO';
                const id = btn.dataset.id;
                formInscripcion.action  = 'index.php?c=GestionInscripciones&m=modificarinscripcion_completa&id=' + id;

                document.getElementById('nombrePadre').value     = btn.dataset.nombrePadre    || '';
                document.getElementById('apellidosPadre').value  = btn.dataset.apellidosPadre || '';
                document.getElementById('DNI').value             = btn.dataset.dni            || '';
                document.getElementById('telefono').value        = btn.dataset.telefono       || '';
                document.getElementById('correo').value          = btn.dataset.correo         || '';
                document.getElementById('IBAN').value            = btn.dataset.iban           || '';
                document.getElementById('titularCuenta').value   = btn.dataset.titular        || '';
                document.getElementById('fechaMandato').value    = btn.dataset.fechaMandato   || '';
                document.getElementById('nombreAlumno').value    = btn.dataset.nombreAlumno   || '';
                document.getElementById('apellidosAlumno').value = btn.dataset.apellidosAlumno || '';
                document.getElementById('idClase').value         = btn.dataset.idClase        || '';

                limpiarErrores();
                new bootstrap.Modal(inscripcionModalEl).show();
            });

            // Reabrir modal con errores de validación tras submit
            <?php if (isset($datos['modal_tipo'])): ?>
            (function () {
                <?php if ($datos['modal_tipo'] === 'modificar'): ?>
                    modalTitulo.textContent = 'MODIFICAR ALUMNO';
                    formInscripcion.action  = 'index.php?c=GestionInscripciones&m=modificarinscripcion_completa&id=<?php echo (int)($datos['id_inscripcion'] ?? 0); ?>';
                <?php else: ?>
                    modalTitulo.textContent = 'AÑADIR ALUMNO';
                    formInscripcion.action  = 'index.php?c=GestionInscripciones&m=insertar';
                <?php endif; ?>
                new bootstrap.Modal(inscripcionModalEl).show();
            })();
            <?php endif; ?>

            // Modal de aviso (éxito o error de sistema)
            <?php if (isset($datos['errores']) || isset($datos['mensaje_exito'])): ?>
            new bootstrap.Modal(document.getElementById('avisoModal')).show();
            <?php endif; ?>
        });
    </script>
    <script src="js/views/vAlumnosInscritos.js"></script>
</body>
</html>
