# Source recovery note v2

The previous implementation based on Issue #520 incorrectly collapsed the client archive from 10 DOCX-defined objects into 8 summary cards. The original archive is authoritative for the object split and copy. This correction restores 10 independent cases and separate routes. `docs/requirements-objects-v2.md` is the recovered repo-local transcription used by the executor; photo bytes remain canonical under `materials/objects/**`.
