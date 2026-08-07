# TASK-ISSUE-SUYAZOV_BARELLA.RU-566 — Срочная production correction после ручной визуальной приёмки владельцем

## Identity

- Project: barella.ru
- Repository: suyazov/barella.ru
- Environment: barella.sy3.ru-staging
- Task ID: TASK-ISSUE-SUYAZOV_BARELLA.RU-566
- AFFiNE Task ID: TASK-ISSUE-SUYAZOV_BARELLA.RU-566
- AFFiNE Row ID: uv9oZ1ANVi
- Source SHA: 599e49929b2d39bc91821681d5b17446723886a7
- Task file: tasks/TASK-ISSUE-SUYAZOV_BARELLA.RU-566.md

## Scope

Срочная production correction после ручной визуальной приёмки владельцем. Исправить ТОЛЬКО страницу каталога https://barella.pro/obekty/ через активный wordpress-admin-direct / Bridge Connector; страницы 10 отдельных объектов, включая /obekty/svetlana/, не менять — текущий шаблон страницы объекта визуально принят. Перед write обязательно connector snapshot страницы каталога и штатный rollback при любом apply/live-verify failure. Текущие production-дефекты /obekty/, подтверждённые свежим full-page screenshot владельца: (1) shell/header визуально продублирован — итоговый DOM страницы должен использовать только header/nav/footer клиентской WordPress-темы; page content НЕ должен содержать собственные html/body/header/nav/footer копии или второй site header; browser DOM QA: один видимый site header/nav shell; (2) каталог развален: карточки идут left/right/center с гигантскими пустыми вертикальными зонами вместо компактной сетки. В page content должен быть ровно один catalog grid, его непосредственные children — ровно 10 object cards без spacer/empty/grid-position wrappers. Desktop >=1100: строго 3 равные колонки repeat(3,minmax(0,1fr)), нормальный gap около 20-28px, порядок карточек source-order слева направо/сверху вниз, без grid-column, nth-child positioning, justify-self:center, фиксированных координат и искусственных пустых рядов; tablet 2 колонки; mobile 1. Все 10 cards должны иметь одинаковую структуру и визуальную ширину; card body flex-column, CTA/link внизу карточки, изображения фиксированного 4:3 ratio с width/height 100%, object-fit:cover, без placeholder-зон. (3) У карточек «Чистое помещение для 2-й пакетной линии» и «Энергоцентр для 1-й очереди комплексной застройки территории АО „Рублево-Архангельское“» сейчас пустые/серые обложки, хотя реальные production-фото уже существуют на их отдельных страницах. Не загружать новые случайные файлы: прочитать соответствующие production object pages через Connector/anonymous read, взять первый корректный barella.pro/wp-content/uploads image URL каждого объекта и использовать его как cover; проверить HTTP 200. Сохранить все 10 названий, city/scope, ссылки на текущие отдельные URL и существующие working cover images остальных 8 карточек. Не менять тексты/контент object pages, /o-kompanii/, /kontakty/, menu, формы, footer, global WP options, DNS или media library. CSS для каталога должен быть строго scoped под page/catalog wrapper, чтобы не влиять на другие страницы. Обязательный browser QA на production после apply: viewport 1440 — compact rows 3+3+3+1 без больших blank gaps; viewport 390 — одна колонка без horizontal overflow; ровно 10 cards; один header shell; все 10 cover images HTTP 200; все 10 card links HTTP 200; console errors=0. Если невозможно добиться этого одной update_page операцией без затрагивания global theme/options, завершить точным BLOCKED до write и не ухудшать production.

## Acceptance criteria

