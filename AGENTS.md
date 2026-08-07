# Agent scope

This repository is onboarding-only until Bridge returns `PROJECT_ORCHESTRATION_READY`.

Read the current canonical regulations before any technical work:

- `/var/lib/bridge-sy9/affine-pages-backup/affine/infrastructure/Регламент/1. Архитектура AFFiNE GitHub Bridge.md`
- `/var/lib/bridge-sy9/affine-pages-backup/affine/infrastructure/Регламент/2. Клиентский workflow.md`
- `/var/lib/bridge-sy9/affine-pages-backup/affine/infrastructure/Регламент/3. Автоматизация задач ChatGPT GitHub Kimi.md`
- `/var/lib/bridge-sy9/affine-pages-backup/affine/infrastructure/Регламент/4. Работа с Kimi.md`
- `/var/lib/bridge-sy9/affine-pages-backup/affine/infrastructure/Регламент/9. Работа с managed Codex.md`

Guardrails:

- Current capability: `wordpress-admin-direct` (WordPress Client Track v1 direct variant, regulation §21.4). Product changes ship only as declarative change-sets under `admin-direct/changes/` — follow `docs/ADMIN_DIRECT.md` exactly; unknown keys are rejected fail-closed and block delivery. Production target: `https://barella.pro/` (Bridge Connector write path).
- Do not create application code, executable product TASKs, DNS, deploy, or direct production writes — the Bridge `wp-admin-direct` adapter applies merged change-sets.
- `wordpress/**` theme files and `materials/**` are the frozen design/media source of truth (staging reference); they are no longer delivery inputs — never reference `barella.sy3.ru` URLs in change-set content; use existing production media URLs only.
- Never store raw secrets in this repository.
- Keep future task work on controlled `codex/*` branches and pull requests.
