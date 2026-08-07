# Live acceptance — TASK-ISSUE-SUYAZOV_BARELLA.RU-520

Live checks выполняются против staging `https://barella.sy3.ru/` после активации темы `barella`.

| URL | Обязательный видимый текст |
|---|---|
| `/o-kompanii/` | `Барелла — это команда профильных инженеров` |
| `/o-kompanii/` | `Давайте обсудим ваш проект` |
| `/obekty/` | `VERTICAL` |
| `/obekty/` | `Светлана` |
| `/kontakty/` | `Полюстровский` |
| `/kontakty/` | `+7 (921) 416-46-46` |

## Ручная проверка

```bash
curl -fsSL https://barella.sy3.ru/o-kompanii/ | grep -F "Барелла — это команда профильных инженеров"
curl -fsSL https://barella.sy3.ru/o-kompanii/ | grep -F "Давайте обсудим ваш проект"
curl -fsSL https://barella.sy3.ru/obekty/     | grep -F "VERTICAL"
curl -fsSL https://barella.sy3.ru/obekty/     | grep -F "Светлана"
curl -fsSL https://barella.sy3.ru/kontakty/   | grep -F "Полюстровский"
curl -fsSL https://barella.sy3.ru/kontakty/   | grep -F "+7 (921) 416-46-46"
```

## TASK-ISSUE-SUYAZOV_BARELLA.RU-537 — объект «Светлана» на /obekty/

| URL | Проверка |
|---|---|
| `/obekty/` | присутствует `Производственные помещения на территории завода «Светлана»` |
| `/obekty/` | присутствует `ООО «Оптосенс»` |
| `/obekty/` | присутствует `пр. Энгельса, д. 27, литера АД` |
| `/obekty/` | отсутствует `Фото объекта — добавляется отдельной задачей оператора` |
| `/obekty/` | ровно 6 фото галереи из `assets/img/objects/01-svetlana/` (01.jpg…06.jpg) отдаются с HTTP 200 |

```bash
curl -fsSL https://barella.sy3.ru/obekty/ | grep -F "Производственные помещения на территории завода «Светлана»"
curl -fsSL https://barella.sy3.ru/obekty/ | grep -F "ООО «Оптосенс»"
curl -fsSL https://barella.sy3.ru/obekty/ | grep -F "пр. Энгельса, д. 27, литера АД"
! curl -fsSL https://barella.sy3.ru/obekty/ | grep -F "Фото объекта — добавляется отдельной задачей оператора"
```

Визуальные замечания: у объектов без фото — аккуратные placeholder-блоки (`Фото объекта — публикуется после согласования`); мобильная вёрстка — media queries на 900px и 600px в `style.css`.

## TASK-ISSUE-SUYAZOV_BARELLA.RU-538 — каталог из 10 объектов и 10 отдельных страниц

`/obekty/` — только каталог ровно из 10 карточек (без развёрнутого кейса внутри листинга). Каждая карточка ведёт на свою страницу по каноническому slug из `docs/object-page-slugs-v2.md`:

| URL | Обязательный видимый текст |
|---|---|
| `/obekty/` | `Наши объекты` |
| `/obekty/` | `Производственные помещения на территории завода «Светлана»` |
| `/obekty/` | `Энергоцентр для 1-й очереди комплексной застройки территории АО «Рублево-Архангельское»` |
| `/obekty/` | отсутствует `Фото объекта — добавляется отдельной задачей оператора` |
| `/obekty/svetlana/` | `ООО «Оптосенс»`, `пр. Энгельса, д. 27, литера АД` |
| `/obekty/polisan-ampulnaya-liniya/` | `Чистое помещение для новой ампульной линии`, `ООО «НТФФ «ПОЛИСАН»` |
| `/obekty/pskov-drobestruy-galvanika/` | `дробеструйная камера`, `цех гальваники` |
| `/obekty/rublevo-arkhangelskoe/` | `Энергоцентр для 1-й очереди комплексной застройки территории АО «Рублево-Архангельское»`, `ООО «Сберэнергодевелопмент»` |

Прочие маршруты: `/obekty/oktyabrskaya-naberezhnaya/`, `/obekty/vertical/`, `/obekty/kalyannyy-bar-nevskiy/`, `/obekty/retinoidy/`, `/obekty/pskov-proizvodstvennye-linii/`, `/obekty/polisan-paketnaya-liniya/` — все отдают HTTP 200 и содержат свой заголовок, адрес, заказчика и состав работ из `docs/requirements-objects-v2.md`.