- Срочная production correction после ручной визуальной приёмки владельцем. Исправить ТОЛЬКО страницу каталога https://barella.pro/obekty/ через активный wordpress-admin-direct / Bridge Connector; страницы 10 отдельных объектов, включая /obekty/svetlana/, не менять — текущий шаблон страницы объекта визуально принят. Перед write обязательно connector snapshot страницы каталога и штатный rollback при любом apply/live-verify failure. Текущие production-дефекты /obekty/, подтверждённые свежим full-page screenshot владельца: (1) shell/header визуально продублирован — итоговый DOM страницы должен использовать только header/nav/footer клиентской WordPress-темы; page content НЕ должен содержать собственные html/body/header/nav/footer копии или второй site header; browser DOM QA: один видимый site header/nav shell; (2) каталог развален: карточки идут left/right/center с гигантскими пустыми вертикальными зонами вместо компактной сетки. В page content должен быть ровно один catalog grid, его непосредственные children — ровно 10 object cards без spacer/empty/grid-position wrappers. Desktop >=1100: строго 3 равные колонки repeat(3,minmax(0,1fr)), нормальный gap около 20-28px, порядок карточек source-order слева направо/сверху вниз, без grid-column, nth-child positioning, justify-self:center, фиксированных координат и искусственных пустых рядов; tablet 2 колонки; mobile 1. Все 10 cards должны иметь одинаковую структуру и визуальную ширину; card body flex-column, CTA/link внизу карточки, изображения фиксированного 4:3 ratio с width/height 100%, object-fit:cover, без placeholder-зон. (3) У карточек «Чистое помещение для 2-й пакетной линии» и «Энергоцентр для 1-й очереди комплексной застройки территории АО „Рублево-Архангельское“» сейчас пустые/серые обложки, хотя реальные production-фото уже существуют на их отдельных страницах. Не загружать новые случайные файлы: прочитать соответствующие production object pages через Connector/anonymous read, взять первый корректный barella.pro/wp-content/uploads image URL каждого объекта и использовать его как cover; проверить HTTP 200. Сохранить все 10 названий, city/scope, ссылки на текущие отдельные URL и существующие working cover images остальных 8 карточек. Не менять тексты/контент object pages, /o-kompanii/, /kontakty/, menu, формы, footer, global WP options, DNS или media library. CSS для каталога должен быть строго scoped под page/catalog wrapper, чтобы не влиять на другие страницы. Обязательный browser QA на production после apply: viewport 1440 — compact rows 3+3+3+1 без больших blank gaps; viewport 390 — одна колонка без horizontal overflow; ровно 10 cards; один header shell; все 10 cover images HTTP 200; все 10 card links HTTP 200; console errors=0. Если невозможно добиться этого одной update_page операцией без затрагивания global theme/options, завершить точным BLOCKED до write и не ухудшать production.
- Live acceptance for /obekty/ requires exact visible text: Наши объекты
Do not paraphrase, rename, translate, or replace this text.
- Live acceptance for /obekty/ requires exact visible text: Чистое помещение для 2-й пакетной линии
Do not paraphrase, rename, translate, or replace this text.
- Live acceptance for /obekty/ requires exact visible text: Энергоцентр для 1-й очереди комплексной застройки территории АО «Рублево-Архангельское»
Do not paraphrase, rename, translate, or replace this text.
- Live acceptance for /obekty/ requires exact visible text: Подробнее об объекте
Do not paraphrase, rename, translate, or replace this text.
- Live acceptance for /obekty/ requires this exact text to be absent: Фото объекта — добавляется отдельной задачей оператора
Remove it from the route and do not add it anywhere else on the route.
- Change only: admin-direct/changes/**, docs/**, tasks/**, README.md, AGENTS.md.
- Do not change WordPress core, uploads, credentials, database, Bridge, production, or deployment configuration.
- Run PHP lint for changed PHP files and git diff --check.
- Open exactly one pull request against main.
- Report a bounded context_delta object in the result receipt with the fields result, decisions, current_status, constraints, next_step: short plain-text summary of what changed and why. Never include secrets, credentials, tokens or log dumps.

## Canonical evidence

```json
{
  "source": "bridge_orchestration_controller",
  "verified": true,
  "repository": "suyazov/barella.ru",
  "task_file": "tasks/TASK-ISSUE-SUYAZOV_BARELLA.RU-566.md",
  "task_id": "TASK-ISSUE-SUYAZOV_BARELLA.RU-566",
  "source_sha": "599e49929b2d39bc91821681d5b17446723886a7",
  "affine_task_id": "TASK-ISSUE-SUYAZOV_BARELLA.RU-566",
  "affine_row_id": "uv9oZ1ANVi"
}
```
