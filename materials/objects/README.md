# Barella media ingress

Канонический web-ready пакет для `suyazov/barella.ru`.

Контракт:
- в git входят только web-ready JPG, max edge 2048 px;
- <=20 MB на объект, <=100 MB на проект;
- `manifest.json` фиксирует source/web SHA-256, размеры, MIME и назначение;
- executor использует только `materials/objects/<object>/`;
- внешние Cloud/chat/Figma источники не используются как runtime source;
- оригиналы остаются вне git в каноническом архиве / server inbox.
