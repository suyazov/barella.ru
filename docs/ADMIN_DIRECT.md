# wp-admin-direct change-set contract (regulation §21.4)

This repository delivers product changes to the client site through the Bridge
`wp-admin-direct` adapter. A change is exactly one declarative JSON change-set
per pull request, applied to the site by the Bridge Connector plugin after the
PR is merged. The contract below is validated fail-closed by Bridge
(`WP_ADMIN_DIRECT_CHANGESET_INVALID` names the exact field on any violation),
and an invalid change-set blocks delivery **before anything is written to the
site**.

## File rules

- Exactly **one** change-set file per PR/merge, at
  `admin-direct/changes/<task-slug>.json`.
- The path must match `^admin-direct/changes/[a-z0-9][a-z0-9-]{0,98}\.json$`
  (lowercase letters, digits, dashes; use the task slug, e.g.
  `task-issue-suyazov-barella-ru-557.json`).
- A merge with **zero** or **multiple** files under `admin-direct/changes/` is
  blocked (`wp_admin_direct_changeset_missing` /
  `wp_admin_direct_changeset_multiple`).
- To fix a rejected change-set, edit **the same file in place** in a
  correction PR — do not add a second file.

## Document shape

Root keys are **exactly** these three — any other root key (e.g. `task_id`,
`meta`, `title`) is rejected:

```json
{
  "schema_version": 1,
  "ops": [ ... ],
  "verify": { "checks": [ ... ] }
}
```

- `schema_version` — must be exactly `1` (number).
- `ops` — array of 1..20 operations (see below).
- `verify` — optional object with a single allowed key `checks`.

## Operations

Every op is an object with `type` equal to exactly `update_page` or
`update_option`. Unknown keys inside an op are rejected.

### `update_page`

Allowed keys: `type`, `page_id`, `title`, `content`, `template`,
`elementor_data`, `elementor_page_settings`. No others (`slug`, `status`,
`menu`, `page_slug`, ... are rejected).

- `page_id` — required, positive integer: the numeric WordPress page ID on the
  client site. Pages are addressed **only** by numeric ID, never by slug.
- At least one of `title`, `content`, `template`, `elementor_data`,
  `elementor_page_settings` must be present.
- `title`, `content`, `template` — strings.
- `elementor_data`, `elementor_page_settings` — non-empty **JSON encoded as a
  string** (the value is a string containing valid JSON, not an object).

### `update_option`

Allowed keys: `type`, `key`, `value`. No others.

- `key` — string matching `^[a-z0-9_]{1,64}$`. The Connector enforces the
  actual option allowlist server-side.
- `value` — required; string, number or boolean (never `null`, never an
  object/array).

## Verify checks (optional)

`verify.checks` — array of at most 10 objects, each with keys chosen from
`path`, `required_text`, `absent_text` (no others):

- `path` — required; site-relative path starting with exactly one slash,
  matching `^\/(?!\/)\S*$` (e.g. `/dostavka-i-oplata/`).
- `required_text` — optional array of non-empty strings that must appear in
  the anonymous live HTTP response after deploy.
- `absent_text` — optional array of non-empty strings that must not appear.

## Minimal valid example

```json
{
  "schema_version": 1,
  "ops": [
    {
      "type": "update_page",
      "page_id": 3408,
      "content": "<div class=\"barella-objx\"><p>Обновлённая страница объекта.</p></div>"
    }
  ],
  "verify": {
    "checks": [
      { "path": "/obekty/svetlana/", "required_text": ["Выполненные работы"], "absent_text": ["barella.sy3.ru"] }
    ]
  }
}
```

## What happens on merge

prepare (config gate, credentials + site binding, pin to the exact merge SHA,
change-set select/validate) → backup (Connector snapshot of every referenced
page/option) → deploy (ops applied sequentially, first failure stops the run)
→ verify (live HTTP checks + Connector audit count). Rollback is the Connector
snapshot restore. One reviewed change-set per merge — never more.
