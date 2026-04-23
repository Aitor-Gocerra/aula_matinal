const Tabla = {
    todasLasFilas: [],
    filasFiltradas: [],
    paginaActual: 1,
    filasPorPagina: 10,

    init() {
        this.todasLasFilas = [...document.querySelectorAll('[data-fila-alumno]')];
        this.filasFiltradas = [...this.todasLasFilas];
        this.renderizar();
    },

    filtrar() {
        const texto = document.getElementById('buscadorAlumnos').value.toLowerCase();
        const clase  = document.getElementById('filtroClase').value.toLowerCase();

        this.filasFiltradas = this.todasLasFilas.filter(fila => {
            const nombre      = fila.querySelector('td:nth-child(1)')?.textContent.toLowerCase() ?? '';
            const claseAlumno = fila.querySelector('td:nth-child(2)')?.textContent.toLowerCase() ?? '';
            return nombre.includes(texto) && (clase === '' || claseAlumno === clase);
        });

        this.paginaActual = 1;
        this.renderizar();
    },

    renderizar() {
        this.todasLasFilas.forEach(f => f.style.display = 'none');

        const total     = this.filasFiltradas.length;
        const porPagina = this.filasPorPagina;

        if (total === 0) {
            this.actualizarPaginacion(0, 0, 0, 1, 1);
            return;
        }

        if (porPagina === 0) {
            this.filasFiltradas.forEach(f => f.style.display = '');
            this.actualizarPaginacion(total, 1, total, 1, 1);
            return;
        }

        const totalPaginas = Math.max(1, Math.ceil(total / porPagina));
        if (this.paginaActual > totalPaginas) this.paginaActual = totalPaginas;

        const inicio = (this.paginaActual - 1) * porPagina;
        const fin    = Math.min(inicio + porPagina, total);

        this.filasFiltradas.slice(inicio, fin).forEach(f => f.style.display = '');
        this.actualizarPaginacion(total, inicio + 1, fin, this.paginaActual, totalPaginas);
    },

    actualizarPaginacion(total, desde, hasta, pagActual, totalPaginas) {
        const info      = document.getElementById('paginacionInfo');
        const controles = document.getElementById('paginacionControles');

        if (total === 0) {
            info.textContent = 'Sin resultados';
            controles.innerHTML = '';
            return;
        }

        if (this.filasPorPagina === 0) {
            info.textContent = `${total} alumno${total !== 1 ? 's' : ''}`;
            controles.innerHTML = '';
            return;
        }

        info.textContent = `${desde}–${hasta} de ${total} alumno${total !== 1 ? 's' : ''}`;

        let html = `<li class="page-item ${pagActual === 1 ? 'disabled' : ''}">
            <a class="page-link" href="#" data-pagina="${pagActual - 1}" aria-label="Anterior">‹</a>
        </li>`;

        this.rangoPaginas(pagActual, totalPaginas).forEach(p => {
            if (p === '…') {
                html += `<li class="page-item disabled"><span class="page-link">…</span></li>`;
            } else {
                html += `<li class="page-item ${p === pagActual ? 'active' : ''}">
                    <a class="page-link" href="#" data-pagina="${p}">${p}</a>
                </li>`;
            }
        });

        html += `<li class="page-item ${pagActual === totalPaginas ? 'disabled' : ''}">
            <a class="page-link" href="#" data-pagina="${pagActual + 1}" aria-label="Siguiente">›</a>
        </li>`;

        controles.innerHTML = html;
    },

    rangoPaginas(actual, total) {
        if (total <= 7) return Array.from({ length: total }, (_, i) => i + 1);
        if (actual <= 4) return [1, 2, 3, 4, 5, '…', total];
        if (actual >= total - 3) return [1, '…', total - 4, total - 3, total - 2, total - 1, total];
        return [1, '…', actual - 1, actual, actual + 1, '…', total];
    },

    irAPagina(pagina) {
        const totalPaginas = Math.ceil(this.filasFiltradas.length / this.filasPorPagina);
        if (pagina < 1 || pagina > totalPaginas) return;
        this.paginaActual = pagina;
        this.renderizar();
    }
};

document.addEventListener('DOMContentLoaded', () => {
    Tabla.init();

    document.getElementById('buscadorAlumnos').addEventListener('input', () => Tabla.filtrar());
    document.getElementById('filtroClase').addEventListener('change', () => Tabla.filtrar());

    document.getElementById('filasPorPagina').addEventListener('change', function () {
        Tabla.filasPorPagina = parseInt(this.value);
        Tabla.paginaActual = 1;
        Tabla.renderizar();
    });

    document.getElementById('paginacionControles').addEventListener('click', e => {
        e.preventDefault();
        const link = e.target.closest('[data-pagina]');
        if (!link) return;
        Tabla.irAPagina(parseInt(link.dataset.pagina));
    });

    // Modal de baja
    const bajaModalEl      = document.getElementById('bajaModal');
    const bajaModalNombre  = document.getElementById('bajaModalNombre');
    const btnConfirmarBaja = document.getElementById('btnConfirmarBaja');

    document.addEventListener('click', e => {
        const btn = e.target.closest('[data-accion="baja"]');
        if (!btn) return;
        bajaModalNombre.textContent = btn.dataset.nombre;
        btnConfirmarBaja.href = 'index.php?c=GestionInscripciones&m=darDeBaja&id=' + btn.dataset.id;
        new bootstrap.Modal(bajaModalEl).show();
    });
});
