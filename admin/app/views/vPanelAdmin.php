<?php $pageTitle = 'Inicio'; ?>
<?php include_once('layouts/headerAdmin.php'); ?>

    <?php if (isset($datos['total']) && $datos['total'] > 0): ?>
    <div class="modal fade" id="inscripcionesPendientesModal" tabindex="-1" aria-labelledby="inscripcionesPendientesModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header modal-header-primary">
                    <h5 class="modal-title" id="inscripcionesPendientesModalLabel">
                        <i class="bi bi-exclamation-circle me-2"></i>Aviso de Inscripciones
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body text-center py-4">
                    <i class="bi bi-exclamation-triangle-fill text-warning" style="font-size: 3rem;" aria-hidden="true"></i>
                    <h4 class="mt-3 text-danger">¡Atención!</h4>
                    <p class="lead mb-4">
                        Hay <strong><?php echo (int)$datos['total']; ?></strong> inscripción(es) incompleta(s).
                    </p>
                    <a href="index.php?c=GestionInscripciones&m=inscripcionesincompletas" class="btn panel-action-btn px-4">
                        <i class="bi bi-clipboard-check me-2"></i>Ver inscripciones pendientes
                    </a>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <div class="container mt-4 mb-5">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-xl-7">
                <div class="card shadow-sm border-0">
                    <div class="card-body text-center p-4 p-md-5">
                        <i class="bi bi-person-workspace text-primary mb-3" style="font-size: 2.5rem;" aria-hidden="true"></i>
                        <h1 class="h2 mb-2 form-header">¡Bienvenida, Pilar!</h1>
                        <p class="text-muted mb-4">Selecciona una opción para gestionar el Aula Matinal.</p>

                        <div class="row g-3 justify-content-center">
                            <div class="col-sm-6">
                                <a href="index.php?c=GestionInscripciones&m=inscripcionesincompletas"
                                   class="btn btn-lg panel-action-btn w-100 py-3 d-flex align-items-center justify-content-center gap-2">
                                    <i class="bi bi-clipboard-x" aria-hidden="true"></i>
                                    <span>Inscripciones Incompletas</span>
                                    <?php if (isset($datos['total']) && $datos['total'] > 0): ?>
                                        <span class="badge bg-danger ms-1" aria-label="<?php echo (int)$datos['total']; ?> pendientes">
                                            <?php echo (int)$datos['total']; ?>
                                        </span>
                                    <?php endif; ?>
                                </a>
                            </div>
                            <div class="col-sm-6">
                                <a href="index.php?c=GestionInscripciones&m=alumnosinscritos"
                                   class="btn btn-lg panel-action-btn w-100 py-3 d-flex align-items-center justify-content-center gap-2">
                                    <i class="bi bi-clipboard-check" aria-hidden="true"></i>
                                    <span>Inscripciones Completas</span>
                                </a>
                            </div>
                            <div class="col-sm-6">
                                <a href="index.php?c=GestionInscripciones&m=alta"
                                   class="btn btn-lg panel-action-btn w-100 py-3 d-flex align-items-center justify-content-center gap-2">
                                    <i class="bi bi-person-plus" aria-hidden="true"></i>
                                    <span>Añadir Alumno</span>
                                </a>
                            </div>
                            <div class="col-sm-6">
                                <a href="index.php?c=Remesas&m=datosMensuales"
                                   class="btn btn-lg panel-action-btn w-100 py-3 d-flex align-items-center justify-content-center gap-2">
                                    <i class="bi bi-calendar-date" aria-hidden="true"></i>
                                    <span>Generar Remesas</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <?php if (isset($datos['total']) && $datos['total'] > 0): ?>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var modal = new bootstrap.Modal(document.getElementById('inscripcionesPendientesModal'));
            modal.show();
        });
    </script>
    <?php endif; ?>
<?php include_once('layouts/footer.php'); ?>
</body>
</html>
