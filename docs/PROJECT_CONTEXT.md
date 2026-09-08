# Barella — PROJECT_CONTEXT

> Канонический handoff-контекст проекта для восстановления работы в новом ChatGPT-чате после удаления старого диалога.
>
> Последний ручной read-back перед записью: **2026-09-08 22:25 +03**.
> Этот файл — навигационный контекст, а не замена live Bridge/Task Controller state. Перед любым новым действием обязательно делать fresh read-back текущего `suyazov/bridge-sy9`, текущего command plane и live GitHub state.

## 1. Идентичность проекта

- `project_id`: `barella.ru`
- Клиентский production: `https://barella.pro/`
- Репозиторий проекта: `suyazov/barella.ru`
- Оркестрация / control plane: `suyazov/bridge-sy9`
- CMS: WordPress
- Подтверждённый production write-path в истории проекта: `wordpress-admin-direct` / Bridge Connector
- Защищённые клиентские credentials существуют и должны **сохраняться**, не печататься, не переноситься и не удаляться ad-hoc действиями.
- Клиентский production и публичный DNS нельзя менять вне явно авторизованного bounded task lifecycle.

## 2. Что было сделано по проекту

Проект был коммерчески сдан клиенту. В ходе проекта были реализованы и доведены до production:

- страницы «О компании», «Объекты», «Контакты»;
- каталог объектов и отдельные страницы объектов;
- реальные фотографии объектов;
- фирменная палитра и UI-доводка;
- формы Contact Form 7, получатели заявок и хранение заявок;
- honeypot-антиспам;
- рабочие CTA / popup-поведение;
- header/footer navigation;
- фотографии специалистов на «О компании»;
- финальные production corrections после ручных визуальных reject/acceptance.

Основной production сейчас — `barella.pro`. Исторический staging `barella.sy3.ru` больше не является рабочим окружением.

## 3. Operational closeout и очистка сервера

Канонический closeout: `suyazov/bridge-sy9#944`.

Результат closeout:

- проект был `OPERATIONALLY_CLOSED`;
- выполнен `COLD_ARCHIVED`;
- Bridge-managed checkout/worktrees/bare mirrors удалены;
- staging `barella.sy3.ru` позднее полностью retired;
- staging webroot, nginx vhost, active DB, TLS и logs выведены из эксплуатации через scoped retirement;
- customer credentials сохранены;
- GitHub/AFFiNE/Portfolio/history сохранены;
- `barella.pro` и публичный DNS не менялись в рамках closeout;
- `production_touched=false` для closeout.

Исторический staging **не воссоздавать автоматически** только потому, что появилась новая правка. Для будущих corrections использовать текущий безопасный capability/command plane после fresh read-back.

## 4. Portfolio

Кейс Barella был опубликован и read-back подтверждён в AFFiNE.

Исторические идентификаторы:

- portfolio Markdown: `affine/portfolio/Portfolio/Barella — корпоративный сайт инженерной компании на WordPress.md`
- AFFiNE docId: `QeA_rl4kGm`
- Portfolio row: `IYWXE_R4CK`
- source-sync commit: `b7de1c59a49a73954c8cb0257e590a09aba9221b`

Не удалять Portfolio/AFFiNE/GitHub history при гарантийных правках.

## 5. Критичный открытый бизнес-вопрос после сдачи

После сдачи клиент сообщил:

> При редактировании `https://barella.pro/o-kompanii/` — даже простой замене фото или изменении текста — «едет» вся вёрстка.

Подтверждённая причина: production page `page_id=3327` исторически собиралась через большой raw-HTML фрагмент со встроенным `<style>` и связанными `.bf-*` grid/card классами. Обычный WordPress visual/content editor может переписать внутреннюю разметку, после чего CSS-сетка ломается.

Это считается **гарантийным дефектом поддерживаемости нашей реализации**, а не ошибкой клиента.

### Требуемый бизнес-результат

Сделать `/o-kompanii/` безопасно редактируемой клиентом из штатной WordPress/Elementor UI:

- обычный текст меняется без ручного HTML;
- заголовки/описания редактируются штатно;
- 4 карточки специалистов имеют независимо редактируемые image/name/role values;
- замена фото через Media Library не меняет геометрию карточек/сетки;
- layout CSS отделён от бизнес-контента и не может случайно исчезнуть при обычном редактировании;
- сохранить текущий публичный внешний вид, тексты, четыре личности и их порядок;
- сохранить CF7 `#3334`, CTA, header/footer/menu, формы, mail/storage/honeypot и остальные страницы;
- не ставить новый plugin без доказанного capability gap;
- все production writes только через bounded adapter со snapshot/read-back/rollback;
- acceptance должен включать обратимый тест: изменить текст + заменить одно фото существующим Media Library image, проверить layout, затем вернуть исходные значения и доказать restoration;
- поскольку это customer-editing UX, финальная приёмка должна требовать owner/client acceptance.

## 6. История гарантийной коррекции

### Reopen

Issue: `suyazov/bridge-sy9#1009`.

Проект был корректно reopened:

- `ACTIVE generation: 2`
- reopen receipt SHA-256: `73947f6c7724e376fca79fb8b4283b634e81441cd46607228d3bb5eefac44b62`
- предыдущий closure receipt: `3f8762e987368b15cb4598b4af29ee269adc45966b576f098d3b981c1b9f4e03`
- `production_touched=false`

