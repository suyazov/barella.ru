# TASK-ISSUE-SUYAZOV_BARELLA.RU-604 — mixed content и `style.min.css`

## Результат preflight

Задача заблокирована до production write: текущий `wp-admin-direct` contract не
может выразить требуемые изменения безопасным декларативным change-set.

- WordPress options `siteurl` и `home` отсутствуют в allowlist установленного
  Bridge Connector. Разрешены только `show_on_front`, `page_on_front`,
  `page_for_posts` и `blog_public`; попытка `update_option` для другого ключа
  завершается fail-closed с `bridge_option_forbidden`.
- Очистка Elementor CSS выполняется Connector после `update_page`, но это не
  меняет запрещённые `siteurl`/`home`. Делать фиктивную перезапись page content
  нельзя: она не устраняет корневую причину и создаёт ненужный риск изменения
  страниц.
- Удалить enqueue `/wp-content/themes/clinmedix/style.min.css` или восстановить
  theme-файл операциями `update_page`, `update_option`, `create_page` и
  `update_menu` невозможно. Theme/plugin files в этом репозитории заморожены и
  не являются delivery input.

Поэтому `admin-direct/changes/task-issue-suyazov-barella-ru-604.json` намеренно
не создан: change-set с `siteurl`/`home` гарантированно отклонится Connector, а
page-only change-set не выполнит acceptance criteria. Production, тексты,
фотографии, структура и вёрстка не изменялись.

## Требуемое разблокирование

Нужен отдельный reviewed platform/capability change вне этого repository scope:

1. добавить в Connector bounded поддержку `siteurl` и `home` с exact HTTPS
   validation, snapshot/rollback и последующей глобальной очисткой Elementor
   CSS;
2. добавить bounded операцию для удаления конкретного enqueue активной темы
   либо восстановления точного `style.min.css` с backup/rollback;
3. после activation повторить эту задачу одним валидным change-set и проверить
   `/`, `/obekty/`, `/kontakty/`: exact visible texts, отсутствие
   `http://barella.pro` в source и отсутствие запроса `style.min.css` либо его
   HTTP 200.

## context_delta

```json
{
  "result": "Confirmed that the requested WordPress URL and active-theme asset fixes cannot be represented by the current wp-admin-direct contract.",
  "decisions": "Did not create a guaranteed-to-fail option change or a no-op page rewrite; recorded the exact capability gap without touching production.",
  "current_status": "Blocked before delivery; repository and production content remain unchanged.",
  "constraints": "Connector forbids siteurl and home, exposes no theme enqueue/file operation, and this task forbids theme, database, production and Bridge changes.",
  "next_step": "Extend and activate a bounded Connector capability for validated siteurl/home updates, Elementor CSS regeneration and the exact clinmedix stylesheet fix, then rerun this task."
}
```
