# AGENTS.md

## Purpose
This repository must follow strict production-ready engineering standards.
When making any change, prioritize maintainability, readability, accessibility, safety, and consistency with the existing architecture.

## Core rules
- Do not introduce breaking changes unless explicitly asked.
- Do not rewrite large unrelated areas of code.
- Do not add dependencies unless necessary and justified.
- Do not create duplicate utilities, components, or patterns when an existing one can be reused.
- Prefer small, focused diffs.
- Follow existing architecture unless explicitly asked to improve or refactor it.
- Run in hardening mode by default: complete each change with explicit verification before considering it done.
- STRICT: When adding a new UI component feature or a new variant/state, always update the corresponding demo page in the same change.
- STRICT: Do not leave component variants undocumented in UI demos. Every supported variant/state must be visible in at least one demo page.

## Code quality standard
- Write code suitable for a senior-level production codebase.
- Favor clarity over cleverness.
- Use descriptive naming.
- Keep functions small and single-purpose.
- Avoid deep nesting; prefer guard clauses.
- Remove dead code and obvious duplication when touching related files.
- Keep public APIs stable unless explicitly changing them.
- Do not introduce placeholder logic in production code unless clearly marked and justified.

## Architecture rules
- Follow the existing project structure and naming conventions.
- Reuse shared helpers, components, constants, and types before creating new ones.
- Keep business logic out of UI templates/components where possible.
- Separate concerns clearly:
  - UI/presentation
  - state/data handling
  - business rules
  - utilities/helpers
- No premature abstractions.
- No broad refactors unless requested.

## Indentation & formatting rules
- Use **2 spaces** for indentation.
- Do not use tabs.
- Never mix tabs and spaces.
- Indentation must be consistent across the entire file.

## CSS Naming Convention (BEM)

This project uses **BEM (Block, Element, Modifier)** methodology for all CSS class naming.

BEM is mandatory for all reusable UI components and must remain consistent across the entire codebase.

## CSS Hygiene
- Do not add unnecessary CSS rules. Prefer utility classes and existing component styles first.
- Remove obsolete CSS immediately when the related markup/layout changes.
- Avoid broad selectors that affect unrelated elements; scope styles to the component block only.
- For reusable status/pill UI, use a generic `badge.php` component and express variants via modifiers (e.g. `badge--positive`, `badge--negative`, `badge--neutral`).
- Tailwind styles must be authored in `assets/css/app.css` using `@tailwind base;`, `@tailwind components;`, and `@tailwind utilities;`.
- Place reusable utility abstractions inside `@layer components` and keep them minimal.
- Always serve compiled CSS from `assets/build/app.css`; do not rely on Tailwind CDN runtime scripts in templates.
- Keep Tailwind `content` paths up to date (e.g. `views/**/*.php`) so utilities are generated correctly.
- Keep Tailwind `safelist` up to date for any dynamic classes generated from helpers/modifiers (e.g. `$component_class`, state/modifier classes).

## Verification And Validation
- For UI/template/CSS changes, always run syntax/lint checks for touched PHP files.
- Rebuild CSS after style/config updates and verify build output is generated successfully.
- For class/filename refactors, verify references are fully updated (no stale names remain).
- Before finalizing, report exactly what was verified (not only what was changed).

---

## Core format

- Block: `.block`
- Element: `.block__element`
- Modifier: `.block--modifier`

Example:
```html
<div class="card">
  <h2 class="card__title">Title</h2>
  <p class="card__desc">Description</p>
  <button class="card__button card__button--primary">Click</button>
</div>
```

## BEM + Filename Convention

### Base rule
- Each component file represents a **BEM block**
- File name defines the block and optional modifier

---

## Filename structure

Format:
- `block.php`
- `block-variant.php`

Examples:
- `card.php` → `.card`
- `card-package.php` → `.card.card--package`
- `button-primary.php` → `.button.button--primary`

---

## Mapping rules

- First segment = **block**
- Second segment (if exists) = **modifier**

Example:

File:
Output:
```html
<div class="card card--package">
```

## Component Helper System

This project uses a helper-based component system from `includes/functions.php`.

### Required helper usage
- Render reusable UI using `component('<name>', $data)`
- Do not include component files manually
- Do not duplicate component markup across templates

### Root class generation
- Every component must use auto-generated root classes from the helper
- Root class must be printed using `$component_class`

Example:
```php
<div class="<?= e($component_class) ?>">
  component('card-package', [
  'states' => [
    'active' => true,
    'featured' => true,
  ],
]);
```

Output Root Class
```html
<div class="card card--package card--active card--featured">
```


## PHP Naming And Formatting
- Use snake_case for PHP variables. 
- For page templates, use: 
- $page_title 
- $page_current 
- Align = for related assignment blocks in PHP code at any position (top, middle, or bottom of templates/components). 
- Align => for related associative array/object-style blocks in PHP code at any position (top, middle, or bottom of templates/components). 
- Example:

  php
  $page_title   = 'Home';
  $page_current = 'home';

## Template Conventions 
- Use helper-based templating from includes/functions.php: 
  - layout('layout-start', ['page_title' => $page_title, 'page_current' => $page_current]); 
  - component('footer'); (when needed) 
  - layout('layout-end'); 
- Keep layout files under views/layout and components under views/components. 
- Keep navigation as real links (href) for SEO and accessibility.
- When adding a new demo page, update sidebar/menu links so the page is reachable from existing UI demo pages.

### Blocks
- Always indent inside:
  - functions
  - conditionals
  - loops
  - objects and arrays
  - HTML/template nesting
- Closing braces must align with the opening statement.

### Line length
- Prefer a maximum line length of 100–120 characters.
- Break long expressions into multiple lines when needed.

### Nested structures
- Avoid deep nesting greater than 3 levels when possible.
- Use early returns and guard clauses to reduce indentation depth.

### Arrays and objects
- Use multi-line formatting when:
  - there are more than 2–3 properties/items
  - or the line would exceed the project line-length preference
- Use trailing commas in multi-line arrays/objects where valid.

Example:
```js
const config = {
  api_url: BASE_URL,
  timeout: 5000,
  retries: 3,
};
