# TASK-ISSUE-SUYAZOV_BARELLA.RU-573 — Исправление каталога /obekty/ после отклонения #566 (flex + !important, root #barella-catalog-v2)

## Identity

- Project: barella.ru
- Repository: suyazov/barella.ru
- Environment: barella.sy3.ru-staging
- Task ID: TASK-ISSUE-SUYAZOV_BARELLA.RU-573
- AFFiNE Task ID: TASK-ISSUE-SUYAZOV_BARELLA.RU-573
- AFFiNE Row ID: 4TcM441PEz
- Source SHA: 2f021ecf6511068b6b936810f8734489665ae3d8
- Task file: tasks/TASK-ISSUE-SUYAZOV_BARELLA.RU-573.md

## Scope

Ручная визуальная приёмка владельца отклонила результат #566 (PR #10, merge 2f021ecf6511068b6b936810f8734489665ae3d8): production /obekty/ показывал разваленный каталог (карточки left/right/center, пустые вертикальные зоны, серые cover-зоны). Исправляется ТОЛЬКО production page_id 3328 `/obekty/` одним declarative `update_page` change-set'ом wordpress-admin-direct; 10 отдельных object pages не меняются. CSS Grid из #566 не повторяется: раскладка — детерминированный flex с `!important` на всех геометрических свойствах под уникальным root `#barella-catalog-v2`.

## Delivery

- Change-set: `admin-direct/changes/task-issue-suyazov-barella-ru-573.json` — один op `update_page` page_id 3328.
- Layout: container max-width 1180px / width calc(100% - 40px) / margin auto; cards wrapper `display:flex!important;flex-wrap:wrap!important;align-items:stretch!important;justify-content:flex-start!important;gap:24px!important`; card >=900px — `flex:0 0 calc((100% - 48px)/3)!important` + width/max-width/min-width/margin/float/position/left/right/top/transform все с `!important`; 600–899px — 2 колонки `calc((100% - 24px)/2)`; <=599px — 1 колонка 100%. Без grid/grid-column/grid-row/nth-child, spacer wrappers, absolute positioning и индивидуального центрирования.
- Card: белый фон, radius 14px, тонкая граница + деликатная тень, cover 4:3 на всю ширину с `object-fit:cover!important`, body flex-column, title 18px/700, спокойная meta, ссылка «Подробнее об объекте» внизу.
- Все 10 cover `<img>` — существующие `https://barella.pro/wp-content/uploads/2026/08/...` URL (все проверены HTTP 200, image/jpeg, непустые размеры) с `loading="eager"`. Новые файлы не загружались.
- Intro «Наши объекты» компактный, без синей hero-плашки; CTA после сетки — единый аккуратный блок.
- Snapshot page 3328 и rollback при apply/live-verify failure выполняются Bridge Connector'ом по регламенту §21.4 (backup → deploy → verify).

## QA evidence (локальный браузерный прогон на harness = live production HTML страницы /obekty/ с заменённым catalog-блоком; тема clinmedix-child присутствует в DOM)

Playwright/Chromium, getBoundingClientRect() всех 10 cards:

- 1440x1200: rows exactly [3,3,3,1] — одинаковый top в строке (tolerance <=5px), canonical lefts совпадают, hgap 20–28px, vgap 20–36px, ни один промежуток между рядами не >50px — PASS
- 1024x1000: rows exactly [3,3,3,1] — PASS
- 768x1000: rows exactly [2,2,2,2,2] — PASS
- 390x844: exactly 10 rows по одной card, horizontal overflow = 0 — PASS
- DOM: exactly 10 cards, exactly 10 non-empty img src, все images complete=true и naturalWidth>0/naturalHeight>0, один site header — PASS
- Console errors = 0 (harness-артефакты file:// CORS для шрифтов темы исключены — на production шрифты same-origin) — PASS
- Screenshots: `.kimi-tmp/qa-obekty-v2-1440.png`, `.kimi-tmp/qa-obekty-v2-390.png` (визуально — компактная сетка 3+3+3+1 с реальными фото, не похожа на отклонённый screenshot #566)

Финальная браузерная геометрическая QA на production выполняется после apply изменения Bridge Connector'ом (post-merge verify по change-set `verify.checks` + визуальная приёмка владельца); executor не имеет права прямой записи в production.

## Canonical evidence

```json
{
  "source": "bridge_orchestration_controller",
  "verified": true,
  "repository": "suyazov/barella.ru",
  "task_file": "tasks/TASK-ISSUE-SUYAZOV_BARELLA.RU-573.md",
  "task_id": "TASK-ISSUE-SUYAZOV_BARELLA.RU-573",
  "source_sha": "2f021ecf6511068b6b936810f8734489665ae3d8",
  "affine_task_id": "TASK-ISSUE-SUYAZOV_BARELLA.RU-573",
  "affine_row_id": "4TcM441PEz"
}
```
