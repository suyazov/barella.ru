# TASK-ISSUE-SUYAZOV_BARELLA.RU-651 — PROJECT_CAPABILITY_GAP

## Result

`PROJECT_CAPABILITY_GAP`: the current `wp-admin-direct` contract cannot safely
audit or update Contact Form 7 forms 845, 2562, and 3334.

No production write, plugin installation or activation, form submission, mail
send, database write, theme workaround, injected PHP/HTML/JavaScript, or
wp-admin browser write was performed. No `admin-direct` change-set was created.

## Read-only capability audit

The repository contract in `docs/ADMIN_DIRECT.md` allows only these operations:

- `update_page`
- `update_option` (restricted by a server-side option allowlist)
- `create_page`
- `update_menu`
- `update_elementor_widgets`
- `replace_site_url`

It provides no bounded operation to:

1. read the exact CF7 form definition and mail/settings for a specified form ID;
2. list installed plugins/extensions with version and active status;
3. update only the form definition of an existing CF7 form by numeric ID;
4. read back the updated definition and prove that the selected honeypot tag is
   registered with server-side anti-spam validation before mail/storage.

The managed context bundle declares only the `development` capability and does
not contain CF7 definitions, plugin inventory, or preserved implementation
changes that can be independently verified and safely reused.

## Required bounded capability

Bridge must add fail-closed, site-bound Connector operations that provide:

- read-only CF7 form retrieval for exact IDs 845, 2562, and 3334, including the
  form definition and a digest/read-only representation of mail/settings;
- read-only installed-plugin inventory containing plugin slug, version,
  activation status, and CF7 compatibility/registered form tags;
- a compare-and-set update of only the `form` definition for an exact CF7 ID,
  preserving mail/settings and rejecting any stale precondition;
- post-update read-back plus evidence that the chosen honeypot field type has a
  server-side validation/spam hook registered before mail/storage processing.

The update operation must snapshot all three forms and roll back atomically if
any precondition, update, read-back, or validation-registration check fails.

## Safe next action

Extend and activate the bounded Bridge Connector CF7 capability, then resume
this same TASK and orchestration. First audit forms 845/2562/3334 and active
plugins. If a compatible active honeypot mechanism is present, use that exact
mechanism and add one unique hidden honeypot field per form. If none is active,
stop for owner approval before installing or activating a plugin.

## Preserved live acceptance

Because no page or form change was delivered, this task does not alter visible
content on `/o-kompanii/`, `/obekty/`, or `/kontakty/`. The exact-text live
acceptance requirements remain constraints for the resumed implementation.

## context_delta

```json
{
  "result": "PROJECT_CAPABILITY_GAP: current wp-admin-direct cannot audit or update CF7 forms safely.",
  "decisions": "Created no change-set and made no site write because CF7 and plugin operations are absent.",
  "current_status": "Blocked before implementation; forms 845, 2562, and 3334 remain unchanged.",
  "constraints": "No browser write, arbitrary REST, injection, theme workaround, direct database write, plugin install, or test submission.",
  "next_step": "Add bounded CF7/plugin read, compare-and-set form update, read-back, and server-side validation evidence; then resume this same task."
}
```
