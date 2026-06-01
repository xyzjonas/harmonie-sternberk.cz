# Harmonie Šternberk Website

Simple Astro-based website for Harmonie Šternberk symphonic wind orchestra.

## Structure

**3 main pages:**
1. Landing page (`/`) - shows upcoming events
2. Orchestra page (`/orchestra`) - about the orchestra, history, and achievements
3. Events listing (`/events`) - all events with individual event detail pages

## Content Management

Events are managed via markdown files in `src/content/events/`. Each event has:

- `title` - Event name
- `description` - Short description
- `datetime` - Event date and time
- `location` - Event location (optional)
- Content - Full event details in markdown

### Adding a new event

Create a new `.md` file in `src/content/events/`:

```md
---
title: 'Event Name'
description: 'Short description'
datetime: 2026-12-20T18:00:00
location: 'Location name'
---

Full event details in markdown...
```

## Commands

| Command                   | Action                                           |
| :------------------------ | :----------------------------------------------- |
| `npm install`             | Installs dependencies                            |
| `npm run dev`             | Starts local dev server at `localhost:4321`      |
| `npm run build`           | Build your production site to `./dist/`          |
| `npm run preview`         | Preview your build locally, before deploying     |

## Design

Follows the design spec in `/specs/001-init.md`:
- Color palette based on brand red (#e3051a)
- Clean, minimal design with generous spacing
- Modern classical aesthetic
- EB Garamond for headings (via local fonts)

## Migration from Vue.js SPA

Content has been migrated from the legacy Vue.js application in `/src/views/`:
- Home page carousel and events → Landing page
- Orchestra info → Orchestra page  
- Program → Events system with markdown files
