<?php

$page_title   = 'Typography';
$page_current = 'typography';

$menu_items = build_main_menu_items($page_current);

$text_token_options = [
  ['class' => 'text-dark',      'label' => 'Text Dark'],
  ['class' => 'text-body',      'label' => 'Text Body'],
  ['class' => 'text-primary',   'label' => 'Text Primary'],
  ['class' => 'text-secondary', 'label' => 'Text Secondary'],
  ['class' => 'text-muted',     'label' => 'Text Muted'],
  ['class' => 'text-success',   'label' => 'Text Success'],
  ['class' => 'text-info',      'label' => 'Text Info'],
  ['class' => 'text-warning',   'label' => 'Text Warning'],
  ['class' => 'text-danger',    'label' => 'Text Danger'],
];

$link_token_options = [
  ['class' => 'text-link',       'label' => 'Text Link'],
  ['class' => 'text-link-hover', 'label' => 'Text Link Hover'],
];

$icon_token_options = [
  ['class' => 'icon-default', 'label' => 'Icon Default'],
  ['class' => 'icon-dark',    'label' => 'Icon Dark'],
  ['class' => 'icon-muted',   'label' => 'Icon Muted'],
];

$migration_rows = [
  ['before' => 'text-gray-900',            'after' => 'text-dark / text-primary',   'scope' => 'Headings, key values, and primary emphasis'],
  ['before' => 'text-gray-700',            'after' => 'text-body',                   'scope' => 'Default body copy and standard readable text'],
  ['before' => 'text-gray-600',            'after' => 'text-secondary',              'scope' => 'Secondary supporting copy'],
  ['before' => 'text-gray-500',            'after' => 'text-muted',                  'scope' => 'Meta/helper labels and non-critical hints'],
  ['before' => 'text-emerald-700',         'after' => 'text-success',                'scope' => 'Positive outcome and success messaging'],
  ['before' => 'text-sky-700',             'after' => 'text-info',                   'scope' => 'Informational status and neutral notices'],
  ['before' => 'text-amber-700',           'after' => 'text-warning',                'scope' => 'Warning or caution state'],
  ['before' => 'text-rose-700 / -600',     'after' => 'text-danger',                 'scope' => 'Error and destructive state text'],
  ['before' => 'text-gray-600 / 900 / 400','after' => 'icon-default / dark / muted', 'scope' => 'Consistent icon color semantics'],
];

ob_start();
?>
<div class="space-y-3">
  <p class="type-display">Display Text</p>
  <p class="type-h1">Heading 1</p>
  <p class="type-h2">Heading 2</p>
  <p class="type-h3">Heading 3</p>
  <p class="type-h4">Heading 4</p>
  <p class="type-h5">Heading 5</p>
  <p class="type-h6">Heading 6</p>
</div>
<?php
$typography_headings_content = (string) ob_get_clean();

ob_start();
?>
<div class="space-y-3">
  <p class="type-body">This is the default body style for dashboard content and descriptions.</p>
  <p class="type-body-muted">This is muted body text used for secondary information and helper copy.</p>
  <p class="type-meta">This is meta text for table secondary lines and field briefs.</p>
  <p class="type-small">This is small text for compact metadata and supporting labels.</p>
  <p class="type-caption">Caption / Overline</p>
  <p class="type-body">
    Need more details?
    <a href="#" class="type-link">View documentation</a>
  </p>
</div>
<?php
$typography_body_content = (string) ob_get_clean();

