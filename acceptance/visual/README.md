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
