# TASK-ISSUE-SUYAZOV_BARELLA.RU-622 — Компактная форма «Давайте обсудим ваш проект» на /o-kompanii/ и /obekty/

## Identity

- Project: barella.ru
- Repository: suyazov/barella.ru
- Environment: barella.sy3.ru-staging
- Task ID: TASK-ISSUE-SUYAZOV_BARELLA.RU-622
- AFFiNE Row ID: BkCGtKscER
- Production target: `https://barella.pro/` (Bridge `wp-admin-direct`, regulation §21.4)

## Scope

Исправить подтверждённый владельцем дефект после TASK-609: блок формы
«Давайте обсудим ваш проект» остаётся чрезмерно высоким с большим пустым
участком под полями. Меняются только page_id 3327 `/o-kompanii/` и
page_id 3328 `/obekty/` — обе страницы получают один и тот же compact form
CSS contract:

- `.bf-cta` и ближайший wrapper: `height:auto!important;min-height:0!important`;
  `.bf-cta` — `padding:24px 32px 20px!important`, без top/bottom spacer.
- `h2` — `margin-bottom:8px!important`, description — `margin-bottom:14px!important`.
- Desktop >=900px: name + phone + submit в одной строке (grid, gap 12px),
  consent отдельной строкой сразу под ними (`margin-top:10px`); input и
  submit — `height:44px`; пустого блока после consent нет
  (`.wpcf7-response-output` margin 0, отступ только у `:not(:empty)`).
- `.wpcf7`, `.wpcf7-form`, `.custom-consult-form`, `.row`, колонки —
  `height:auto!important;min-height:0!important`, inherited min-height и
  oversized padding/margins переопределены.
- 600..899px — 2 колонки; <=599px — вертикальный стек,
  `.bf-cta{padding:22px 18px 18px!important}`.

Сохранены: CF7 shortcode `contact-form-7 id="3334"` (ровно один на странице),
все тексты, поля, consent, submit label, каталог из 10 объектов со всеми
href/image src, весь остальной контент обеих страниц. Не меняются
`/kontakty/`, object detail pages, header/footer/menu, options, media, DNS.

## Delivery

- Change-set: `admin-direct/changes/task-issue-suyazov-barella-ru-622.json` —
  root keys ровно `schema_version/ops/verify`; два op `update_page`
  (page_id 3327 и 3328, только ключ `content`); `verify.checks` для
  `/o-kompanii/` и `/obekty/` с required-текстами
  `Давайте обсудим ваш проект`, `Получить бесплатную консультацию`,
  `wpcf7-f3334-p3327`/`wpcf7-f3334-p3328`, `padding:24px 32px 20px`
  и absent-текстами `Internal Server Error`, `barella.sy3.ru`.
- Контент собран из актуального live post_content обеих страниц (прочитан
  перед write через WP REST API): 3327 совпадает с change-set TASK-600
  (плюс https-фикс 4 team-фото), 3328 — с change-set TASK-609. Изменён
  только блок CSS-правил `.bf-cta` (byte-identical замена на обеих
  страницах), остальной контент не тронут.
- Перед записью Bridge Connector делает snapshot затрагиваемых страниц; при
  любом apply/live-verify failure выполняется штатный rollback (snapshot
  restore) по регламенту §21.4. Executor прямой записи в production не делает.

## Acceptance

- На `/o-kompanii/` и `/obekty/` ровно одна CF7 форма id 3334; присутствуют
  точные тексты `Давайте обсудим ваш проект` и
  `Получить бесплатную консультацию`; отсутствует `Internal Server Error`.
- На `/obekty/` присутствует точный текст `Наши объекты`, ровно 10 карточек
  объектов, все href/image src сохранены.
- CSS обеих страниц содержит одинаковые compact tokens:
  `padding:24px 32px 20px`, `min-height:0`, input/button `height:44px`,
  desktop row layout (grid).

## Checks executor'а

- JSON change-set валиден (parse OK); root keys ровно
  `schema_version/ops/verify`; оба op — `update_page` с ключами только
  `type/page_id/content`.
- Контрольные assert'ы при сборке: shortcode id=3334 ровно один на странице;
  compact tokens присутствуют; старые `padding:40px 44px`/`height:52px`
  удалены; `.bf-cta` CSS-блоки на 3327 и 3328 идентичны; 10 card href и
  10 img src на 3328 совпадают с live; `barella.sy3.ru` отсутствует.
- PHP-файлы не менялись (PHP lint неприменим); `git diff --check` — чисто.
