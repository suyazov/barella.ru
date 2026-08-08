# TASK-ISSUE-SUYAZOV_BARELLA.RU-600 — финальная унификация UI Barella

## Delivery

- Один declarative change-set: `admin-direct/changes/task-issue-suyazov-barella-ru-600.json`.
- Разрешённые `update_page`: 3327, 3328, 3329 и 3408–3417, каждый ровно один раз.
- Header/footer templates, menus, options, DNS, media library и CF7 backend не изменяются.
- Bridge Connector после merge обязан выполнить snapshot всех 13 page IDs до первой записи и штатный rollback при apply или live-verify failure согласно `docs/ADMIN_DIRECT.md`.

## Read-only live evidence (2026-08-09)

Anonymous live HTTP read выполнен до подготовки change-set для всех целевых маршрутов:

| Page ID | Route | State |
|---:|---|---|
| 3327 | `/o-kompanii/` | HTTP content read; единственная форма `wpcf7-f3334-p3327` |
| 3328 | `/obekty/` | HTTP content read; каталог содержит 10 карточек и текущие production URLs |
| 3329 | `/kontakty/` | HTTP content read; единственная форма `wpcf7-f845-p3329` |
| 3408 | `/obekty/svetlana/` | HTTP content read |
| 3409 | `/obekty/oktyabrskaya-naberezhnaya/` | HTTP content read |
| 3410 | `/obekty/vertical/` | HTTP content read |
| 3411 | `/obekty/kalyannyy-bar-nevskiy/` | HTTP content read |
| 3412 | `/obekty/retinoidy/` | HTTP content read |
| 3413 | `/obekty/polisan-ampulnaya-liniya/` | HTTP content read |
| 3414 | `/obekty/polisan-paketnaya-liniya/` | HTTP content read |
| 3415 | `/obekty/pskov-proizvodstvennye-linii/` | HTTP content read |
| 3416 | `/obekty/pskov-drobestruy-galvanika/` | HTTP content read |
| 3417 | `/obekty/rublevo-arkhangelskoe/` | HTTP content read |

Ни один из 13 ответов не содержал `Internal Server Error`. Тексты, media URLs, ссылки и CF7 shortcode IDs в change-set наследуются из принятого task-581 content; изменения ограничены scoped CSS и семантическим H1 страницы company без изменения видимого текста.

## Navigation audit (read-only)

Live header WP menu:

| Item | WP item ID | href |
|---|---:|---|
| `О КОМПАНИИ` | 3046 | `/o-kompanii/` |
| `ОБЪЕКТЫ` | 3047 | `/obekty/` |
| `КОНТАКТЫ` | 3048 | `/kontakty/` |

Live footer — Elementor library template ID `2606` (`data-elementor-post-type="elementor_library"`). Заголовки присутствуют:

- `О КОМПАНИИ`: heading widget `618c310a`; сам heading не является ссылкой. В колонке есть только ссылка на `/politika-konfidenczialnosti` (icon-list widget `2216ffd1`).
- `ОБЪЕКТЫ`: heading widget `be49e5b`; heading и колонка не содержат object navigation links.
- `КОНТАКТЫ`: heading widget `59989d33`; ниже присутствуют текстовые контактные данные и телефонная ссылка (icon-list widget `6ec1b6e3`).

No mutation: Connector v1.1 `update_menu` умеет только append нового item и не подходит для update/remove существующих items; `update_page` не разрешает изменять Elementor theme-builder template. Нужная bounded capability для отдельной задачи: update существующего menu item по точному item ID и/или update Elementor library template `2606` по exact template ID с snapshot/rollback и live DOM verify. Добавлять дубли запрещено.

## Contract checks

- Формы: одна `#3334` на company и одна `#845` на contacts; общий light-neutral form-card, одинаковые input/button параметры и порядок, заданный scoped CSS.
- CTA: company, catalog и 10 object pages используют neutral card, burgundy top accent и primary button `#870001`.
- Typography/rhythm: desktop H1 `40px/1.2`, H2/CTA `30px/1.25`, compact top gaps; mobile H1 `28px` и H2 `24px`.
- Object pages: HTML content, hero meta, works, gallery, тексты, href и photo URLs сохранены; меняется только scoped design CSS.
- Catalog: flex contract 3+3+3+1 desktop, 2 tablet, 1 mobile не изменён.
- Verify lifecycle проверяет пять требуемых маршрутов, точные acceptance texts, отсутствие server error, staging hostname и известных blue-family tokens.

## context_delta

```json
{
  "result": "Prepared one bounded wp-admin-direct change-set for unified Barella page, form and CTA styling across 13 allowed pages.",
  "decisions": "Preserved all content, media URLs, CF7 IDs and catalog layout; recorded header and footer as read-only evidence without mutation.",
  "current_status": "Ready for PR review and Bridge-managed snapshot, apply, rollback-on-failure and live verification after merge.",
  "constraints": "No direct production write, menu/template/options mutation, DNS/media/backend change or Kimi execution.",
  "next_step": "Review and merge through Bridge policy; separately add bounded existing-menu-item and Elementor-template update capabilities if footer navigation is requested."
}
```
