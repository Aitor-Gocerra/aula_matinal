---
name: UI Patterns and Conventions
description: Recurring Bootstrap patterns, custom CSS classes, and PHP templating conventions used across views
type: project
---

## Custom CSS Classes Used Across Views
- `.section-header` — fixed-width (250px) blue pill heading; used in list/table views
- `.action-button` — blue bg, white text; used for table row action buttons (edit/info)
- `.add-button` — blue bg, white text, 40x40px; used for top-of-page add/icon buttons
- `.form-button` / `.form-header` — styled form submit buttons and form section titles
- `.btn-azul`, `.btn-outline-azul` — project-specific button variants
- `.btn-cancelar`, `.btn-generar`, `.btn-detalles` — more specific button variants
- `.dias-no-lectivos-container` — max-width: 900px container class (used in several list views too)
- `.bg-custom-secondary` — blue background for search input-group-text

## Layout Pattern
Every view:
1. Opens <!DOCTYPE html><html><head> with title + favicon only (no Bootstrap CSS — that's in header partial)
2. Includes layouts/headerAdmin.php (which has <body> opening tag, navbar, and Bootstrap CSS)
3. Contains page content
4. Loads Bootstrap JS bundle before </body>
5. Does NOT include a footer partial — no shared footer exists

## Card Pattern for Forms
Forms with tutor + student data use:
- `.card.mb-4` with `.card-header.text-white` (bg via inline style #006EA4) + `.card-body` (bg via inline style)
- Inline styles are used for card backgrounds instead of custom CSS classes

## Table Pattern
- `.table.mb-0.text-center` inside `.table-responsive`
- Rows use `.align-middle`
- Action buttons: `.btn.btn-sm.action-button`

## Modal Pattern
- Confirmation modals for delete actions use `data-bs-toggle="modal"` on trigger links
- Modal `.modal-header` styled with inline `style="background-color: var(--azul-principal); color: white;"` on some views, not others — inconsistent

## PHP Templating
- Alternative syntax (foreach/endforeach) used in some views, echo string concatenation in others — mixed styles
- htmlspecialchars() used in newer views, raw echo in older ones (security risk on user-facing fields)
