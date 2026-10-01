# AGENTS.md

## Project overview
Single-file PHP app (`index.php`) that prints "¡Hola, Mundo!". No framework, no dependencies, no database.

## Running
- `docker compose -f docker-compose.base44.yml up -d` starts the PHP built-in server on port 3000.
- The source is bind-mounted, so edits to `index.php` are reflected on the next page refresh (no live-reload dev server; PHP's built-in server serves files directly).

## Verifying
- `curl http://localhost:3000/` should return `¡Hola, Mundo!`.

## Secrets
- None required.
