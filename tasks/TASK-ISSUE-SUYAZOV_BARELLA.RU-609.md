# TASK-ISSUE-SUYAZOV_BARELLA.RU-609 — Выполнить bounded correction после ручной проверки владельцем результата Issue #600 на текущем wordpress-admin-direct са

## Identity

- Project: barella.ru
- Repository: suyazov/barella.ru
- Environment: barella.sy3.ru-staging
- Task ID: TASK-ISSUE-SUYAZOV_BARELLA.RU-609
- AFFiNE Task ID: TASK-ISSUE-SUYAZOV_BARELLA.RU-609
- AFFiNE Row ID: nIF7O8oqDM
- Source SHA: 67cf8ceeaacfeb39f63e58a81a4c065727a5cfcb
- Task file: tasks/TASK-ISSUE-SUYAZOV_BARELLA.RU-609.md

## Scope

Выполнить bounded correction после ручной проверки владельцем результата Issue #600 на текущем wordpress-admin-direct сайте https://barella.pro/. Менять только page_id 3329 `/kontakty/` и page_id 3328 `/obekty/`; page_id 3327 `/o-kompanii/` сначала прочитать только как канонический источник текущего компонента формы, но не изменять. Перед write прочитать актуальные live states 3327/3328/3329, затем connector snapshot 3328 и 3329; rollback при apply/live-verify failure. 1) `/kontakty/`: сохранить текущую рабочую CF7 форму (использовать фактически прочитанный текущий shortcode) ровно один раз, не менять backend/recipients. Заголовок form-card заменить с `ОСТАВЬТЕ ЗАЯВКУ` на `Оставьте заявку`; для heading CSS задать `text-transform:none`, `font-size:26px` desktop и `22px` при max-width 600px, сохранив текущий font-weight и цвет. Подзаголовок оставить тем же по смыслу и в markup зафиксировать три отдельные строки через явные `<span>`/`<br>`: `и мы перезвоним вам в кратчайшее время` / `и проконсультируем по всем` / `вашим вопросам`. Controls обернуть в отдельный inner wrapper с CSS `max-width:360px;width:100%;margin-left:0;margin-right:auto`; name, phone, submit и consent должны находиться внутри этого wrapper. Кнопка сохраняет `#870001` и белый текст. Остальную структуру контактов и карту не менять. 2) `/obekty/`: текущий нижний CTA без формы заменить на тот же form-component, который фактически сейчас используется на `/o-kompanii/`: прочитать page 3327 и переиспользовать текущие заголовок `Давайте обсудим ваш проект`, описание, рабочий CF7 shortcode, порядок name → phone → consent → submit и scoped component styles. Не копировать stale markup из репозитория — источник именно live page 3327. На `/obekty/` должна появиться ровно одна рабочая форма с тем же CF7 id, что на live `/o-kompanii/`; form backend/recipients не менять. Сохранить каталог ровно из 10 карточек, все фото, тексты, ссылки и сетку 3+3+3+1 desktop / 2 tablet / 1 mobile; менять только нижний CTA/form component. Не менять header/footer/menu, object detail pages, глобальные options, media, DNS или другие страницы. Post-apply contract: `/kontakty/` содержит ровно один CF7 shortcode, текст `Оставьте заявку`, не содержит `ОСТАВЬТЕ ЗАЯВКУ`, содержит CSS/markup contract `max-width:360px` для controls wrapper и три строки подзаголовка; `/obekty/` содержит ровно 10 catalog cards и ровно один CF7 shortcode с тем же id, что live `/o-kompanii/`, а все 10 существующих object href и image src сохранены. Обычная content/CSS/contract verification достаточна для lifecycle этой Issue; отдельный Browser Visual Acceptance baseline не требуется.

## Acceptance criteria

