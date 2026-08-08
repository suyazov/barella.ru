# TASK-ISSUE-SUYAZOV_BARELLA.RU-576 — Исправить production page `/kontakty/` (page_id 3329)

## Контекст

Production `https://barella.pro/kontakty/` нарушал ТЗ клиента: «Страница Контакты такая же
по структуре и наполнению как https://barella.ru/kontakty». Текущая версия содержала
упрощённый layout (три серые карточки `Адрес / Телефон / Email`, заголовок
`Форма обратной связи`, нижний CTA `Давайте обсудим ваш проект` со второй формой CF7 #3334)
и синие акценты `#0d6efd`.

## Факты, прочитанные с сайтов (2026-08-08)

- `barella.pro/kontakty/` (page_id 3329): две формы CF7 — `wpcf7-f845-p3329` (верхняя) и
  `wpcf7-f3334-p3329` (нижний CTA). Рабочая форма — Contact Form 7 **#845**
  (поля `your-name`, `your-phone`, чекбокс согласия, кнопка `.theme-btn`).
- Референс `barella.ru/kontakty`: двухколоночный layout — слева контакты
  (Адрес: две строки, Телефон: два номера, E-mail, Реквизиты: Скачать), справа карточка
  формы `Оставьте заявку`, под блоком полноширинная Google Maps embed
  (iframe src взят из живого DOM референса, точка — Полюстровский пр. 59, СПб).

## Решение

Один change-set `admin-direct/changes/task-issue-suyazov-barella-ru-576.json`:

- `update_page` page_id 3329, полная замена `content`:
  - заголовок `Контакты` (uppercase);
  - desktop two-column (~45%/~45%), mobile stack;
  - слева контакты с SVG-иконками (#870001): два адреса, два кликабельных телефона,
    `info@barella.ru`, `Реквизиты: Скачать` → канонический PDF на barella.ru
    (новый файл/медиа не создавались);
  - справа белая карточка `ОСТАВЬТЕ ЗАЯВКУ` + подзаголовок + существующий шорткод
    `[contact-form-7 id="845"]` ровно один раз (form backend/получатели не менялись);
  - полноширинный Google Maps iframe (точный src с референса);
  - scoped styles `.bk-*`, палитра #870001 / чёрный / серые / белый, синего нет;
  - удалены: три bf-card, `Форма обратной связи`, CTA `Давайте обсудим ваш проект`,
    вторая форма #3334.
- `verify.checks` на `/kontakty/`: required/absent тексты по acceptance criteria.

## Вне scope

Header/footer/menu, object pages, `/o-kompanii/`, глобальные options, DNS, media library,
другие страницы — не тронуты. Применение на production — только через Bridge Connector
после merge PR (snapshot page 3329 перед write, rollback при failure — на стороне Bridge).
Browser QA на production (1440x1200 / 390x844, screenshots) выполняется после apply
в рамках live-verify Bridge; в этом репозитории live-сайт не изменяется до merge.
