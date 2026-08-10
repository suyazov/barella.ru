# TASK-ISSUE-SUYAZOV_BARELLA.RU-705 — operator correction applied

## Result

The accepted scope was completed on `https://barella.pro/` on
2026-08-10 through the authenticated wp-admin/Bridge Connector operator path.
No new form, popup or media attachment was created.

- Connector was updated from 1.7.0 to 1.11.0 with an exact previous-file
  backup, version read-back and rollback-ready evidence.
- Page 3327 retained its four existing cards, names, positions, roles and
  descriptions. Only their four `img src` values and the source-equivalent
  empty `alt` values were copied from live page 2471.
- Both desktop and mobile `a.book-appointment` header links now target the
  existing company-page CF7 form 3334 at the unique anchor
  `/o-kompanii/#wpcf7-f3334-p3327-o1`.
- The home banner CTA now targets the existing calculation form 2562 at the
  unique same-page anchor `#wpcf7-f2562-p2471-o1`.

## Safety/read-back

- Company page pre-write state was captured by Connector snapshot
  `snap_101696e6a42640909481993ce2a6027b`.
- No-cache live read-back found exactly one target anchor for form 2562 on
  `/` and exactly one target anchor for form 3334 on `/o-kompanii/`.
- Header rewrite is bounded to 15 exact published business paths, exact class,
  exact visible text, exact old href and exactly two desktop/mobile matches.
- CF7 forms 845, 2562 and 3334 retain their reviewed SHA-256 values,
  recipients, individual server-side honeypots and storage policy. No test
  submission or email was sent.
- Footer/menu navigation, contacts content, DNS and media library were not
  changed.

Canonical operator evidence is stored in
`admin-direct/operator-receipts/task-issue-suyazov-barella-ru-705.json`.
