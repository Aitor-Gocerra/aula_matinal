<?php $pageTitle = 'Modificar Tarifas'; ?>
<?php require_once('layouts/headerAdmin.php'); ?>

    <div class="container mt-3 mb-5">
        <div class="mb-3">
            <a href="index.php?c=PanelAdmin&m=inicio" class="btn btn-volver">
                <i class="bi bi-arrow-left me-1" aria-hidden="true"></i> Volver
            </a>
        </div>

        <?php if (isset($datos['mensaje_exito'])): ?>
            <div class="alert alert-success alert-dismissible fade show mx-auto" style="max-width: 600px;" role="alert">
                <i class="bi bi-check-circle-fill me-2" aria-hidden="true"></i>
                <?php echo htmlspecialchars($datos['mensaje_exito']); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
            </div>
        <?php endif; ?>

        <?php if (isset($datos['errores']) && !empty($datos['errores'])): ?>
            <div class="alert alert-danger alert-dismissible fade show mx-auto" style="max-width: 600px;" role="alert">
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

        <?php if (isset($datos['errores_guardado']) && !empty($datos['errores_guardado'])): ?>
            <div class="alert alert-danger alert-dismissible fade show mx-auto" style="max-width: 600px;" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2" aria-hidden="true"></i>
                <strong>Error al guardar:</strong>
                <ul class="mb-0 mt-1">
                    <?php foreach ($datos['errores_guardado'] as $error): ?>
                        <li><?php echo htmlspecialchars($error); ?></li>
                    <?php endforeach; ?>
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
            </div>
        <?php endif; ?>

        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-5">
                <h4 class="text-center mb-4 form-header">
                    MODIFICAR TARIFAS
                    <hr>
                </h4>
                <form action="index.php?c=Tarifas&m=insertarTarifas" method="post" novalidate>
                    <div class="mb-4">
                        <label for="precioDia" class="form-label">PRECIO POR DÍA (€)</label>
                        <div class="input-group">
                            <span class="input-group-text" aria-hidden="true">€</span>
                            <input type="number" step="0.01" min="0" id="precioDia" name="precioDia"
                                   value="<?php echo htmlspecialchars($datos['precioDia'] ?? ''); ?>"
                                   class="form-control bg-light" placeholder="0.00">
                        </div>
                    </div>
                    <div class="mb-4">
                        <label for="precioMes" class="form-label">PRECIO POR MES (€)</label>
                        <div class="input-group">
                            <span class="input-group-text" aria-hidden="true">€</span>
                            <input type="number" step="0.01" min="0" id="precioMes" name="precioMes"
                                   value="<?php echo htmlspecialchars($datos['precioMes'] ?? ''); ?>"
                                   class="form-control bg-light" placeholder="0.00">
                        </div>
                    </div>
                    <div class="mb-4">
                        <label for="diasMes" class="form-label">DÍAS MÍNIMOS PARA COBRAR TARIFA MENSUAL</label>
                        <input type="number" min="1" id="diasMes" name="numDias"
                               value="<?php echo htmlspecialchars($datos['numDias'] ?? ''); ?>"
                               class="form-control bg-light" placeholder="Ej: 15">
                        <div class="form-text">A partir de este número de días (inclusive), se aplicará la tarifa mensual.</div>
                    </div>
                    <div class="d-flex justify-content-center gap-2 mt-4">
                        <button type="submit" class="btn form-button px-4">
                            <i class="bi bi-floppy me-1" aria-hidden="true"></i> MODIFICAR
                        </button>
                        <a href="index.php?c=PanelAdmin&m=inicio" class="btn btn-cancelar px-4">
                            CANCELAR
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/views/vModificarTarifas.js"></script>
</body>
</html>
