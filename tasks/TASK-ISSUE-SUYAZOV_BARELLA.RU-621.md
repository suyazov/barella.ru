# TASK-ISSUE-SUYAZOV_BARELLA.RU-621 — Завершающий этап устранения mixed content на barella

## Identity

- Project: barella.ru
- Repository: suyazov/barella.ru
- Environment: barella.sy3.ru-staging
- Task ID: TASK-ISSUE-SUYAZOV_BARELLA.RU-621
- AFFiNE Row ID: PGZsioKZ1g
- Production target: `https://barella.pro/` (Bridge `wp-admin-direct`, regulation §21.4)

## Scope

Завершающий этап устранения mixed content на barella.pro (после #604 адреса
WordPress уже на https): в WP Font Library у 18 font face постов семейства
SF Pro Display (`wp_font_face`, ids 3235 3236 3237 3238 3239 3240 3241 3242
3243 3244 3245 3246 3247 3248 3249 3250 3251 3252) в `font_face_settings`
JSON хранится `src` с absolute `http://barella.pro` URL — браузер запрашивает
эти шрифты по http и блокирует их. Требуется ровно один change-set contract
v1.5 с одним op `replace_site_url`:

- `old_url` — `http://barella.pro`
- `new_url` — `https://barella.pro`
- `posts` — ровно 18 ids 3235..3252 (семейство 3234 не трогать — src хранят
  только faces)
- `options` не указывать

Больше ничего не меняется: тексты, структура, шаблоны, меню, другие опции и
посты. Других op в change-set нет.

## Delivery

- Change-set: `admin-direct/changes/task-issue-suyazov-barella-ru-621.json` —
  root keys ровно `schema_version/ops/verify`; один op `replace_site_url`
  (`old_url` http, `new_url` https, `posts` = 18 ids 3235..3252); три
  `verify.checks` (`/`, `/obekty/`, `/kontakty/`) с required-текстами
  `barella`, `Наши объекты`, `Контакты`.
- Перед записью Bridge Connector делает snapshot затрагиваемых постов; при
  любом apply/live-verify failure выполняется штатный rollback (snapshot
  restore) по регламенту §21.4. Executor прямой записи в production не делает.
- Итоговую проверку исходной разметки страниц (блок `@font-face` семейства
  SF Pro Display ссылается только на `https://barella.pro` URLs) выполняет
  оператор после доставки.

## Acceptance

- В исходной разметке страниц сайта блок `@font-face` семейства SF Pro Display
  ссылается только на `https://barella.pro` URLs; проверку разметки выполняет
  оператор после доставки.
- Live acceptance: `/`, `/obekty/`, `/kontakty/` содержат точные видимые
  тексты `barella`, `Наши объекты`, `Контакты`.

## Checks executor'а

- JSON change-set валиден (parse OK); root keys ровно
  `schema_version/ops/verify`; ровно 1 op с ключами только
  `type/old_url/new_url/posts`; `posts` — ровно 18 ids 3235..3252, без
  `options`.
- PHP-файлы не менялись (PHP lint неприменим); `git diff --check` — чисто.
