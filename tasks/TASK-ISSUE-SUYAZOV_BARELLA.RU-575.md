# TASK-ISSUE-SUYAZOV_BARELLA.RU-575 — Единый пакет клиентских правок: палитра «Объекты» (бордовый `#870001`) + footer nav

## Identity

- Project: barella.ru
- Repository: suyazov/barella.ru
- Environment: barella.sy3.ru-staging
- Task ID: TASK-ISSUE-SUYAZOV_BARELLA.RU-575
- AFFiNE Task ID: TASK-ISSUE-SUYAZOV_BARELLA.RU-575
- AFFiNE Row ID: lE_NhdqbPX
- Source SHA: b98ed22ecb50365d19d8e77c7c272bfcd5ae7b2a
- Task file: tasks/TASK-ISSUE-SUYAZOV_BARELLA.RU-575.md
- Executor: managed Kimi handoff после CODEX_USAGE_LIMIT_REACHED (Loop e21eff20f506ba050e91e79e, generation 1)

## Scope (из Bridge, без изменений)

1) ДИЗАЙН: убрать синий из раздела «Объекты» на production — `/obekty/` и все 10 `/obekty/<slug>/`.
Разрешённая палитра: бордовый `#870001` (CTA/ссылки/акценты), чёрный/тёмно-серый текст, белый/нейтральный светло-серый фон.
Сохранить геометрию каталога 3+3+3+1 / 2 / 1, 10 обложек, тексты и URL, структуру страницы объекта hero → meta → выполненные работы → галерея → CTA.

2) FOOTER NAV: сделать рабочими `О КОМПАНИИ` → `/o-kompanii/`, `ОБЪЕКТЫ` → `/obekty/`, `КОНТАКТЫ` → `/kontakty/`.

## Delivery — часть 1 (палитра): ВЫПОЛНЕНО

- Change-set: `admin-direct/changes/task-issue-suyazov-barella-ru-575.json` — 11 ops `update_page`:
  - page_id 3328 (`/obekty/`, каталог `#barella-catalog-v2`, база — принятый контент из task-574);
  - page_id 3408–3417 (10 страниц объектов `.barella-objx`, база — контент из task-563).
- Замены (только цвета, без изменения структуры/текстов/URL/обложек):
  - `#0b5fa5` → `#870001` (CTA, ссылки, чек-иконки, акцентные рамки);
  - `#084a82` → `#5c0001` (предсказуемый тёмный hover/focus-оттенок бордового);
  - `rgba(11,95,165,0.14)` → `rgba(135,0,1,0.14)` (hover-тень карточки объекта);
  - CSS-переменные `--barella-blue*` переименованы в `--barella-accent*`;
  - сине-серые нейтрали заменены на нейтральные: `#1c2733`→`#1a1a1a`, `#5a6b7b`→`#5f5f5f`, `#f4f7fa`→`#f5f5f5`, `#eef2f6`→`#f0f0f0`, `#e2e8f0`→`#e5e5e5`, `#dce5ee`→`#e0e0e0`, тени `rgba(16,24,40,*)`→`rgba(0,0,0,*)`.
- Hero/CTA-градиенты страниц объектов стали бордовыми (`#5c0001`→`#870001`) через те же переменные; фотографии не перекрашиваются, глобальная тема сайта не меняется.
- wpautop-защита как в принятом task-574: контент всех 11 страниц сериализован одной строкой; на страницах объектов добавлено guard-правило `br{display:none}` для grid-контейнеров.
- Геометрия каталога (3+3+3+1 desktop / 2 tablet / 1 mobile), все 10 обложек, тексты и URL сохранены — diff контента только по цветовым токенам.
- Snapshot page ids 3328, 3408–3417 до записи и rollback при apply/live-verify failure выполняются Bridge Connector'ом по регламенту §21.4 (backup → deploy → verify); executor прямой записи в production не делает.
- `verify.checks` change-set'а: `/obekty/`, `/obekty/svetlana/`, `/obekty/vertical/`, `/obekty/rublevo-arkhangelskoe/` — required `#870001` + acceptance-тексты, absent `#0b5fa5`, `#084a82`, `barella.sy3.ru`, «Фото объекта — добавляется отдельной задачей оператора».
- Browser QA (1440/390, computed styles, overflow, console) выполняется Bridge после merge по регламенту; executor подтвердил палитру статическим аудитом всех цветовых токенов в change-set'е (только `#870001`, `#5c0001`, нейтральные, `#ffffff`).

## Delivery — часть 2 (footer nav): BLOCKED (capability evidence)

Показанное клиентом нижнее меню на `https://barella.pro/` **не является WordPress nav menu**:

- Live DOM (curl-выгрузка `/`, 2026-08-08): футер — Elementor-шаблон, колонки
  `elementor-column ... clinmedix-footer` с heading-виджетами `О КОМПАНИИ`, `ОБЪЕКТЫ`, `КОНТАКТЫ`
  (`elementor-widget-heading`) и `elementor-icon-list` списками. Единственная ссылка в футере —
  «Политика конфиденциальности» → `/politika-konfidenczialnosti` (icon-list item, не menu item).
  Колонка `ОБЪЕКТЫ` вообще не содержит ссылок; `КОНТАКТЫ` — только контактные данные.
  Классы `menu-item-*` на странице принадлежат только header-меню (custom links) — его менять запрещено.
- Connector contract v1.1 (`docs/ADMIN_DIRECT.md`) допускает только `update_page`, `create_page`,
  `update_menu`, `update_option`. Ни один op не может редактировать Elementor theme-builder footer template:
  `update_menu` лишь дополняет WP nav menu (и `auto` резолвится в единственное theme-location menu — header,
  что прямо запрещено задачей); `update_page` с `elementor_data` адресует numeric page id, а футер —
  отдельный Elementor template вне страниц; правка theme/Elementor-template — вне разрешённой поверхности.
- Согласно fallback-инструкции задачи: ссылки внутри body страниц не имитировались; палитра выполнена,
  footer-часть завершена этим BLOCKED/capability evidence до нерегламентированного write.

## Checks executor'а

- JSON change-set валиден по контракту: root keys ровно `schema_version/ops/verify`, 11 ops `update_page`
  (лимит 20), только разрешённые ключи, page_id — положительные int, 4 verify.checks (лимит 10), path regex OK.
- Палитра: во всех 11 content нет `#0b5fa5`, `#084a82`, `rgba(11,95,165,...)`, `barella-blue`;
  все цветовые токены ∈ {`#870001`, `#5c0001`, `#1a1a1a`, `#5f5f5f`, `#f5f5f5`, `#f0f0f0`, `#e5e5e5`, `#e0e0e0`, `#ffffff`};
  `#feedbac` в аудите — это URL-fragment `#feedback-form`, не цвет.
- Required acceptance-тексты присутствуют в content; запрещённые тексты отсутствуют; `\n` в content нет.
- Live-контроль до записи: `/obekty/` и `/obekty/svetlana/` действительно содержат `0b5fa5` (синий на production подтверждён).
- PHP-файлы не менялись (PHP lint неприменим); `git diff --check` — чисто.
