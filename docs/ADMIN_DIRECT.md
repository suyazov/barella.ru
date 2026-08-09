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

Every op is an object with `type` equal to exactly one of
`update_page`, `update_option`, `create_page`, `update_menu`,
`update_elementor_widgets`, `replace_site_url`. Unknown keys inside an op are
rejected.

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

### `create_page` (contract v1.1, connector ≥ 1.1.0)

Creates a NEW published page. Allowed keys: `type`, `title`, `content`,
`slug`. No others.

- `title`, `content` — required non-empty strings.
- `slug` — optional, `^[a-z0-9][a-z0-9-]{0,98}$`; must be free on the site
  (the delivery fails closed at backup before any write if the slug is
  taken — never overwrite an existing page with create_page).

### `update_menu` (contract v1.1, connector ≥ 1.1.0)

Appends a page link to a nav menu. Allowed keys: `type`, `menu`,
`page_slug`, `title`. No others.

- `menu` — menu slug matching `^[a-z0-9][a-z0-9-]{0,63}$`, or the literal
  `auto` (resolves to the single theme-location menu; fails closed when zero
  or several menus are assigned).
- `page_slug` — the linked page's slug; either created by an EARLIER
  `create_page` op in the same change-set, or an already-existing published
  page (existence enforced at apply time).
- `title` — required non-empty string (the menu label).

Rollback for created entities: the created page / menu item is force-deleted
first, then the snapshot restore runs.

### `update_option`

Allowed keys: `type`, `key`, `value`. No others.

- `key` — string matching `^[a-z0-9_]{1,64}$`. The Connector enforces the
  actual option allowlist server-side.
- `value` — required; string, number or boolean (never `null`, never an
  object/array).

### `update_elementor_widgets` (contract v1.3, connector ≥ 1.3.0)

Sets targeted properties on individual widgets inside an Elementor template
(e.g. a theme-builder header/footer template in `elementor_library`) without
rewriting the full `elementor_data` document. Allowed keys: `type`,
`template_id`, `actions`. No others.

- `template_id` — required, positive integer: the numeric post ID of the
  Elementor template on the client site.
- `actions` — required array of 1..20 action objects, applied sequentially.
  Each action object has `action` equal to exactly one action name plus its
  parameters; unknown keys inside an action are rejected.

Action `set_widget_link`:

- Allowed keys: `action`, `element_id`, `url`. No others.
- `element_id` — required, non-empty string: the Elementor element ID of the
  target widget inside the template (e.g. a heading widget's id).
- `url` — required, non-empty string: the link URL assigned to the widget.
  Only the widget's link setting is changed; widget text, style and the rest
  of the template structure are left untouched.

Backup and rollback follow the standard pipeline: the Connector snapshots the
referenced template before any write, and a snapshot restore runs on any
apply/live-verify failure.

### `replace_site_url` (contract v1.5, connector ≥ 1.5.0)

Rewrites absolute URL occurrences from one site base URL to another inside a
bounded, explicit target set — for example fixing mixed-content leftovers
(`http://` → `https://`) stored in post content or serialized post meta such
as WP Font Library `font_face_settings`. Allowed keys: `type`, `old_url`,
`new_url`, `posts`, `options`. No others.

- `old_url`, `new_url` — required non-empty strings: the exact absolute base
  URLs to replace (e.g. `http://barella.pro` → `https://barella.pro`).
- `posts` — required non-empty array of positive integers: the exact post IDs
  to rewrite. Only these posts are touched.
- `options` — optional array of option-name strings matching
  `^[a-z0-9_]{1,64}$`; omit it when no options need rewriting.

Backup and rollback follow the standard pipeline: the Connector snapshots
every referenced post (and option) before any write, and a snapshot restore
runs on any apply/live-verify failure.

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
