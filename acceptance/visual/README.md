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

Визуальные замечания: фото объектов и руководителей — аккуратные placeholder-блоки (`Фото объекта — добавляется отдельной задачей оператора`); мобильная вёрстка — media queries на 900px и 600px в `style.css`.
