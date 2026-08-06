# Production pages on barella.pro — evidence record

Date: 2026-08-06 · Executor: managed operator (Bridge) · Client route: wp-admin REST (cookie+nonce), no plugin installed, no theme change.

## What was delivered

Three pages created on the client site http://barella.pro/ (clinmedix-child theme, Elementor stack) via WP REST API, reusing the site's own design system (theme grid, `theme-btn`, `team-block-one`, existing CF7 form #845 "Consult"):

| Page | URL | ID | Status |
|---|---|---|---|
| О компании | http://barella.pro/o-kompanii/ | 3327 | publish |
| Объекты | http://barella.pro/obekty/ | 3328 | publish |
| Контакты | http://barella.pro/kontakty/ | 3329 | publish |

Content source: reviewed staging pages (suyazov/barella.ru PR #1, VERIFIED_DONE on https://barella.sy3.ru/) adapted into the client theme markup. Team block replicates the home-page `clinmedix_team` widget (4 members, ТЗ roles/tenures). CTA «Давайте обсудим ваш проект» + CF7 #845 embedded on all three pages; Контакты additionally embeds the form standalone.

## Verification (2026-08-06 ~20:05 MSK)

- HTTP 200 on all three URLs; markers present: `bf-card`, `team-block-one`, `wpcf7-f845`.
- Headless-Chromium screenshots reviewed: layout native to clinmedix (header/nav/footer untouched), no console-breaking markup, responsive grid via scoped `bf-*` styles.
- Probe draft page (id 3326) trashed; no other site content, menus, options, plugins or theme files modified.

## Known gaps / follow-ups

- Object photos: client archive (cloud.mail.ru stock link) was not machine-accessible at execution time; cards carry a note «фотографии публикуются после передачи финального архива». Photo sync = separate task via REST media upload.
- Pre-existing inconsistency on the client home page (not ours): team widget says «Опыт работы 12 лет» for Кулгин; ТЗ says 13 лет. Left untouched — owner decision.
- barella.ru/kontakty reference structure mapped as: контакты → форма → CTA (matches).
