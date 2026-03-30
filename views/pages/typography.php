<?php

$page_title   = 'Typography';
$page_current = 'typography';

$menu_items = [
  [
    'label' => 'Overview',
    'href'  => asset('/'),
  ],
  [
    'label'    => 'UI Elements',
    'children' => ui_elements_sidebar_children('typography'),
  ],
  [
    'label'    => 'UI Patterns',
    'children' => ui_patterns_sidebar_children(),
  ],
  [
    'label' => 'Settings',
    'href'  => '#',
  ],
];

ob_start();
?>
<div class="space-y-3">
  <p class="type-display">Display Text</p>
  <p class="type-h1">Heading 1</p>
  <p class="type-h2">Heading 2</p>
  <p class="type-h3">Heading 3</p>
</div>
<?php
$typography_headings_content = (string) ob_get_clean();

ob_start();
?>
<div class="space-y-3">
  <p class="type-body">This is the default body style for dashboard content and descriptions.</p>
  <p class="type-body-muted">This is muted body text used for secondary information and helper copy.</p>
  <p class="type-small">This is small text for compact metadata and supporting labels.</p>
  <p class="type-caption">Caption / Overline</p>
  <p class="type-body">
    Need more details?
    <a href="#" class="type-link">View documentation</a>
  </p>
</div>
<?php
$typography_body_content = (string) ob_get_clean();

layout('layout-start', [
  'page_title'   => $page_title,
  'page_current' => $page_current,
]);
?>
<div class="flex min-h-screen">
  <?php component('sidebar', ['menu_items' => $menu_items]); ?>

  <main class="content flex-1 p-4 lg:p-10">
    <section class="mx-auto max-w-7xl">
      <header class="mb-8 border-b border-gray-200 pb-6">
        <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">UI Elements</p>
        <h1 class="mt-2 text-2xl font-semibold tracking-tight text-gray-900">Typography</h1>
        <p class="mt-2 max-w-3xl text-sm text-gray-500">
          Type scale, body styles, and link treatment for consistent content hierarchy.
        </p>
      </header>

      <section class="divide-y divide-gray-100" aria-label="Typography showcase">
        <article class="space-y-4 py-7 first:pt-0 last:pb-0">
          <header>
            <h2 class="text-lg font-semibold text-gray-900">Headings Scale</h2>
            <p class="mt-1 text-sm text-gray-500">
              Display and heading hierarchy for page and section titles.
            </p>
          </header>
          <?= $typography_headings_content ?>
        </article>

        <article class="space-y-4 py-7 first:pt-0 last:pb-0">
          <header>
            <h2 class="text-lg font-semibold text-gray-900">Body, Caption, and Link</h2>
            <p class="mt-1 text-sm text-gray-500">
              Paragraph styles with inline link example for documentation references.
            </p>
          </header>
          <?= $typography_body_content ?>
        </article>
      </section>
    </section>
  </main>
</div>
<?php layout('layout-end'); ?>