layout('app-start', [
  'page_title'   => $page_title,
  'page_current' => $page_current,
]);
?>
    <section class="card">
      <header class="card__head">
        <h1 class="type-h1 mt-2">Typography</h1>
        <p class="type-body-muted mt-2 max-w-3xl">
          Type scale, body styles, and link treatment for consistent content hierarchy.
        </p>
      </header>

      <section class="card__list" aria-label="Typography showcase">
        <ul class="list">
          <li class="list__item">
            <section class="w-full max-w-4xl py-4">
        <article class="space-y-4 py-7 first:pt-0 last:pb-0">
          <header>
            <h2 class="type-h2">Headings Scale</h2>
            <p class="type-small text-muted mt-1">
              Display and heading hierarchy for page and section titles.
            </p>
          </header>
          <?= $typography_headings_content ?>
        </article>
            </section>
          </li>
          <li class="list__item">
            <section class="w-full max-w-4xl py-4">
        <article class="space-y-4 py-7 first:pt-0 last:pb-0">
          <header>
            <h2 class="type-h2">Body, Caption, and Link</h2>
            <p class="type-small text-muted mt-1">
              Paragraph styles with inline link example for documentation references.
            </p>
          </header>
          <?= $typography_body_content ?>
        </article>
            </section>
          </li>
          <li class="list__item">
            <section class="w-full max-w-4xl py-4">
        <article class="space-y-4 py-7 first:pt-0 last:pb-0">
          <header>
            <h2 class="type-h2">Font Weight Tokens</h2>
            <p class="type-small text-muted mt-1">
              Standardized weight scale for consistent visual hierarchy.
            </p>
          </header>

          <div class="overflow-x-auto">
            <table class="table">
              <thead class="table__head">
                <tr class="table__row table__row--head">
                  <th scope="col" class="table__cell table__cell--head">Weight</th>
                  <th scope="col" class="table__cell table__cell--head">Class</th>
                  <th scope="col" class="table__cell table__cell--head">Demo</th>
                  <th scope="col" class="table__cell table__cell--head">When to use</th>
                </tr>
              </thead>
              <tbody class="table__body">
                <tr class="table__row">
                  <td class="table__cell"><code>700</code></td>
                  <td class="table__cell"><code>.type-bold</code></td>
                  <td class="table__cell"><span class="type-body type-bold">Bold emphasis text</span></td>
                  <td class="table__cell">Short critical emphasis only.</td>
                </tr>
                <tr class="table__row">
                  <td class="table__cell"><code>600</code></td>
                  <td class="table__cell"><code>.type-semibold</code></td>
                  <td class="table__cell"><span class="type-body type-semibold">Semibold heading text</span></td>
                  <td class="table__cell">Headings, section titles, key values.</td>
                </tr>
                <tr class="table__row">
                  <td class="table__cell"><code>500</code></td>
                  <td class="table__cell"><code>.type-medium</code></td>
                  <td class="table__cell"><span class="type-body type-medium">Medium supporting text</span></td>
                  <td class="table__cell">Labels, button text, metadata emphasis.</td>
                </tr>
                <tr class="table__row">
                  <td class="table__cell"><code>400</code></td>
                  <td class="table__cell"><code>.type-normal</code></td>
                  <td class="table__cell"><span class="type-body type-normal">Normal readable body text</span></td>
                  <td class="table__cell">Default body and long-form content.</td>
                </tr>
              </tbody>
            </table>
          </div>
        </article>
            </section>
          </li>
          <li class="list__item">
            <section class="w-full max-w-4xl py-4">
        <article class="space-y-4 py-7 first:pt-0 last:pb-0">
          <header>
            <h2 class="type-h2">Text & Icon Color Tokens</h2>
            <p class="type-small text-muted mt-1">
              Utility tokens for consistent semantic text and icon colors across components.
            </p>
          </header>

          <div class="overflow-x-auto">
            <table class="table">
              <thead class="table__head">
                <tr class="table__row table__row--head">
                  <th scope="col" class="table__cell table__cell--head">Class</th>
                  <th scope="col" class="table__cell table__cell--head">Demo</th>
                  <th scope="col" class="table__cell table__cell--head">When to use</th>
                </tr>
              </thead>
              <tbody class="table__body">
                <tr class="table__row">
                  <td class="table__cell"><code>.text-dark</code></td>
                  <td class="table__cell"><span class="text-dark">Primary heading</span></td>
                  <td class="table__cell">Main title and high-emphasis content.</td>
                </tr>
                <tr class="table__row">
                  <td class="table__cell"><code>.text-body</code></td>
                  <td class="table__cell"><span class="text-body">Default body text</span></td>
                  <td class="table__cell">Default paragraph and field content.</td>
                </tr>
                <tr class="table__row">
                  <td class="table__cell"><code>.text-primary</code></td>
                  <td class="table__cell"><span class="text-primary">Primary emphasis</span></td>
                  <td class="table__cell">Primary semantic text state.</td>
                </tr>
                <tr class="table__row">
                  <td class="table__cell"><code>.text-secondary</code></td>
                  <td class="table__cell"><span class="text-secondary">Secondary text</span></td>
                  <td class="table__cell">Supporting content with lower emphasis.</td>
                </tr>
                <tr class="table__row">
                  <td class="table__cell"><code>.text-muted</code></td>
                  <td class="table__cell"><span class="text-muted">Muted metadata</span></td>
                  <td class="table__cell">Helper text, labels, and subtle hints.</td>
                </tr>
                <tr class="table__row">
                  <td class="table__cell"><code>.text-link</code></td>
                  <td class="table__cell"><a href="#" class="text-link">Link color</a></td>
                  <td class="table__cell">Default link color in content areas.</td>
                </tr>
                <tr class="table__row">
                  <td class="table__cell"><code>.text-link-hover</code></td>
                  <td class="table__cell"><span class="text-link-hover">Link hover tone</span></td>
                  <td class="table__cell">Hover/focus state token for links.</td>
                </tr>
                <tr class="table__row">
                  <td class="table__cell"><code>.text-success</code></td>
                  <td class="table__cell"><span class="text-success">Success state</span></td>
                  <td class="table__cell">Positive confirmations and success labels.</td>
                </tr>
                <tr class="table__row">
                  <td class="table__cell"><code>.text-info</code></td>
                  <td class="table__cell"><span class="text-info">Info state</span></td>
                  <td class="table__cell">Informational status and neutral notices.</td>
                </tr>
                <tr class="table__row">
                  <td class="table__cell"><code>.text-warning</code></td>
                  <td class="table__cell"><span class="text-warning">Warning state</span></td>
                  <td class="table__cell">Warnings and attention-needed copy.</td>
                </tr>
                <tr class="table__row">
                  <td class="table__cell"><code>.text-danger</code></td>
                  <td class="table__cell"><span class="text-danger">Danger state</span></td>
                  <td class="table__cell">Errors, destructive action text, and critical issues.</td>
                </tr>
                <tr class="table__row">
                  <td class="table__cell"><code>.icon-default</code></td>
                  <td class="table__cell">
                    <span class="icon-default inline-flex">
                      <?php component('icon', ['icon_name' => 'search', 'icon_size' => 20]); ?>
                    </span>
                  </td>
                  <td class="table__cell">Default icon tone in regular UI elements.</td>
                </tr>
                <tr class="table__row">
                  <td class="table__cell"><code>.icon-dark</code></td>
                  <td class="table__cell">
                    <span class="icon-dark inline-flex">
                      <?php component('icon', ['icon_name' => 'search', 'icon_size' => 20]); ?>
                    </span>
                  </td>
                  <td class="table__cell">High-emphasis icons near headings or key actions.</td>
                </tr>
                <tr class="table__row">
                  <td class="table__cell"><code>.icon-muted</code></td>
                  <td class="table__cell">
                    <span class="icon-muted inline-flex">
                      <?php component('icon', ['icon_name' => 'search', 'icon_size' => 20]); ?>
                    </span>
                  </td>
                  <td class="table__cell">Subtle icons for helper/secondary context.</td>
                </tr>
              </tbody>
            </table>
          </div>
        </article>
            </section>
          </li>
          <li class="list__item">
            <section class="w-full max-w-4xl py-4">
        <article class="space-y-4 py-7 first:pt-0 last:pb-0">
          <header>
            <h2 class="type-h2">Text Color Migration Guide</h2>
            <p class="type-small text-muted mt-1">
              Use this quick map to replace raw utility colors with semantic token classes.
            </p>
          </header>

          <div class="overflow-x-auto">
            <table class="table">
              <thead class="table__head">
                <tr class="table__row table__row--head">
                  <th scope="col" class="table__cell table__cell--head">Before</th>
                  <th scope="col" class="table__cell table__cell--head">After</th>
                  <th scope="col" class="table__cell table__cell--head">Scope</th>
                </tr>
              </thead>
              <tbody class="table__body">
                <?php foreach ($migration_rows as $migration_row): ?>
                  <tr class="table__row">
                    <td class="table__cell"><code><?= e($migration_row['before']) ?></code></td>
                    <td class="table__cell"><code><?= e($migration_row['after']) ?></code></td>
                    <td class="table__cell"><?= e($migration_row['scope']) ?></td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </article>
            </section>
          </li>
          <li class="list__item">
            <section class="w-full max-w-4xl py-4">
        <article class="space-y-4 py-7 first:pt-0 last:pb-0">
          <header>
            <h2 class="type-h2">Usage Do / Don’t</h2>
            <p class="type-small text-muted mt-1">
              Keep text semantics consistent so UI hierarchy remains predictable.
            </p>
          </header>

          <div class="grid gap-5 lg:grid-cols-2">
            <div class="rounded-lg border border-gray-100 bg-white p-5">
              <p class="type-caption text-success">Do</p>
              <ul class="mt-3 space-y-2">
                <li class="type-small text-body">Use <code>.text-body</code> for default long-form content.</li>
                <li class="type-small text-body">Use semantic status tokens (<code>.text-success</code>, <code>.text-danger</code>) for state messaging.</li>
                <li class="type-small text-body">Pair icon tokens with text intent (<code>.icon-muted</code> + <code>.text-muted</code>).</li>
                <li class="type-small text-body">Use <code>.text-link</code> for interactive link content.</li>
              </ul>
            </div>

            <div class="rounded-lg border border-gray-100 bg-white p-5">
              <p class="type-caption text-danger">Don’t</p>
              <ul class="mt-3 space-y-2">
                <li class="type-small text-body">Don’t use <code>.text-muted</code> for critical values.</li>
                <li class="type-small text-body">Don’t mix raw gray classes and token classes in the same content block.</li>
                <li class="type-small text-body">Don’t use status colors without semantic meaning.</li>
                <li class="type-small text-body">Don’t style non-interactive labels with link tokens.</li>
              </ul>
            </div>
          </div>
        </article>
            </section>
          </li>
          <li class="list__item">
            <section class="w-full max-w-4xl py-4">
        <article class="space-y-4 py-7 first:pt-0 last:pb-0">
          <header>
            <h2 class="type-h2">Accessibility Check</h2>
            <p class="type-small text-muted mt-1">
              Baseline checks before shipping typography and semantic color updates.
            </p>
          </header>

          <div class="rounded-lg border border-gray-100 bg-gray-50 p-5">
            <ul class="space-y-2">
              <li class="type-small text-body">Keep body text tokens at readable contrast against current backgrounds.</li>
              <li class="type-small text-body">Use muted text only for secondary/supporting information, not required actions.</li>
              <li class="type-small text-body">For status communication, pair text color with icon/badge/label to avoid color-only meaning.</li>
              <li class="type-small text-body">Ensure link states remain distinguishable in both idle and hover/focus states.</li>
            </ul>
          </div>
        </article>
            </section>
          </li>
          <li class="list__item">
            <section class="w-full max-w-4xl py-4">
        <article class="space-y-4 py-7 first:pt-0 last:pb-0" data-typography-playground>
          <header>
            <h2 class="type-h2">Live Typography Playground</h2>
            <p class="type-small text-muted mt-1">
              Test token combinations and copy class output into templates.
            </p>
          </header>

          <div class="grid gap-5 lg:grid-cols-3">
            <div class="space-y-2">
              <label class="input__label" for="typography-playground-text">Text Token</label>
              <select id="typography-playground-text" class="select__control" data-typography-playground-text>
                <?php foreach ($text_token_options as $text_token_option): ?>
                  <option value="<?= e($text_token_option['class']) ?>"<?= $text_token_option['class'] === 'text-body' ? ' selected' : '' ?>>
                    <?= e($text_token_option['label']) ?>
                  </option>
                <?php endforeach; ?>
              </select>
            </div>

            <div class="space-y-2">
              <label class="input__label" for="typography-playground-link">Link Token</label>
              <select id="typography-playground-link" class="select__control" data-typography-playground-link>
                <?php foreach ($link_token_options as $link_token_option): ?>
                  <option value="<?= e($link_token_option['class']) ?>"<?= $link_token_option['class'] === 'text-link' ? ' selected' : '' ?>>
                    <?= e($link_token_option['label']) ?>
                  </option>
                <?php endforeach; ?>
              </select>
            </div>

            <div class="space-y-2">
              <label class="input__label" for="typography-playground-icon">Icon Token</label>
              <select id="typography-playground-icon" class="select__control" data-typography-playground-icon>
                <?php foreach ($icon_token_options as $icon_token_option): ?>
                  <option value="<?= e($icon_token_option['class']) ?>"<?= $icon_token_option['class'] === 'icon-default' ? ' selected' : '' ?>>
                    <?= e($icon_token_option['label']) ?>
                  </option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>

          <div class="rounded-lg border border-gray-100 bg-white p-5">
            <div class="flex items-center gap-2">
              <span
                class="icon-default inline-flex"
                data-typography-playground-preview-icon
                data-typography-playground-icon-classes="<?= e(implode(' ', array_column($icon_token_options, 'class'))) ?>"
              >
                <?php component('icon', ['icon_name' => 'search', 'icon_size' => 20]); ?>
              </span>
              <p
                class="type-body text-body"
                data-typography-playground-preview-text
                data-typography-playground-text-classes="<?= e(implode(' ', array_column($text_token_options, 'class'))) ?>"
              >
                Preview text for current typography token selection.
              </p>
            </div>

            <p class="mt-3 type-small text-muted">
              <a
                href="#"
                class="type-link text-link"
                data-typography-playground-preview-link
                data-typography-playground-link-classes="<?= e(implode(' ', array_column($link_token_options, 'class'))) ?>"
              >
                Preview link state token
              </a>
            </p>

            <div class="mt-4 rounded-md border border-gray-100 bg-gray-50 p-3">
              <p class="type-caption">Copy Snippet</p>
              <code class="mt-2 block type-small text-secondary" data-typography-playground-code></code>
            </div>
          </div>
        </article>
            </section>
          </li>
        </ul>
      </section>
    </section>
<?php layout('app-end'); ?>
