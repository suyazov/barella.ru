# TASK-ISSUE-SUYAZOV_BARELLA.RU-804 — restore inline calculation form

## Read-only production audit

- Page `2471` (`/`, published, `tpl-default-elementor.php`) has empty
  `post_content` and a 75,953-byte Elementor source document.
- Elementor section `6dab112c`, immediately after the hero section, still
  contains widget `4203b032` with the existing shortcode for CF7 form `2562`.
- Anonymous live HTML contains exactly one non-modal
  `wpcf7-f2562-p2471-o1` instance inside `.find-doctor-box`; its source order
  is hero/banner, inline form, then `Для каких объектов мы работаем`.
- The inline wrapper is hidden by the later child-theme rule
  `body.home .find-doctor-box { display: none !important; }`. This is the
  direct cause of the empty white area and invisible inline form.
- The current `bridge_connector_cf7_modal_config` also maps the calculation
  CTA to callback form `3334`, rather than calculation form `2562`.
- Authenticated Connector read-back confirms form `2562` remains published as
  `Raschet`, with its existing name, phone, consent, submit label
  `Получить бесплатный расчет`, recipients, mail metadata, storage policy and
  server-side honeypot unchanged. No form was submitted.
- Anonymous `/` returned HTTP 200, contained the required hero/submit/objects
  text, and did not contain `Internal Server Error`.

## Implementation

The single declarative change-set:

1. updates only the existing Elementor source for page `2471`, appending a
   page-scoped, section-scoped visibility override to section `6dab112c` so
   the existing `.find-doctor-box` is rendered normally; and
2. restores only the calculation modal mapping to existing CF7 form `2562`.

The callback mapping remains form `3334`. No CF7 definition, mail setting,
storage policy, honeypot, theme file, content copy, media or navigation is
changed. Bridge delivery provides the required snapshot, read-back and
rollback path after merge.

## Post-merge acceptance required

- Before click, exactly one visible non-modal CF7 2562 instance occurs in DOM
  order hero/banner → inline CF7 2562 → `Для каких объектов мы работаем`.
- The inline form exposes its existing name, phone, consent and
  `Получить бесплатный расчет` controls and has no hidden ancestor.
- `БЕСПЛАТНЫЙ РАСЧЁТ СТОИМОСТИ` opens, closes and reopens the connector modal
  containing CF7 2562 without navigation or scrolling.
- Header `Заказать звонок` opens, closes and reopens CF7 3334.
- No form is submitted during acceptance.

## context_delta

```json
{
  "result": "Prepared one bounded admin-direct correction restoring the existing inline CF7 2562 and its calculation modal mapping.",
  "decisions": "Kept the existing Elementor widget and CF7 definitions; countered only the proven homepage hide rule inside the existing section and restored calculation mapping 2562 while retaining callback 3334.",
  "current_status": "Ready for review and Bridge-managed snapshot, apply, read-back, rollback-safe delivery and live browser acceptance.",
  "constraints": "No direct production write, form submission, CF7 mail/storage/honeypot mutation, theme edit, media change or unrelated page change.",
  "next_step": "Merge the single PR, let Bridge apply the change-set, then verify the required pre-click DOM order and both modal close/reopen scenarios without submitting forms."
}
```
