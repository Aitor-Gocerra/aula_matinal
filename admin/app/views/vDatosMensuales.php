<?php $pageTitle = 'Datos Mensuales'; ?>
<?php require_once('layouts/headerAdmin.php'); ?>

    <div id="datosMesAnio"
         data-mes="<?php echo isset($datos['mes']) ? (int)$datos['mes'] : ''; ?>"
         data-anio="<?php echo isset($datos['anio']) ? (int)$datos['anio'] : ''; ?>"
         aria-hidden="true">
    </div>

    <div class="container mb-5">
        <?php
            $meses = ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
            $mesActual  = isset($datos['mes'])  ? (int)$datos['mes']  : (int)date('m');
            $anioActual = isset($datos['anio']) ? (int)$datos['anio'] : (int)date('Y');
            $nombreMes  = (!empty($datos['mes']) && !empty($datos['anio'])) ? $meses[$mesActual - 1] . ' ' . $anioActual : '';
        ?>

        <div class="d-flex flex-column align-items-center mb-4">
            <div class="section-header h5 mb-0">
                <i class="bi bi-calendar3 me-2" aria-hidden="true"></i>DATOS MENSUALES<?php echo $nombreMes ? ' — ' . $nombreMes : ''; ?>
            </div>
        </div>

        <!-- Alertas de estado -->
        <?php if (!empty($datos['status']) && $datos['status'] === 'error'): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2" aria-hidden="true"></i>
                <?php echo htmlspecialchars($datos['message']); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
            </div>
        <?php endif; ?>
        <?php if (!empty($datos['status']) && $datos['status'] === 'ok'): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle-fill me-2" aria-hidden="true"></i>
                <?php echo htmlspecialchars($datos['message']); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
            </div>
        <?php endif; ?>

        <!-- Navegación de meses y botón generar remesa -->
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
            <div class="d-flex flex-wrap gap-2">
                <a href="index.php?c=Remesas&m=cambiarMes&dir=-1&mes=<?php echo $mesActual; ?>&anio=<?php echo $anioActual; ?>"
                   class="btn btn-outline-azul d-inline-flex align-items-center gap-1">
                    <i class="bi bi-arrow-left" aria-hidden="true"></i> Mes anterior
                </a>
                <a href="index.php?c=Remesas&m=cambiarMes&dir=1&mes=<?php echo $mesActual; ?>&anio=<?php echo $anioActual; ?>"
                   class="btn btn-outline-azul d-inline-flex align-items-center gap-1">
                    Mes siguiente <i class="bi bi-arrow-right" aria-hidden="true"></i>
                </a>
            </div>
            <button class="btn btn-azul d-inline-flex align-items-center gap-1" id="abrirGenerarRemesa" type="button">
                <i class="bi bi-file-earmark-spreadsheet" aria-hidden="true"></i> Generar Remesa
            </button>
        </div>

        <!-- Tabla de datos mensuales -->
        <div class="table-responsive">
            <table class="table table-bordered mb-0 text-center align-middle" aria-label="Datos mensuales de alumnos">
                <thead class="table-light">
                    <tr>
                        <th scope="col">Nombre y apellidos</th>
                        <th scope="col">Clase</th>
                        <th scope="col">Días asistidos</th>
                        <th scope="col">Importe (€)</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody id="tablaDatosMensuales">
                    <?php if (!empty($datos['alumnos']) && is_array($datos['alumnos'])): ?>
                        <?php foreach ($datos['alumnos'] as $alumno): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($alumno['nombre']); ?></td>
                                <td><?php echo htmlspecialchars($alumno['clase']); ?></td>
                                <td><?php echo (int)$alumno['diasAsistidos']; ?></td>
                                <td><?php echo htmlspecialchars($alumno['importe']); ?></td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-detalles"
                                            onclick="mostrarDetallesAlumno(<?php echo (int)$alumno['idAlumno']; ?>)"
                                            aria-label="Ver detalles de <?php echo htmlspecialchars($alumno['nombre']); ?>">
                                        <i class="bi bi-eye me-1" aria-hidden="true"></i> Ver detalles
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-muted fst-italic">No hay datos para mostrar en este período.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal: Ver detalles del alumno -->
    <div class="modal fade" id="detallesModal" tabindex="-1" aria-labelledby="detallesModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header modal-header-primary">
                    <h5 class="modal-title" id="detallesModalLabel">
                        <i class="bi bi-person-lines-fill me-2" aria-hidden="true"></i>Detalles del Alumno
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body" id="detallesAlumno">
                    <!-- Contenido cargado dinámicamente -->
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-cancelar" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal: Generar nueva remesa -->
    <div class="modal fade" id="generarRemesaModal" tabindex="-1" aria-labelledby="generarRemesaModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <form id="formGenerarRemesa" method="post" action="index.php?c=Remesas&m=generarRemesa" class="modal-content">
                <div class="modal-header modal-header-primary">
                    <h5 class="modal-title" id="generarRemesaModalLabel">
                        <i class="bi bi-file-earmark-spreadsheet me-2" aria-hidden="true"></i>Generar Nueva Remesa
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="fechaRemesa" class="form-label">Fecha de Remesa</label>
                        <input type="date" class="form-control" id="fechaRemesa" name="fechaRemesa" required>
                    </div>
                    <div class="alert alert-info d-flex gap-2" role="note">
                        <i class="bi bi-info-circle-fill flex-shrink-0 mt-1" aria-hidden="true"></i>
                        <div>
                            Este proceso generará:
                            <ul class="mb-0 mt-1">
                                <li>La remesa del mes anterior a la fecha seleccionada</li>
                                <li>El archivo Q19 para el banco</li>
                            </ul>
                        </div>
                    </div>
                    <?php if (!empty($datos['status']) && $datos['status'] === 'error'): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?php echo htmlspecialchars($datos['message']); ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
                        </div>
                    <?php endif; ?>
                    <?php if (!empty($datos['status']) && $datos['status'] === 'ok'): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <?php echo htmlspecialchars($datos['message']); ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-cancelar" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" name="generarRemesa" class="btn btn-generar">
                        <i class="bi bi-file-earmark-check me-1" aria-hidden="true"></i> Generar
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/views/consultaAlumnos.js"></script>
</body>
</html>
