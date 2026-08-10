# TASK-ISSUE-SUYAZOV_BARELLA.RU-705 — BLOCKED before write

## Result

No `admin-direct` change-set was authored and no production write was made.
The required live matching and the header mutation cannot be satisfied by the
current source state and Connector 1.7.0 contract without violating the task's
fail-closed rules.

## Authenticated pre-write read-back

- Page 2471 (`/`) is published Elementor content. Its four live team widgets
  are, in order: `Кулгин Андрей`, `Лабудин Дмитрий`, `Сергей Фофанков`,
  `Поздеев Василий`.
- The requested exact source name `Сергей Офанков` does not exist on page 2471.
  Therefore an image cannot be copied by the required exact-name match.
- Page 3327 (`/o-kompanii/`) is published Elementor content. Its four rendered
  cards currently use `Кулгин Андрей Анатольевич`, `Лабудин Дмитрий`,
  `Фофанков Сергей`, `Поздеев Василий`. The task forbids changing names or
  other page text, while live acceptance requires different exact text.
- Page 3329 (`/kontakty/`) is published and uses CF7 form 845.
- Live home uses CF7 form 2562 (`Raschet`) in the calculation context and CF7
  form 845 (`Consult`) in the general consultation context. Form 3334 is the
  consultation form used by the current company-page component.
- Authenticated CF7 read-back for forms 845, 2562 and 3334 reports the required
  recipients, one server-side `bridge_hp_*` honeypot per form, and Connector
  storage enabled for exactly those three form IDs. Their reviewed hashes are
  unchanged from the existing repository evidence.
- The actual header CTA is emitted by the active theme source as
  `a.book-appointment` with `href="#"` (desktop and mobile). The rendered
  header is not an Elementor template; Elementor template 2606 present on the
  page is the footer. The allowed `wp-admin-direct` operations cannot mutate a
  theme-owned header link, and theme files are outside this task's allowed
  paths.

No snapshot was requested because the run stopped before any write plan was
created. Connector delivery snapshots are write-path operations and must only
be requested for entities in a valid reviewed change-set.

## Required resolution

1. Confirm the canonical third specialist name and reconcile the task's exact
   matching/visible-text requirements with the instruction not to change names.
2. Add a bounded Connector capability for the existing theme-owned header CTA
   (with exact-match, snapshot, read-back and rollback), or move that CTA into
   an explicitly identified Elementor template through a separately approved
   task.
3. Resume this same task after both facts are resolved; do not infer a mapping
   or use a historical ID.

## Context delta

```json
{
  "result": "Stopped before write after authenticated live read-back exposed an exact-name mismatch and a theme-owned header CTA outside the current Connector mutation contract.",
  "decisions": "Did not create a partial change-set, rename specialists, guess a header template, alter CF7 settings, or touch production.",
  "current_status": "BLOCKED before write; live content and CF7 state remain unchanged.",
  "constraints": "Exact-name source matching is mandatory; specialist text is immutable; only declarative admin-direct operations are allowed; header theme files and direct production writes are forbidden.",
  "next_step": "Resolve the canonical specialist name and provide a bounded Connector operation for the existing theme-owned header CTA, then resume the same task."
}
```