Фото: только из `assets/img/objects/<object>/` (копии проверены по `web_sha256` из `materials/objects/<object>/manifest.json`). `05-retinoidy` публикует 4 фото — byte-identical duplicate `04.jpg` (совпадает с `04-nevskiy/04.jpg`) второй раз не публикуется.

```bash
curl -fsSL https://barella.sy3.ru/obekty/ | grep -F "Наши объекты"
curl -fsSL https://barella.sy3.ru/obekty/ | grep -oF 'class="object-card"' | wc -l   # ровно 10
for slug in svetlana oktyabrskaya-naberezhnaya vertical kalyannyy-bar-nevskiy retinoidy \
            polisan-ampulnaya-liniya pskov-proizvodstvennye-linii pskov-drobestruy-galvanika \
            polisan-paketnaya-liniya rublevo-arkhangelskoe; do
  curl -fsSL -o /dev/null -w "%{http_code} /obekty/$slug/\n" "https://barella.sy3.ru/obekty/$slug/"
done
curl -fsSL https://barella.sy3.ru/obekty/svetlana/ | grep -F "ООО «Оптосенс»"
curl -fsSL https://barella.sy3.ru/obekty/rublevo-arkhangelskoe/ | grep -F "ООО «Сберэнергодевелопмент»"
! curl -fsSL https://barella.sy3.ru/obekty/ | grep -F "Фото объекта — добавляется отдельной задачей оператора"
```

Шаблон страницы объекта (`template-obekt.php`): hero с заголовком и breadcrumb на `/obekty/`, блок адрес/заказчик/предмет/работы, галерея равномерными плитками 4:3 (`object-fit: cover`, без masonry-разрывов), CTA внизу. Адаптив: grid 3→2→1 колонки на 900px/600px.

## TASK-ISSUE-SUYAZOV_BARELLA.RU-549 — визуальная correction каталога и шаблона объекта

Визуальное представление `/obekty/` и всех 10 страниц объектов переработано (структура, тексты, slugs и набор фото — без изменений):

- контейнер 1200 px; breadcrumb «Все объекты»; H1 с `max-width: 900px`; мета-пилюли город/предмет;
- информационный блок Адрес / Заказчик / Предмет работ — карточки с синей кромкой и иерархией label → значение;
- «Выполненные работы» — двухколоночный checklist на desktop, одна колонка на mobile;
- галерея — единая сетка 3/2/1 колонки, `aspect-ratio: 4/3`, `object-fit: cover`, без огромной первой фото и белых дыр;
- CTA — padding 72px, h2 32px, брендовая кнопка; формы на этих маршрутах нет, логика форм не менялась;
- каталог — ровно 10 карточек, hover + `:focus-visible`, обложки 4:3.

Live acceptance (все проверки выполнены против `https://barella.sy3.ru/` 2026-08-07):

| URL | Проверка |
|---|---|
| `/obekty/` | `Наши объекты`; `Производственные помещения на территории завода «Светлана»`; `Энергоцентр для 1-й очереди комплексной застройки территории АО «Рублево-Архангельское»`; отсутствует `Фото объекта — добавляется отдельной задачей оператора` |
| `/obekty/svetlana/` | `Все объекты`; `Выполненные работы`; `ООО «Оптосенс»`; отсутствует `Фото объекта — добавляется отдельной задачей оператора` |
| `/obekty/vertical/` | `Апарт-отель «VERTICAL»`; `Выполненные работы` |
| `/obekty/pskov-proizvodstvennye-linii/` | `ООО «СКТ Групп»`; `Выполненные работы` |
| `/obekty/rublevo-arkhangelskoe/` | `ООО «Сберэнергодевелопмент»`; `Выполненные работы` |

Все 11 маршрутов — HTTP 200; все изображения — HTTP 200; console errors = 0; horizontal overflow = 0 (Chromium, viewport 1440 и 390).

Скриншоты (full-page, Chromium headless): `obekty-1440px.png`, `obekty-390px.png`, `obekt-svetlana-1440px.png`, `obekt-svetlana-390px.png`, `obekt-vertical-1440px.png`, `obekt-vertical-390px.png`, `obekt-pskov-linii-1440px.png`, `obekt-pskov-linii-390px.png`.
