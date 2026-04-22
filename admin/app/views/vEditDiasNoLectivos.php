<?php $pageTitle = 'Editar Día No Lectivo'; ?>
<?php require_once('layouts/headerAdmin.php'); ?>

    <div class="container mt-3 mb-5">
        <div class="mb-3">
            <a href="index.php?c=DiasNoLectivos&m=listar" class="btn btn-volver">
                <i class="bi bi-arrow-left me-1" aria-hidden="true"></i> Volver
            </a>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-5">
                <h4 class="text-center mb-4 form-header">
                    MODIFICAR DÍA NO LECTIVO
                    <hr>
                </h4>

                <!-- Alerta de error de validación JS -->
                <div class="alert alert-danger text-center errorMensaje" style="display:none;" role="alert"></div>

                <?php if (isset($datos['error'])): ?>
                    <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                        <i class="bi bi-exclamation-triangle-fill me-2" aria-hidden="true"></i>
                        <?php echo htmlspecialchars($datos['error']); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
                    </div>
                <?php endif; ?>

                <form method="POST" action="index.php?c=DiasNoLectivos&m=editar" novalidate>
                    <input type="hidden" name="id" value="<?php echo (int)$datos['idDia']; ?>">
                    <div class="mb-4">
                        <label for="dia" class="form-label">DÍA NO LECTIVO</label>
                        <input type="date" class="form-control bg-light" id="dia" name="fecha"
                               value="<?php echo htmlspecialchars($datos['fecha'] ?? ''); ?>">
                    </div>
                    <div class="mb-4">
                        <label for="motivo" class="form-label">MOTIVO</label>
                        <input type="text" class="form-control bg-light" id="motivo" name="motivo"
                               value="<?php echo htmlspecialchars($datos['motivo'] ?? ''); ?>"
                               placeholder="Ej: Festivo, Vacaciones...">
                    </div>
                    <div class="d-flex justify-content-center gap-2 mt-4">
                        <button type="submit" class="btn form-button px-4">
                            <i class="bi bi-floppy me-1" aria-hidden="true"></i> MODIFICAR
                        </button>
                        <a href="index.php?c=DiasNoLectivos&m=listar" class="btn btn-cancelar px-4">
                            CANCELAR
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script type="module" src="js/views/vModificarDia.js"></script>
</body>
</html>
