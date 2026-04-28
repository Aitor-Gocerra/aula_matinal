<?php $pageTitle = 'Inscripciones Incompletas'; ?>
<?php include_once('layouts/headerAdmin.php'); ?>

    <!-- Modal de aviso (errores / éxito) -->
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

    <div class="container dias-no-lectivos-container mb-5">
        <div class="d-flex flex-column align-items-center mb-4">
            <div class="section-header">
                <i class="bi bi-clipboard-x me-2" aria-hidden="true"></i>INSCRIPCIONES INCOMPLETAS
            </div>
        </div>

        <div class="mb-3">
            <a href="index.php?c=GestionInscripciones&m=alumnosinscritos"
               class="btn add-button d-inline-flex align-items-center gap-1">
                <i class="bi bi-people" aria-hidden="true"></i> Inscripciones completas
            </a>
        </div>

        <div class="table-responsive">
            <table class="table mb-0 text-center align-middle" aria-label="Listado de inscripciones incompletas">
                <thead>
                    <tr>
                        <th scope="col">Nombre del alumno</th>
                        <th scope="col">Teléfono</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (isset($datos['noincompletas'])): ?>
                        <tr>
                            <td colspan="3">
                                <p class="text-danger fw-bold mb-0"><?php echo htmlspecialchars($datos['noincompletas']); ?></p>
                            </td>
                        </tr>
                    <?php endif; ?>
                    <?php if (isset($datos['datos'])): ?>
                        <?php foreach ($datos['datos'] as $dato): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($dato['nombreAlumno']); ?></td>
                                <td><?php echo htmlspecialchars($dato['telefono'] ?? '—'); ?></td>
                                <td>
                                    <a href="index.php?c=GestionInscripciones&m=completarInscripcion&id=<?php echo (int)$dato['idInscripcion']; ?>"
                                       class="btn btn-sm action-button d-inline-flex align-items-center gap-1"
                                       title="Completar inscripción" aria-label="Completar inscripción de <?php echo htmlspecialchars($dato['nombreAlumno']); ?>">
                                        <i class="bi bi-pencil" aria-hidden="true"></i> Completar
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            <?php if (isset($datos['errores']) || isset($datos['mensaje_exito'])): ?>
                var modal = new bootstrap.Modal(document.getElementById('avisoModal'));
                modal.show();
            <?php endif; ?>
        });
    </script>
<?php include_once('layouts/footer.php'); ?>
</body>
</html>
