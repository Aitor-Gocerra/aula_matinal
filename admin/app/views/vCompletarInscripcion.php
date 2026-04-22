<?php $pageTitle = 'Completar Inscripción'; ?>
<?php include_once('layouts/headerAdmin.php'); ?>

    <div class="container mt-3 mb-5">
        <div class="mb-3">
            <a href="index.php?c=GestionInscripciones&m=inscripcionesincompletas" class="btn btn-volver">
                <i class="bi bi-arrow-left me-1" aria-hidden="true"></i> Volver
            </a>
        </div>

        <?php if (isset($datos['errores']) && !empty($datos['errores'])): ?>
            <div class="alert alert-danger alert-dismissible fade show mx-auto" style="max-width: 650px;" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2" aria-hidden="true"></i>
                <strong>Por favor, corrija los siguientes errores:</strong>
                <ul class="mb-0 mt-1">
                    <?php foreach ($datos['errores'] as $error): ?>
                        <li><?php echo htmlspecialchars($error); ?></li>
                    <?php endforeach; ?>
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
            </div>
        <?php endif; ?>

        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <h4 class="text-center mb-4 form-header">
                    COMPLETAR INSCRIPCIÓN
                    <hr>
                </h4>

                <form action="index.php?c=GestionInscripciones&m=procesosCompletado&id=<?php echo (int)$datos['id_inscripcion']; ?>" method="post" novalidate>

                    <!-- Datos del tutor -->
                    <div class="card mb-4 shadow-sm">
                        <div class="card-header card-header-primary">
                            <h5 class="mb-0"><i class="bi bi-person-vcard me-2" aria-hidden="true"></i>DATOS DEL PADRE/MADRE/TUTOR</h5>
                        </div>
                        <div class="card-body card-body-form">
                            <div class="row g-3">
                                <div class="col-sm-6">
                                    <label for="nombrePadre" class="form-label">NOMBRE</label>
                                    <input type="text" id="nombrePadre" name="nombrePadre"
                                           value="<?php echo htmlspecialchars($datos['datos']['nombrePadre'] ?? ''); ?>"
                                           class="form-control bg-light" placeholder="Nombre del tutor">
                                </div>
                                <div class="col-sm-6">
                                    <label for="apellidosPadre" class="form-label">APELLIDOS</label>
                                    <input type="text" id="apellidosPadre" name="apellidosPadre"
                                           value="<?php echo htmlspecialchars($datos['datos']['apellidosPadre'] ?? ''); ?>"
                                           class="form-control bg-light" placeholder="Apellidos del tutor">
                                </div>
                                <div class="col-sm-6">
                                    <label for="DNI" class="form-label">DNI/NIE/PASAPORTE</label>
                                    <input type="text" id="DNI" name="DNI"
                                           value="<?php echo htmlspecialchars($datos['datos']['DNI'] ?? ''); ?>"
                                           class="form-control bg-light" placeholder="DNI del tutor">
                                </div>
                                <div class="col-sm-6">
                                    <label for="telefono" class="form-label">TELÉFONO</label>
                                    <input type="tel" id="telefono" name="telefono"
                                           value="<?php echo htmlspecialchars($datos['datos']['telefono'] ?? ''); ?>"
                                           class="form-control bg-light" placeholder="Teléfono del tutor">
                                </div>
                                <div class="col-12">
                                    <label for="correo" class="form-label">CORREO ELECTRÓNICO</label>
                                    <input type="email" id="correo" name="correo"
                                           value="<?php echo htmlspecialchars($datos['datos']['correo'] ?? ''); ?>"
                                           class="form-control bg-light" placeholder="correo@ejemplo.com">
                                </div>
                                <div class="col-12">
                                    <label for="IBAN" class="form-label">IBAN</label>
                                    <input type="text" id="IBAN" name="IBAN"
                                           value="<?php echo htmlspecialchars($datos['datos']['IBAN'] ?? ''); ?>"
                                           class="form-control bg-light" placeholder="ES00 0000 0000 0000 0000 0000">
                                </div>
                                <div class="col-sm-6">
                                    <label for="titularCuenta" class="form-label">TITULAR DE LA CUENTA</label>
                                    <input type="text" id="titularCuenta" name="titularCuenta"
                                           value="<?php echo htmlspecialchars($datos['datos']['titularCuenta'] ?? ''); ?>"
                                           class="form-control bg-light" placeholder="Nombre del titular">
                                </div>
                                <div class="col-sm-6">
                                    <label for="fechaMandato" class="form-label">FECHA MANDATO</label>
                                    <input type="date" id="fechaMandato" name="fechaMandato"
                                           value="<?php echo htmlspecialchars($datos['datos']['fechaMandato'] ?? ''); ?>"
                                           class="form-control bg-light">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Datos del alumno -->
                    <div class="card mb-4 shadow-sm">
                        <div class="card-header card-header-primary">
                            <h5 class="mb-0"><i class="bi bi-mortarboard me-2" aria-hidden="true"></i>DATOS DEL ALUMNO</h5>
                        </div>
                        <div class="card-body card-body-form">
                            <div class="row g-3">
                                <div class="col-sm-6">
                                    <label for="nombreAlumno" class="form-label">NOMBRE</label>
                                    <input type="text" id="nombreAlumno" name="nombreAlumno"
                                           value="<?php echo htmlspecialchars($datos['datos']['nombreAlumno'] ?? ''); ?>"
                                           class="form-control bg-light" placeholder="Nombre del alumno">
                                </div>
                                <div class="col-sm-6">
                                    <label for="apellidosAlumno" class="form-label">APELLIDOS</label>
                                    <input type="text" id="apellidosAlumno" name="apellidosAlumno"
                                           value="<?php echo htmlspecialchars($datos['datos']['apellidosAlumno'] ?? ''); ?>"
                                           class="form-control bg-light" placeholder="Apellidos del alumno">
                                </div>
                                <div class="col-12">
                                    <label for="idClase" class="form-label">CLASE</label>
                                    <select id="idClase" name="idClase" class="form-select bg-light">
                                        <option value="">Seleccione una clase</option>
                                        <?php foreach ($datos['clases'] as $clase): ?>
                                            <option value="<?php echo (int)$clase['idClase']; ?>"
                                                <?php echo (isset($datos['datos']['idClase']) && $datos['datos']['idClase'] == $clase['idClase']) ? 'selected' : ''; ?>>
                                                <?php echo htmlspecialchars($clase['clase']); ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex flex-wrap justify-content-center gap-2 mb-4">
                        <button type="submit" name="accion" value="completar" class="btn btn-volver px-3">
                            <i class="bi bi-check-circle me-1" aria-hidden="true"></i> COMPLETAR INSCRIPCIÓN
                        </button>
                        <button type="submit" name="accion" value="guardar_pendiente" class="btn btn-outline-secondary px-3">
                            <i class="bi bi-floppy me-1" aria-hidden="true"></i> GUARDAR CON DATOS PENDIENTES
                        </button>
                        <a href="index.php?c=GestionInscripciones&m=inscripcionesincompletas" class="btn btn-cancelar px-3">
                            CANCELAR
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/views/vCompletarInscripcion.js"></script>
</body>
</html>
