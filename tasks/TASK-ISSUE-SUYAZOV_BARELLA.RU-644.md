# TASK-ISSUE-SUYAZOV_BARELLA.RU-644 — PROJECT_CAPABILITY_GAP

## Result

`PROJECT_CAPABILITY_GAP`: Bridge Connector 1.5.1 and the repository
`wp-admin-direct` contract do not expose operations needed to audit or update
Contact Form 7 mail settings or to audit/configure submission storage. No
production write or form submission was performed, and no declarative
change-set was created.

## Read-only production evidence

Anonymous HTML was read from production on 2026-08-09. The observed forms are:

| Public source | Observed rendered CF7 form |
| --- | --- |
| `/` | IDs `2562` and `845` (page ID `2471`) |
| `/o-kompanii/` | ID `3334` (page ID `3327`) |
| `/obekty/` | ID `3334` (page ID `3328`) |
| `/kontakty/` | ID `845` (page ID `3329`) |

Thus the distinct publicly observed CF7 IDs are `845`, `2562`, and `3334`.
The production sitemap endpoint was unavailable to the anonymous audit, so
this observation cannot prove that no additional unlinked public lead form
exists.

The required live page markers were also checked without changing content:

- `/o-kompanii/`: `Давайте обсудим ваш проект` and
  `Получить бесплатную консультацию` are present; `Internal Server Error` is
  absent.
- `/obekty/`: `Наши объекты` and `Давайте обсудим ваш проект` are present;
  `Internal Server Error` is absent.
- `/kontakty/`: `Контакты` and `Оставьте заявку` are present;
  `Internal Server Error` is absent.

The immutable context bundle and repository contained no task-scoped Kimi
change or completed audit artifact for TASK-ISSUE-SUYAZOV_BARELLA.RU-644 to
reuse. Kimi was not started.

## Missing connector operations

The allowed operation set is limited to `update_page`, `update_option`,
`create_page`, `update_menu`, `update_elementor_widgets`, and
`replace_site_url`. None can safely provide the required administration
operations. The Connector needs bounded, allowlisted support for:

1. Listing the installed and active plugins relevant to CF7 submission
   storage, including plugin identity/version/status.
2. Reading exact `wpcf7_contact_form` form/mail/meta settings for specified
   IDs and reporting current To, From, Reply-To, headers, body, form fields,
   and anti-spam-related configuration without exposing secrets.
3. Updating only the CF7 Mail `To` value for an explicit allowlist of audited
   form IDs, with snapshot, exact preservation of all other mail/form/meta,
   read-back, rollback, and verification that To is exactly
   `2@barella.ru`, `5@barella.ru`, and `barella-spb@yandex.ru` with no BCC.
4. Reading and configuring an already installed and active compatible storage
   plugin for those explicit form IDs, plus read-back of the administrator
   menu/page, list columns, record fields, and the effective save-new-
   submissions setting. If no compatible plugin is active, a separate
   approved install/activate operation is required; this task does not grant
   that authority.

## Safe next action

Extend Bridge Connector through its normal reviewed release and capability
registry with the bounded operations above, then resume this same TASK and
orchestration. Run the administrative read-only audit first. Only after it
confirms the complete set of public form IDs and an active compatible storage
mechanism should a reviewed change-set update the three exact recipients and
enable storage. Do not use wp-admin browser writes, arbitrary REST, injected
HTML/JavaScript/PHP, or a plugin-install workaround.

## Context delta

```json
{
  "result": "Recorded PROJECT_CAPABILITY_GAP; production was not changed.",
  "decisions": "Observed public CF7 IDs 845, 2562, and 3334; refused unsupported CF7 mail/meta and plugin writes.",
  "current_status": "Blocked before write because Connector 1.5.1 cannot perform the required administrative audit or configuration.",
  "constraints": "Preserve form markup and all non-target settings; no browser write, arbitrary REST, injection, plugin workaround, test submissions, deployment, or production mutation.",
  "next_step": "Add reviewed bounded Connector operations for CF7 read/update and storage-plugin audit/configuration, then resume this same task and orchestration."
}
```
