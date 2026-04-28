<?php $pageTitle = 'Días No Lectivos'; ?>
<?php require_once('layouts/headerAdmin.php'); ?>

    <!-- Modal: confirmar borrado de un día -->
    <div class="modal fade" tabindex="-1" id="modalBorrado" aria-labelledby="modalBorradoLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header modal-header-primary">
                    <h5 class="modal-title" id="modalBorradoLabel">
                        <i class="bi bi-trash me-2" aria-hidden="true"></i>Eliminar día no lectivo
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <p class="mb-0">¿Estás seguro de que quieres eliminar este día no lectivo?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-cancelar" data-bs-dismiss="modal">Cancelar</button>
                    <a href="#" class="btn btn-danger" id="btnConfirmarBorrado">
                        <i class="bi bi-trash me-1" aria-hidden="true"></i> Eliminar
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal: confirmar borrado de todos los días -->
    <div class="modal fade" tabindex="-1" id="modalBorradoTodos" aria-labelledby="modalBorradoTodosLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="modalBorradoTodosLabel">
                        <i class="bi bi-exclamation-triangle me-2" aria-hidden="true"></i>Borrar todos los días no lectivos
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <p class="mb-0">¿Estás seguro de que quieres borrar <strong>todos</strong> los días no lectivos? Esta acción no se puede deshacer.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-cancelar" data-bs-dismiss="modal">Cancelar</button>
                    <a href="index.php?c=DiasNoLectivos&m=eliminarTodos" class="btn btn-danger">
                        <i class="bi bi-trash me-1" aria-hidden="true"></i> Borrar todos
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="container dias-no-lectivos-container mb-5">
        <div class="d-flex flex-column align-items-center mb-4">
            <div class="section-header">
                <i class="bi bi-calendar-x me-2" aria-hidden="true"></i>DÍAS NO LECTIVOS
            </div>
        </div>

        <!-- Alertas de estado -->
        <?php if (!empty($datos['status']) && $datos['status'] === 'ok'): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle-fill me-2" aria-hidden="true"></i>
                <?php echo htmlspecialchars($datos['message']); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
            </div>
        <?php endif; ?>
        <?php if (!empty($datos['status']) && $datos['status'] === 'error'): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2" aria-hidden="true"></i>
                <?php echo htmlspecialchars($datos['message']); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
            </div>
        <?php endif; ?>

        <!-- Barra de herramientas -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <a href="index.php?c=DiasNoLectivos&m=alta"
               class="btn add-button d-inline-flex align-items-center gap-1"
               title="Añadir día no lectivo" aria-label="Añadir día no lectivo">
                <i class="bi bi-plus-lg" aria-hidden="true"></i> Añadir
            </a>
            <button type="button" class="btn btn-danger d-inline-flex align-items-center gap-1"
                    data-bs-toggle="modal" data-bs-target="#modalBorradoTodos">
                <i class="bi bi-trash" aria-hidden="true"></i> Borrar todos
            </button>
        </div>

        <div class="table-responsive">
            <table class="table mb-0 text-center align-middle" aria-label="Listado de días no lectivos">
                <thead>
                    <tr>
                        <th scope="col">Día</th>
                        <th scope="col">Motivo</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($datos['datos'] as $valor): ?>
                        <tr>
                            <td><?php echo htmlspecialchars(date('d-m-Y', strtotime($valor['fecha']))); ?></td>
                            <td><?php echo htmlspecialchars($valor['motivo']); ?></td>
                            <td>
                                <a href="index.php?c=DiasNoLectivos&m=formEdit&id=<?php echo (int)$valor['idDia']; ?>"
                                   class="btn btn-sm action-button me-1"
                                   title="Editar" aria-label="Editar día <?php echo htmlspecialchars(date('d-m-Y', strtotime($valor['fecha']))); ?>">
                                    <i class="bi bi-pencil" aria-hidden="true"></i>
                                </a>
                                <button type="button"
                                        class="btn btn-sm btn-danger"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalBorrado"
                                        data-id="<?php echo (int)$valor['idDia']; ?>"
                                        aria-label="Eliminar día <?php echo htmlspecialchars(date('d-m-Y', strtotime($valor['fecha']))); ?>">
                                    <i class="bi bi-trash" aria-hidden="true"></i>
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('modalBorrado').addEventListener('show.bs.modal', function (event) {
            var idDia = event.relatedTarget.getAttribute('data-id');
            document.getElementById('btnConfirmarBorrado').href = 'index.php?c=DiasNoLectivos&m=eliminar&id=' + idDia;
        });
    </script>
<?php include_once('layouts/footer.php'); ?>
</body>
</html>