Позднее #1009 был закрыт при системном Task Controller cutover. Он теперь только историческое evidence, не текущий executable command.

### Legacy Project Task #1013

Issue: `suyazov/bridge-sy9#1013`

Task:

- `TASK-ISSUE-SUYAZOV_BARELLA.RU-1013`
- orchestration: `d5dc94646ed7707cda2d6745`

История:

1. Первичный intake был rejected с `PROJECT_NOT_ORCHESTRATION_READY`.
2. После исправления convergence тот же Issue был принят.
3. Оркестрация дошла до `READY_FOR_MERGE`.
4. Был создан PR `suyazov/barella.ru#44`, head `259678c34c9ec6283f7f890d8e1d29bc5a1a3d23`.
5. **PR #44 на fresh read-back 2026-09-08 остаётся OPEN и UNMERGED.**
6. 2026-09-01 Issue #1013 был закрыт при unified Task Controller cutover с явной формулировкой: это **не claim business completion**; legacy Issue больше нельзя продолжать/retry, а всё ещё нужный результат следует восстановить из current project context и отправить через текущий command plane.

Следовательно: **гарантийная правка НЕ считается завершённой.** Нельзя ссылаться на closed #1013 как на `VERIFIED_DONE`.

## 7. PR #44 — важное предупреждение

PR: `suyazov/barella.ru#44`

Fresh state 2026-09-08:

- state: `open`
- merged: `false`
- mergeable: `true`
- head: `259678c34c9ec6283f7f890d8e1d29bc5a1a3d23`

PR был подготовлен под legacy task и сам в body заявляет, что production write не выполнялся и что Bridge должен был сделать snapshot/apply/read-back/owner acceptance.

Кроме того, его реализация всё ещё содержит большой page-content blob со встроенным `<style>`. Поэтому перед использованием PR #44 через новый command plane обязательно заново проверить, действительно ли он достигает бизнес-цели «клиент может безопасно редактировать обычный текст и фото через штатный UI». Не мерджить автоматически только потому, что старый review gate когда-то прошёл.

## 8. CURRENT STATUS на момент handoff

Неформальная project-level проекция для нового чата:

- commercial delivery: `DONE`
- operational closeout history: `DONE`
- server cleanup / staging retirement: `DONE`
- project reopened generation 2: `DONE`
- warranty editability correction: **UNRESOLVED**
- legacy #1013: `RETIRED_PROJECTION`, не executable
- PR #44: `OPEN_UNMERGED`
- confirmed production deployment of warranty fix: **NO EVIDENCE**
- client/owner acceptance of warranty fix: **NO EVIDENCE**

## 9. Что делать в новом чате

Новый чат должен начать с команды примерно такого смысла:

> Работаем по `suyazov/barella.ru/docs/PROJECT_CONTEXT.md` как handoff, но live GitHub/Bridge Task Controller является источником истины. Сделай fresh read-back current main `suyazov/bridge-sy9`, текущего command plane, project runtime/readiness, PR #44 и production state. Не продолжай retired #1013. Если проблема редактируемости `/o-kompanii/` всё ещё актуальна, подай один новый текущий command/task через актуальный Task Controller, используй старый PR #44 только если current adoption/review докажет, что его scope действительно решает бизнес-проблему; иначе подготовь корректную реализацию. Production менять только bounded path со snapshot/read-back/rollback. Финал — owner acceptance.

## 10. Truth / safety rules

При любом продолжении:

1. Fresh live Task Controller / Bridge state важнее этого файла.
2. Retired legacy Issues (#1009/#1013) — историческое evidence, не текущая команда.
3. Не создавать дублирующий task, пока current command plane не проверен на уже существующий active scope.
4. Не считать PR/merge техническим завершением без production delivery/read-back и требуемой owner acceptance.
5. Не трогать `barella.pro`, DNS, credentials или другие страницы вне bounded warranty scope.
6. Не воссоздавать `barella.sy3.ru` без отдельной необходимости/разрешённого capability.
7. Не удалять GitHub/AFFiNE/Portfolio/history/receipts.
8. Credentials retained; никогда не помещать секретные значения в GitHub или чат.

## 11. Ключевые ссылки / идентификаторы

- Project repo: `suyazov/barella.ru`
- Bridge repo: `suyazov/bridge-sy9`
- Production: `https://barella.pro/`
- Problem page: `https://barella.pro/o-kompanii/`
- Operational closeout: `suyazov/bridge-sy9#944`
- Warranty reopen historical: `suyazov/bridge-sy9#1009`
- Reopen intake defect historical: `suyazov/bridge-sy9#1010`
- Warranty legacy task historical: `suyazov/bridge-sy9#1013`
- Warranty implementation PR candidate: `suyazov/barella.ru#44`
- Legacy orchestration: `d5dc94646ed7707cda2d6745`

---

### Short handoff

**Barella коммерчески сдан и серверные остатки/staging очищены. После сдачи выявлен гарантийный дефект: `/o-kompanii/` ломает layout при обычном редактировании текста/фото. Проект reopened, legacy task #1013 дошёл до PR #44, но Task Controller cutover закрыл legacy Issue без business-completion claim. На 2026-09-08 PR #44 всё ещё open/unmerged и production deployment/owner acceptance не доказаны. В новом чате делать fresh read-back текущего Task Controller и продолжать этот warranty outcome через актуальный command plane; retired #1013 не продолжать.**
