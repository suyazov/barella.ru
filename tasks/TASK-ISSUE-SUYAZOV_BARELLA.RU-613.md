# TASK-ISSUE-SUYAZOV_BARELLA.RU-613 — Footer template 2606: ссылки в заголовках колонок

## Identity

- Project: barella.ru
- Repository: suyazov/barella.ru
- Environment: barella.sy3.ru-staging
- Task ID: TASK-ISSUE-SUYAZOV_BARELLA.RU-613
- AFFiNE Row ID: F1OXEZYZ9C
- Production target: `https://barella.pro/` (Bridge `wp-admin-direct`, regulation §21.4)

## Scope

В Elementor-шаблоне футера barella.pro (template_id 2606, slug `footer`,
post_type `elementor_library`) три heading-виджета колонок не имеют ссылок —
футер не содержит рабочей навигации по разделам (header-меню уже исправлено и
проверено оператором, не трогаем). Требуется ровно один change-set contract
v1.3 с одним op `update_elementor_widgets` по `template_id` 2606 и тремя
action `set_widget_link`:

- `618c310a` (О КОМПАНИИ) → `/o-kompanii/`
- `be49e5b` (ОБЪЕКТЫ) → `/obekty/`
- `59989d33` (КОНТАКТЫ) → `/kontakty/`

Больше ничего не меняется: тексты заголовков, структура шаблона, остальные
виджеты (logo, списки, контакты, html), страницы, меню и опции. Других op в
change-set нет. Контекст: footer-часть TASK-575 была BLOCKED по capability
(contract v1.1 не мог редактировать Elementor theme-builder template);
contract v1.3 добавляет op `update_elementor_widgets` (см.
`docs/ADMIN_DIRECT.md`).

## Delivery

- Change-set: `admin-direct/changes/task-issue-suyazov-barella-ru-613.json` —
  root keys ровно `schema_version/ops/verify`; один op
  `update_elementor_widgets` (`template_id` 2606, три action `set_widget_link`);
  три `verify.checks` (`/`, `/obekty/`, `/kontakty/`) с required-текстами
  `О КОМПАНИИ`, `ОБЪЕКТЫ`, `КОНТАКТЫ` и absent `barella.sy3.ru`.
- Перед записью Bridge Connector делает snapshot шаблона 2606; при любом
  apply/live-verify failure выполняется штатный rollback (snapshot restore) по
  регламенту §21.4. Executor прямой записи в production не делает.
- Итоговую проверку исходной разметки футера (каждый из трёх заголовков —
  ссылка на свой раздел, тексты не изменены) выполняет оператор после
  доставки.

## Acceptance

- В исходной разметке футера всех страниц сайта: О КОМПАНИИ → `/o-kompanii/`,
  ОБЪЕКТЫ → `/obekty/`, КОНТАКТЫ → `/kontakty/`; тексты заголовков не изменены.
- Live acceptance: `/`, `/obekty/`, `/kontakty/` содержат точные видимые
  тексты `О КОМПАНИИ`, `ОБЪЕКТЫ`, `КОНТАКТЫ`.

## Checks executor'а

- JSON change-set валиден (parse OK); root keys ровно
  `schema_version/ops/verify`; ровно 1 op с ключами только
  `type/template_id/actions`; ровно 3 action `set_widget_link` с ключами
  только `action/element_id/url`.
- PHP-файлы не менялись (PHP lint неприменим); `git diff --check` — чисто.
