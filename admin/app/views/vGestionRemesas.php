<?php $pageTitle = 'Historial de Remesas'; ?>
<?php require_once('layouts/headerAdmin.php'); ?>

    <!-- Modal: confirmar borrado de remesa -->
    <div class="modal fade" tabindex="-1" id="modalBorrarRemesa" aria-labelledby="modalBorrarRemesaLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header modal-header-primary">
                    <h5 class="modal-title" id="modalBorrarRemesaLabel">
                        <i class="bi bi-trash me-2" aria-hidden="true"></i>Eliminar remesa
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <p class="mb-0">¿Estás seguro de que quieres eliminar esta remesa? Esta acción no se puede deshacer.</p>
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

    <div class="container mb-5">
        <div class="d-flex flex-column align-items-center mb-4">
            <div class="section-header">
                <i class="bi bi-archive me-2" aria-hidden="true"></i>HISTORIAL DE REMESAS
            </div>
        </div>

        <?php
            $remesas = $datos['remesas'] ?? [];
            $meses = [
                1 => 'Enero', 2 => 'Febrero', 3 => 'Marzo', 4 => 'Abril', 5 => 'Mayo',
                6 => 'Junio', 7 => 'Julio', 8 => 'Agosto', 9 => 'Septiembre',
                10 => 'Octubre', 11 => 'Noviembre', 12 => 'Diciembre'
            ];

            if (isset($_GET['msg'])) {
                $mensajes = [
                    'ok'       => 'Remesa eliminada correctamente.',
                    'error_bd' => 'Hubo un error al eliminar la remesa.',
                    'error_id' => 'ID de remesa no válido.'
                ];
                $tipoAlerta = ($_GET['msg'] === 'ok') ? 'success' : 'danger';
                $icono      = ($_GET['msg'] === 'ok') ? 'check-circle-fill' : 'exclamation-triangle-fill';
                $msgTexto   = $mensajes[$_GET['msg']] ?? 'Operación realizada.';
                echo '<div class="alert alert-' . $tipoAlerta . ' alert-dismissible fade show" role="alert">'
                   . '<i class="bi bi-' . $icono . ' me-2" aria-hidden="true"></i>'
                   . htmlspecialchars($msgTexto)
                   . '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>'
                   . '</div>';
            }
        ?>

        <!-- Buscador -->
        <div class="d-flex justify-content-end mb-3">
            <div class="input-group" style="max-width: 280px;">
                <span class="input-group-text bg-custom-secondary" aria-hidden="true">
                    <i class="bi bi-search"></i>
                </span>
                <input type="text" class="form-control" id="buscadorRemesas"
                       placeholder="Buscar remesa" aria-label="Buscar remesa">
            </div>
        </div>

        <div class="table-responsive">
            <table class="table mb-0 text-center align-middle" aria-label="Historial de remesas generadas">
                <thead>
                    <tr>
                        <th scope="col">Período</th>
                        <th scope="col">Fecha de generación</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($remesas)): ?>
                        <?php foreach ($remesas as $remesa): ?>
                            <?php
                                $mesNumero   = (int)$remesa['mes'];
                                $periodo     = ($meses[$mesNumero] ?? '?') . ' ' . $remesa['anio'];
                                $fechaGenObj = date_create($remesa['fechaGenerada']);
                                $fechaGen    = $fechaGenObj ? date_format($fechaGenObj, 'd/m/Y') : '—';
                            ?>
                            <tr>
                                <td><?php echo htmlspecialchars($periodo); ?></td>
                                <td><?php echo htmlspecialchars($fechaGen); ?></td>
                                <td>
                                    <a href="index.php?c=Remesas&m=descargarQ19&mes=<?php echo $mesNumero; ?>&anio=<?php echo (int)$remesa['anio']; ?>"
                                       class="btn btn-sm action-button me-1 d-inline-flex align-items-center gap-1"
                                       title="Descargar archivo Q19" aria-label="Descargar Q19 de <?php echo htmlspecialchars($periodo); ?>">
                                        <i class="bi bi-file-earmark-text" aria-hidden="true"></i> Descargar Q19
                                    </a>
                                    <button type="button"
                                            class="btn btn-sm btn-danger d-inline-flex align-items-center gap-1"
                                            data-bs-toggle="modal"
                                            data-bs-target="#modalBorrarRemesa"
                                            data-id="<?php echo (int)$remesa['idRemesa']; ?>"
                                            aria-label="Eliminar remesa de <?php echo htmlspecialchars($periodo); ?>">
                                        <i class="bi bi-trash" aria-hidden="true"></i> Eliminar
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="3" class="text-muted fst-italic">No hay remesas generadas.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script type="module" src="js/views/vRemesas.js"></script>
</body>
</html>
