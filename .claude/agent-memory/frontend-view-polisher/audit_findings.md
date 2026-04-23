---
name: Audit Findings — April 2026
description: Cross-cutting issues found during the full view audit of April 2026
type: project
---

## Cross-Cutting Issues (All Views)

1. **Duplicate Bootstrap JS** — every view loads bootstrap.bundle.min.js; headerAdmin.php does NOT load it, so this is technically correct, but some views (vDiasNoLectivos.php) also load popper.min.js separately (redundant since bundle includes it)
2. **Missing <title> in header partial** — each view has its own <head>/<title> AND includes headerAdmin.php which also opens <html><head> — this creates DUPLICATE <html> and <head> tags on every page (critical structural bug)
3. **Inline styles instead of CSS classes** — `style="background-color: #006EA4; color: white;"` repeated 20+ times; CSS variables exist but not used via classes
4. **Inconsistent back-button styling** — some views use inline style, others use `.form-button` class
5. **Duplicate `<div class="table-responsive">` wrapper** — vAlumnosInscritos.php has nested double table-responsive divs
6. **Missing `modal fade` class** — vDiasNoLectivos.php and vGestionRemesas.php modals use `class="modal"` without `fade` — no animation
7. **Duplicate id** — headerAdmin.php has two `id="inicioCursoDropdown"` (INSCRIPCIONES and INICIO CURSO dropdowns) — invalid HTML
8. **Broken HTML structure in forms** — vAltaInscripcion.php, vCompletarInscripcion.php, vModificarInscripcion.php close `</body>` inside the column div, never closing the container/row/col properly
9. **section-header fixed width** — `.section-header` is hardcoded at `width: 250px` which clips text on smaller screens
10. **No `for` attribute on form labels** — labels in form views missing `for` attribute linked to input `id` (accessibility)
11. **vConsultarDatos.php** — no closing tags for col/row/container divs; page is unclosed
12. **vFechaCurso.php** — double `container` nesting (`.container-sm.mt-5` wrapping `.container.mt-5`)
13. **vPanelAdmin.php** — buttons use same icon (`bi-clipboard-check`) for both Inscripciones Incompletas AND Inscripciones Completas — wrong icon on second button
14. **No `aria-label`** — modal headers in some views missing accessible labels
15. **Card body background inconsistency** — #bcd7e4 in vAltaInscripcion, #d9ebf5 in vCompletarInscripcion/vModificarInscripcion
