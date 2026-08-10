# TASK-ISSUE-SUYAZOV_BARELLA.RU-710 — in-place CF7 modals

## Implementation

The platform gap is resolved by Bridge Connector 1.12.0. The task change-set
configures only the connector-owned `bridge_connector_cf7_modal_config` option:

- the two exact `a.book-appointment` triggers on `/`, `/o-kompanii/`, and
  `/obekty/` open existing published CF7 form `3334` in place;
- the exact homepage `a.banner-btn` trigger opens existing published CF7 form
  `2562` in place;
- trigger class, visible text, path, and match count are all fail-closed;
- the dialogs are initially hidden, preserve the pathname, never submit a
  form during verification, close by button/backdrop/Escape, return focus,
  and can be reopened.

No theme file, Elementor page, CF7 definition, recipients, storage policy, or
honeypot setting is changed. Delivery uses the normal Connector snapshot,
read-back, live verification, and rollback contract.

## Acceptance

Static live acceptance checks the two modal surfaces and their real CF7 ids on
the homepage, and the callback surface on `/o-kompanii/` and `/obekty/`.
Functional browser acceptance additionally verifies closed → click → open,
one `.wpcf7-form`, unchanged pathname, focusable controls, close, and reopen.

## Context delta

```json
{
  "result": "Implemented the task-scoped Connector 1.12 CF7 modal mapping for existing forms 3334 and 2562.",
  "decisions": "Used a schema-validated connector-owned modal instead of rewriting theme/Elementor/CF7 content or preserving anchor navigation as the final behavior.",
  "current_status": "Implementation change-set prepared for the same Issue #710 and orchestration 3bcf82d10921011a3181b296.",
  "constraints": "Do not submit forms; preserve CF7 definitions, recipients, storage and honeypots; require snapshot/read-back/rollback and functional live evidence.",
  "next_step": "Merge the existing PR, deliver the bounded option change, run functional browser acceptance, then reconcile #710 to VERIFIED_DONE."
}
```
