# TASK-ISSUE-SUYAZOV_BARELLA.RU-651 — CF7 honeypot

## Result

Bridge Connector 1.7.0 is active on barella.pro. The three public Contact
Form 7 forms have exactly one unique built-in Bridge honeypot:

- form 845: bridge_hp_845;
- form 2562: bridge_hp_2562;
- form 3334: bridge_hp_3334.

The Connector read-back reports server_side_honeypot_validation=true.
Honeypot fields are rendered off-screen, have no layout footprint, are
excluded from mail and stored submission fields, and a non-empty value is
rejected by the server-side CF7 spam hook before mail/storage processing.

## Verification

- authenticated CF7 read-back returned the exact honeypot name for every form;
- all three forms retain the exact recipients 2@barella.ru, 5@barella.ru, and
  barella-spb@yandex.ru;
- /o-kompanii/, /obekty/, and /kontakty/ returned HTTP 200;
- all three live pages render the hidden honeypot markup without a visible
  content change;
- no fake submission or test email was created.

The declarative change-set in
admin-direct/changes/task-issue-suyazov-barella-ru-651.json performs a
compare-and-set reconciliation of the reviewed form state and preserves the
mail configuration while normal Bridge delivery repeats live acceptance.

## context_delta

```json
{
  "result": "CF7 forms 845, 2562 and 3334 have unique server-side Bridge honeypots.",
  "decisions": "Used Bridge Connector 1.7.0 built-in honeypot; installed no third-party plugin and created no fake submission.",
  "current_status": "Implemented on production and represented by a bounded admin-direct reconciliation change-set.",
  "constraints": "Visible form markup, consent, submit labels and mail body remain unchanged.",
  "next_step": "Normal Bridge review, merge, delivery read-back and live finalization."
}
```
