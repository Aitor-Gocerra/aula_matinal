<?php $pageTitle = 'Consultar Datos'; ?>
<?php include_once('layouts/headerAdmin.php'); ?>

    <div class="container mt-3 mb-5">
        <div class="mb-3">
            <a href="index.php?c=GestionInscripciones&m=alumnosinscritos" class="btn btn-volver">
                <i class="bi bi-arrow-left me-1" aria-hidden="true"></i> Volver
            </a>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <h4 class="text-center mb-4 form-header">
                    DATOS DE INSCRIPCIÓN
                    <hr>
                </h4>

                <!-- Datos del tutor -->
                <div class="card mb-4 shadow-sm">
                    <div class="card-header card-header-primary">
                        <h5 class="mb-0"><i class="bi bi-person-vcard me-2" aria-hidden="true"></i>DATOS DEL PADRE/MADRE/TUTOR</h5>
                    </div>
                    <div class="card-body">
                        <dl class="row mb-0">
                            <dt class="col-sm-4 form-label">NOMBRE Y APELLIDOS</dt>
                            <dd class="col-sm-8"><?php echo htmlspecialchars(($datos['nombrePadre'] ?? '') . ' ' . ($datos['apellidosPadre'] ?? '')); ?></dd>

                            <dt class="col-sm-4 form-label">TELÉFONO</dt>
                            <dd class="col-sm-8"><?php echo htmlspecialchars($datos['telefono'] ?? '—'); ?></dd>

                            <dt class="col-sm-4 form-label">CORREO</dt>
                            <dd class="col-sm-8">
                                <?php if (!empty($datos['correo'])): ?>
                                    <a href="mailto:<?php echo htmlspecialchars($datos['correo']); ?>">
                                        <?php echo htmlspecialchars($datos['correo']); ?>
                                    </a>
                                <?php else: ?>
                                    —
                                <?php endif; ?>
                            </dd>
                        </dl>
                    </div>
                </div>

                <!-- Datos del alumno -->
                <div class="card mb-4 shadow-sm">
                    <div class="card-header card-header-primary">
                        <h5 class="mb-0"><i class="bi bi-mortarboard me-2" aria-hidden="true"></i>DATOS DEL ALUMNO</h5>
                    </div>
                    <div class="card-body">
                        <dl class="row mb-0">
                            <dt class="col-sm-4 form-label">NOMBRE Y APELLIDOS</dt>
                            <dd class="col-sm-8"><?php echo htmlspecialchars(($datos['nombreAlumno'] ?? '') . ' ' . ($datos['apellidosAlumno'] ?? '')); ?></dd>

                            <dt class="col-sm-4 form-label">CLASE</dt>
                            <dd class="col-sm-8"><?php echo htmlspecialchars($datos['clase'] ?? '—'); ?></dd>
                        </dl>
                    </div>
                </div>

                <div class="d-flex justify-content-center gap-2">
                    <a href="index.php?c=GestionInscripciones&m=modificacionInscripcion&id=<?php echo (int)($datos['idInscripcion'] ?? 0); ?>"
                       class="btn btn-volver px-4">
                        <i class="bi bi-pencil me-1" aria-hidden="true"></i> Modificar
                    </a>
                    <a href="index.php?c=GestionInscripciones&m=alumnosinscritos" class="btn btn-cancelar px-4">
                        Volver al listado
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
