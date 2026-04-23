---
name: Project Context
description: Core facts about the Aula Matinal admin panel project — stack, structure, Bootstrap version
type: project
---

School morning care management system (Aula Matinal) for a Spanish school. Admin panel only (no public-facing views in this directory).

Bootstrap version: 5.3.3 loaded via CDN in headerAdmin.php
Bootstrap Icons: 1.11.1 via CDN in headerAdmin.php
Custom CSS: /admin/assets/css/style.css
PHP pattern: MVC — controllers in admin/app/controllers/, views in admin/app/views/
Layout partial: admin/app/views/layouts/headerAdmin.php (navbar + Bootstrap CSS/Icons links; does NOT include closing </body></html> or Bootstrap JS)
Bootstrap JS: each view loads its own Bootstrap bundle script before </body>

Color palette (CSS custom properties):
  --azul-principal: #006EA4
  --azul-secundario: #5B9BD5
  --azul-claro: #7AAFC9
  --gris-tabla: #D9D9D9
  --blanco: #ffffff

Named user: "Pilar" (hardcoded in vPanelAdmin.php welcome heading)

**Why:** Needed to understand project scope before auditing views.
**How to apply:** Always reference these conventions when suggesting Bootstrap fixes; do not propose external libraries or JS frameworks beyond Bootstrap's own bundle.
