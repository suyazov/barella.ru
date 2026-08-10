# TASK-ISSUE-SUYAZOV_BARELLA.RU-710 — in-place CF7 modals

## Implementation

The platform gap is resolved by Bridge Connector 1.12.0. The task change-set
configures only the connector-owned `bridge_connector_cf7_modal_config` option:

- the two exact `a.book-appointment` triggers on `/`, `/o-kompanii/`, and
  `/obekty/` open existing published CF7 form `3334` in place;
- the exact server-rendered homepage `a.banner-btn` trigger and its responsive
  client-side copies open existing published CF7 form `2562` in place;
- trigger class, visible text, path, and match count are all fail-closed;
- the dialogs are initially hidden, preserve the pathname, never submit a
  form during verification, close by button/backdrop/Escape, return focus,
  and can be reopened.

No theme file, Elementor page, CF7 definition, recipients, storage policy, or
honeypot setting is changed. Delivery uses the normal Connector snapshot,
read-back, live verification, and rollback contract.

## Acceptance

The change-set HTTP gate checks the canonical exact visible markers for `/`,
`/o-kompanii/`, and `/obekty/`, plus absence of `Internal Server Error`. It does
not use hidden modal markup or fallback anchors as evidence of interaction.

The Connector's machine browser regression gate is mandatory after apply. It
must execute the callback click on all three routes and the calculation click
on `/`, then assert closed → open, exactly one matching `.wpcf7-form`, the
expected CF7 id, unchanged pathname, no new tab, focusable controls, close, and
reopen. A failed interaction causes snapshot rollback and cannot produce
`VERIFIED_DONE`; no form is submitted during the check.

## Pre-write read-only audit for correction G3

The 2026-08-10 no-cache live audit found two `a.book-appointment` elements on
each required route, one exact homepage `a.banner-btn`, and Connector-owned
modal surfaces for callback and calculation. The CTA elements still retain
their safe fallback anchors, so anchor presence is explicitly not acceptance
evidence. The published page markup contains CF7 ids 845, 2562, and 3334 on
`/`, and form 3334 on the two inner routes. Generic theme/plugin popup assets
also remain present but are not treated as the task binding.

Preserved authenticated Connector evidence verifies the reviewed definitions
of forms 845, 2562, and 3334, the existing recipients, storage policy, and
server-side honeypots. This correction does not edit any CF7 definition.

## Context delta

```json
{
  "result": "Implemented the task-scoped Connector 1.12 CF7 modal mapping for existing forms 3334 and 2562.",
  "decisions": "Used a schema-validated connector-owned modal instead of rewriting theme/Elementor/CF7 content or preserving anchor navigation as the final behavior.",
  "current_status": "The same runtime change-set now uses canonical exact HTTP markers and requires the Connector machine browser interaction gate after apply.",
  "constraints": "Do not submit forms; preserve CF7 definitions, recipients, storage and honeypots; require snapshot/read-back/rollback and functional live evidence.",
  "next_step": "Push the correction to existing PR #34; Bridge must apply with snapshot/read-back/rollback and pass the required click/open/close/reopen browser evidence before finalization."
}
```
