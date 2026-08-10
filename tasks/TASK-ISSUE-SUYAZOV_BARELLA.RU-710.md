# TASK-ISSUE-SUYAZOV_BARELLA.RU-710 — PROJECT_CAPABILITY_GAP

## Result

`PROJECT_CAPABILITY_GAP`: the production CTA behaviour is still anchor
navigation, while the current bounded `wp-admin-direct` contract has no
operation for auditing, creating, or configuring an in-place CF7 modal and no
functional interaction verifier for click/open/close/reopen behaviour. No
production write, form submission, plugin installation, or new form was
performed.

## Read-only audit

The audit was performed against no-cache anonymous responses from
`https://barella.pro/` on 2026-08-10 before any write:

| Route | Live CTA evidence | Live form evidence |
| --- | --- | --- |
| `/` | two `a.book-appointment` links with exact text `Заказать звонок` navigate to `/o-kompanii/#wpcf7-f3334-p3327-o1`; the banner CTA with exact text `БЕСПЛАТНЫЙ РАСЧЁТ СТОИМОСТИ` navigates to `#wpcf7-f2562-p2471-o1` | rendered CF7 forms 2562 and 845 are ordinary page surfaces, not closed CTA dialogs |
| `/o-kompanii/` | two `a.book-appointment` links navigate to `/o-kompanii/#wpcf7-f3334-p3327-o1` | rendered CF7 form 3334 is an ordinary page surface |
| `/obekty/` | two `a.book-appointment` links navigate to `/o-kompanii/#wpcf7-f3334-p3327-o1` | rendered CF7 form 3334 is an ordinary page surface |

The CTA elements have no live modal/dialog target or inline open behaviour.
No CTA-specific closed form surface was found in the live markup. Generic
Directorist authentication-modal CSS is present, but it is unrelated to these
CTA elements and does not contain CF7 2562 or 3334. Therefore the current
clicks cannot satisfy click → open-state → form, same-path, close, and reopen.

Preserved authenticated evidence from the immediately preceding controlled
correction confirms that forms 845, 2562, and 3334 retained their reviewed
definitions, the recipients `2@barella.ru`, `5@barella.ru`, and
`barella-spb@yandex.ru`, individual server-side honeypots, and enabled storage.
That evidence is safe to reuse only for form identity and preservation; its
anchor verification is explicitly insufficient for this correction. No
task-scoped completed Kimi change or implementation artifact was present in
this worktree, and no executor was started.

The required route markers were also present and `Internal Server Error` was
absent on `/`, `/o-kompanii/`, and `/obekty/`.

## Missing bounded capability

The Connector needs one reviewed, allowlisted interactive-CTA capability that:

1. Reads the exact existing theme/plugin popup definitions, active bindings,
   and rendered surface configuration without exposing secrets.
2. Binds explicit CTA locators (route, class, exact visible text and expected
   match count) to an existing CF7 form ID using an existing popup mechanism,
   or creates a Connector-owned declarative dialog surface without arbitrary
   PHP, JavaScript, theme-file, or database writes.
3. Accepts only explicit route/form allowlists; snapshots all affected
   settings/content; preserves the complete CF7 definition and mail/storage/
   honeypot settings; performs exact read-back; and rolls back on failure.
4. Verifies in a real browser for each required route: surface closed before
   click, click opens exactly one `.wpcf7-form`, actual CF7 ID, unchanged
   pathname, no new window, focusable/editable controls, working close, and
   successful reopen.

For this task the bounded mapping must be header `a.book-appointment` on `/`,
`/o-kompanii/`, and `/obekty/` to the authenticated callback/general-request
form selected from the live definition context, and homepage `a.banner-btn`
with exact text `БЕСПЛАТНЫЙ РАСЧЁТ СТОИМОСТИ` to form 2562.

## Safe next action

Add and review the bounded Connector capability above, deploy that Connector
release through its own lifecycle, then resume this same TASK and orchestration.
Run authenticated read-only discovery first; apply only a snapshot-backed
declarative mapping and collect the required browser interaction evidence. Do
not restore the anchor workaround or inject arbitrary PHP/JavaScript.

## Context delta

```json
{
  "result": "Recorded PROJECT_CAPABILITY_GAP after read-only live CTA, form-surface, popup-mechanism, contract, and preserved authenticated CF7 evidence audit; production was not changed.",
  "decisions": "Rejected the existing anchor navigation as non-functional and refused arbitrary PHP/JavaScript or unsupported WordPress writes.",
  "current_status": "Blocked before write because the bounded Connector cannot configure and browser-verify an interactive CF7 modal surface.",
  "constraints": "Keep exact CTA texts and CF7 IDs/definitions/mail/storage/honeypots; no submission, new form, plugin install, anchor workaround, direct production write, DNS/menu/footer/object change, or deploy by Codex.",
  "next_step": "Add a reviewed snapshot-backed interactive CTA/modal mapping and browser interaction verification capability, then resume this same task and orchestration."
}
```