- Выполнить bounded correction после ручной проверки владельцем результата Issue #600 на текущем wordpress-admin-direct сайте https://barella.pro/. Менять только page_id 3329 `/kontakty/` и page_id 3328 `/obekty/`; page_id 3327 `/o-kompanii/` сначала прочитать только как канонический источник текущего компонента формы, но не изменять. Перед write прочитать актуальные live states 3327/3328/3329, затем connector snapshot 3328 и 3329; rollback при apply/live-verify failure. 1) `/kontakty/`: сохранить текущую рабочую CF7 форму (использовать фактически прочитанный текущий shortcode) ровно один раз, не менять backend/recipients. Заголовок form-card заменить с `ОСТАВЬТЕ ЗАЯВКУ` на `Оставьте заявку`; для heading CSS задать `text-transform:none`, `font-size:26px` desktop и `22px` при max-width 600px, сохранив текущий font-weight и цвет. Подзаголовок оставить тем же по смыслу и в markup зафиксировать три отдельные строки через явные `<span>`/`<br>`: `и мы перезвоним вам в кратчайшее время` / `и проконсультируем по всем` / `вашим вопросам`. Controls обернуть в отдельный inner wrapper с CSS `max-width:360px;width:100%;margin-left:0;margin-right:auto`; name, phone, submit и consent должны находиться внутри этого wrapper. Кнопка сохраняет `#870001` и белый текст. Остальную структуру контактов и карту не менять. 2) `/obekty/`: текущий нижний CTA без формы заменить на тот же form-component, который фактически сейчас используется на `/o-kompanii/`: прочитать page 3327 и переиспользовать текущие заголовок `Давайте обсудим ваш проект`, описание, рабочий CF7 shortcode, порядок name → phone → consent → submit и scoped component styles. Не копировать stale markup из репозитория — источник именно live page 3327. На `/obekty/` должна появиться ровно одна рабочая форма с тем же CF7 id, что на live `/o-kompanii/`; form backend/recipients не менять. Сохранить каталог ровно из 10 карточек, все фото, тексты, ссылки и сетку 3+3+3+1 desktop / 2 tablet / 1 mobile; менять только нижний CTA/form component. Не менять header/footer/menu, object detail pages, глобальные options, media, DNS или другие страницы. Post-apply contract: `/kontakty/` содержит ровно один CF7 shortcode, текст `Оставьте заявку`, не содержит `ОСТАВЬТЕ ЗАЯВКУ`, содержит CSS/markup contract `max-width:360px` для controls wrapper и три строки подзаголовка; `/obekty/` содержит ровно 10 catalog cards и ровно один CF7 shortcode с тем же id, что live `/o-kompanii/`, а все 10 существующих object href и image src сохранены. Обычная content/CSS/contract verification достаточна для lifecycle этой Issue; отдельный Browser Visual Acceptance baseline не требуется.
- Live acceptance for /kontakty/ requires exact visible text: Контакты
Do not paraphrase, rename, translate, or replace this text.
- Live acceptance for /kontakty/ requires exact visible text: Оставьте заявку
Do not paraphrase, rename, translate, or replace this text.
- Live acceptance for /kontakty/ requires exact visible text: Москва, Варшавское шоссе, 1с1-2
Do not paraphrase, rename, translate, or replace this text.
- Live acceptance for /kontakty/ requires this exact text to be absent: ОСТАВЬТЕ ЗАЯВКУ
Remove it from the route and do not add it anywhere else on the route.
- Live acceptance for /kontakty/ requires this exact text to be absent: Internal Server Error
Remove it from the route and do not add it anywhere else on the route.
- Live acceptance for /obekty/ requires exact visible text: Наши объекты
Do not paraphrase, rename, translate, or replace this text.
- Live acceptance for /obekty/ requires exact visible text: Давайте обсудим ваш проект
Do not paraphrase, rename, translate, or replace this text.
- Live acceptance for /obekty/ requires exact visible text: Получить бесплатную консультацию
Do not paraphrase, rename, translate, or replace this text.
- Live acceptance for /obekty/ requires this exact text to be absent: Internal Server Error
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
  "task_file": "tasks/TASK-ISSUE-SUYAZOV_BARELLA.RU-609.md",
  "task_id": "TASK-ISSUE-SUYAZOV_BARELLA.RU-609",
  "source_sha": "67cf8ceeaacfeb39f63e58a81a4c065727a5cfcb",
  "affine_task_id": "TASK-ISSUE-SUYAZOV_BARELLA.RU-609",
  "affine_row_id": "nIF7O8oqDM"
}
```
