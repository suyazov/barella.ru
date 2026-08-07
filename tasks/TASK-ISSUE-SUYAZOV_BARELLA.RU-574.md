# TASK-ISSUE-SUYAZOV_BARELLA.RU-574 — Correction после browser-проверки владельцем результата #573 (PR suyazov/barella

## Identity

- Project: barella.ru
- Repository: suyazov/barella.ru
- Environment: barella.sy3.ru-staging
- Task ID: TASK-ISSUE-SUYAZOV_BARELLA.RU-574
- AFFiNE Task ID: TASK-ISSUE-SUYAZOV_BARELLA.RU-574
- AFFiNE Row ID: PU_vcYCP0V
- Source SHA: 39b09f0bbc678008c8c250a6d3b686a3860d0b96
- Task file: tasks/TASK-ISSUE-SUYAZOV_BARELLA.RU-574.md

## Scope

Correction после browser-проверки владельцем результата #573 (PR suyazov/barella.ru#11, merge 39b09f0bbc678008c8c250a6d3b686a3860d0b96, VERIFIED_DONE): flex-layout #barella-catalog-v2 и дизайн карточек приняты, но wpautop (the_content filter) вставил <br /> между карточками и внутри них; каждый такой <br> стал flex-элементом, удвоил gap до 48px и сбил сетку до 2 колонок при viewport 1440 (замерено computed: container width=1100, card width=350.66px, расстояние между соседними карточками 48px вместо 24px; rows 2+2+2+2+2). Исправить ТОЛЬКО production page_id 3328 /obekty/ одним declarative update_page change-set текущего wordpress-admin-direct; 10 отдельных object pages не менять. Тот же layout #barella-catalog-v2 и тот же принятый дизайн карточек из admin-direct/changes/task-issue-suyazov-barella-ru-573.json, но post_content сериализовать одной строкой без переводов строк между элементами, чтобы wpautop не имел возможности вставить <br>/<p>; дополнительно добавить защитное правило `#barella-catalog-v2 .bcv2-cards>br,#barella-catalog-v2 .bcv2-card br{display:none!important}`. Перед write обязателен connector snapshot и штатный rollback при любом apply/live-verify failure. Browser DOM QA после записи непосредственно на https://barella.pro/obekty/: children .bcv2-cards — ровно 10 элементов .bcv2-card без br/p siblings; viewport 1440 — ровно 4 ряда 3+3+3+1, расстояние между соседними карточками ровно 24px, горизонтальный overflow=0; viewport 768 — 2 колонки; viewport 390 — 1 колонка; все 10 img complete=true и naturalWidth>0; ровно один site header; console errors=0. Не считать готовым при 2 колонках на desktop даже при HTTP 200 и совпадении текстов.

## Acceptance criteria

- Correction после browser-проверки владельцем результата #573 (PR suyazov/barella.ru#11, merge 39b09f0bbc678008c8c250a6d3b686a3860d0b96, VERIFIED_DONE): flex-layout #barella-catalog-v2 и дизайн карточек приняты, но wpautop (the_content filter) вставил <br /> между карточками и внутри них; каждый такой <br> стал flex-элементом, удвоил gap до 48px и сбил сетку до 2 колонок при viewport 1440 (замерено computed: container width=1100, card width=350.66px, расстояние между соседними карточками 48px вместо 24px; rows 2+2+2+2+2). Исправить ТОЛЬКО production page_id 3328 /obekty/ одним declarative update_page change-set текущего wordpress-admin-direct; 10 отдельных object pages не менять. Тот же layout #barella-catalog-v2 и тот же принятый дизайн карточек из admin-direct/changes/task-issue-suyazov-barella-ru-573.json, но post_content сериализовать одной строкой без переводов строк между элементами, чтобы wpautop не имел возможности вставить <br>/<p>; дополнительно добавить защитное правило `#barella-catalog-v2 .bcv2-cards>br,#barella-catalog-v2 .bcv2-card br{display:none!important}`. Перед write обязателен connector snapshot и штатный rollback при любом apply/live-verify failure. Browser DOM QA после записи непосредственно на https://barella.pro/obekty/: children .bcv2-cards — ровно 10 элементов .bcv2-card без br/p siblings; viewport 1440 — ровно 4 ряда 3+3+3+1, расстояние между соседними карточками ровно 24px, горизонтальный overflow=0; viewport 768 — 2 колонки; viewport 390 — 1 колонка; все 10 img complete=true и naturalWidth>0; ровно один site header; console errors=0. Не считать готовым при 2 колонках на desktop даже при HTTP 200 и совпадении текстов.
- Live acceptance for /obekty/ requires exact visible text: Наши объекты
Do not paraphrase, rename, translate, or replace this text.
- Live acceptance for /obekty/ requires exact visible text: Производственные помещения на территории завода «Светлана»
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
  "task_file": "tasks/TASK-ISSUE-SUYAZOV_BARELLA.RU-574.md",
  "task_id": "TASK-ISSUE-SUYAZOV_BARELLA.RU-574",
  "source_sha": "39b09f0bbc678008c8c250a6d3b686a3860d0b96",
  "affine_task_id": "TASK-ISSUE-SUYAZOV_BARELLA.RU-574",
  "affine_row_id": "PU_vcYCP0V"
}
```

## Delivery

- Change-set: `admin-direct/changes/task-issue-suyazov-barella-ru-574.json` — один op `update_page` page_id 3328 (только production `/obekty/`; 10 отдельных object pages не меняются).
- Тот же layout `#barella-catalog-v2` и тот же принятый дизайн карточек, что и в `admin-direct/changes/task-issue-suyazov-barella-ru-573.json`; изменение одно: `post_content` сериализован одной строкой без переводов строк между элементами, чтобы wpautop (the_content) не мог вставить `<br>`/`<p>`.
- Добавлено защитное правило `#barella-catalog-v2 .bcv2-cards>br,#barella-catalog-v2 .bcv2-card br{display:none!important}`.
- Проверка change-set: JSON валиден, в `content` нет `\n`, ровно 10 `.bcv2-card` и 10 `<img>`, все required-тексты присутствуют, запрещённые тексты (`barella.sy3.ru`, «Фото объекта — добавляется отдельной задачей оператора») отсутствуют.
- Snapshot page 3328 до записи и rollback при apply/live-verify failure выполняются Bridge Connector'ом по регламенту §21.4 (backup → deploy → verify); executor не имеет права прямой записи в production.
- Финальная Browser DOM QA на https://barella.pro/obekty/ (10 cards без br/p siblings, 1440 → 3+3+3+1 с gap 24px, 768 → 2 колонки, 390 → 1 колонка, img complete/naturalWidth>0, один site header, console errors=0) выполняется после merge Bridge'ом/владельцем в рамках post-merge verify.
