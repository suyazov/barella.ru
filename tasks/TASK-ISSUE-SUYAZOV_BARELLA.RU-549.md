# TASK-ISSUE-SUYAZOV_BARELLA.RU-549 — Визуальная correction-задача: каталог /obekty/ и шаблон страницы объекта (staging)

Канонический источник требований: `.bridge-context/TASK.md` (immutable context bundle, loop `dfccbbcb0a3126f60f54eecd`, generation 1). Исполнение — managed Kimi handoff после `CODEX_USAGE_LIMIT_REACHED` у managed Codex.

## Что реализовано

Структура после VERIFIED_DONE Issue #538 сохранена (10 объектов, 10 отдельных URL, тексты из `docs/requirements-objects-v2.md`, canonical slugs из `docs/object-page-slugs-v2.md`, собственные фото каждого объекта). Полностью переделано визуальное представление:

- `template-obekt.php` — единый reusable шаблон всех 10 страниц объектов:
  - контентный контейнер 1200 px на desktop (`.container` в `style.css`);
  - breadcrumb «Все объекты» → `/obekty/`;
  - H1 с контролируемой шириной (`max-width: 900px`) и переносами;
  - компактная мета-строка: город и предмет работ пилюлями (`.hero__meta`);
  - структурированный информационный блок Адрес / Заказчик / Предмет работ — три карточки с синей верхней кромкой и ясной иерархией label → значение (`.object-info`), вместо серых системных карточек;
  - «Выполненные работы» — читаемый двухколоночный checklist с маркерами-галочками на desktop, одна колонка на mobile (`.object-works__list`);
  - фотогалерея — единая сетка одинаковых карточек без masonry и без огромной первой фотографии: все фото объекта (включая бывшую обложку), desktop 3 колонки, tablet 2, mobile 1, единый `aspect-ratio: 4/3`, `object-fit: cover`, одинаковые radius 10px/gap 16px (`.object-gallery`);
  - ссылка «← Все объекты» под галереей сохранена.
- `template-obekty.php` — каталог: ровно 10 карточек, сетка 3→2→1, одинаковые обложки 4:3 `object-fit: cover`, title/city/scope, явный hover и `:focus-visible`, ссылка на отдельную страницу. Структура шаблона не менялась, визуал доведён в `style.css`.
- CTA «Давайте обсудим ваш проект» визуально интегрирован: padding 72px, читаемая типографика (h2 32px, lead 18px), заметная брендовая кнопка (`.btn--light`, padding 16×34). Форм и их логики на этих маршрутах нет — обработчик `barella_feedback` не тронут.
- Версия темы поднята до 0.2.0 (cache-busting для `style.css?ver=`).

Все исходные фото каждого объекта сохранены (дубль Retinoidy `04.jpg` по-прежнему не публикуется), alt-тексты не изменены. Тексты объектов, адреса, заказчики, состав работ, slugs, количество страниц, страницы «О компании»/«Контакты», меню, логика форм — без изменений.

## Запреты (соблюдены)

Production barella.pro, DNS, секреты, WordPress core, uploads, БД, Bridge и deployment-конфигурация не затрагивались. Изменения только в `wordpress/wp-content/themes/barella/**`, `acceptance/visual/**`, `docs/**`, `tasks/**`. Staging-деплой — копирование двух изменённых файлов темы в `/var/www/barella.sy3.ru/wp-content/themes/barella/` (тот же механизм, что у адаптера wordpress-theme-staging).

## QA

- `php -l` по изменённым PHP — без ошибок; `git diff --check` — чисто.
- Все 11 маршрутов (`/obekty/` + 10 объектов) — HTTP 200 на 1440px и 390px.
- Все изображения на всех маршрутах — HTTP 200; console errors = 0; horizontal overflow = 0.
- Browser screenshots 1440px и 390px: `/obekty/`, `/obekty/svetlana/`, `/obekty/vertical/`, `/obekty/pskov-proizvodstvennye-linii/` (разное количество и ориентация фото) — в `acceptance/visual/`.
- Визуально подтверждено: нет огромной leading photo, белых пустот, masonry-разрывов, горизонтального скролла; CTA без дефолтных контролов.
