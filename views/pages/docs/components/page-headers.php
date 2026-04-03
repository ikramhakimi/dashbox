<?php

$page_title   = 'Page Header Component';
$page_current = 'page-headers';

$menu_items = build_main_menu_items($page_current);

$capture = static function (string $component_name, array $props): string {
  ob_start();
  component($component_name, $props);
  return (string) ob_get_clean();
};

ob_start();
?>
<?= $capture('page-header', [
  'title'       => 'Layout Contract: Main + Actions',
  'description' => 'This sample intentionally uses a longer description so the main block becomes taller. Actions stay anchored to the bottom-right edge.',
  'breadcrumb_items' => [
    ['label' => 'Home', 'href' => asset('/')],
    ['label' => 'Design System', 'href' => '#'],
    ['label' => 'Page Header'],
  ],
  'actions' => [
    ['label' => 'Cancel', 'size' => 'sm'],
    ['label' => 'Save Changes', 'variant' => 'primary', 'size' => 'sm'],
  ],
  'actions_html' => $capture('dropdown', [
    'trigger_label'     => 'More',
    'trigger_size'      => 'sm',
    'items'             => [
      ['label' => 'Duplicate', 'href' => '#'],
      ['label' => 'Archive', 'href' => '#'],
      ['type' => 'divider'],
      ['label' => 'Delete', 'href' => '#', 'kind' => 'danger'],
    ],
  ]),
  'actions_html_trusted' => true,
]) ?>
<?php
$page_header_layout_content = (string) ob_get_clean();

layout('app-start', [
  'page_title'   => $page_title,
  'page_current' => $page_current,
]);
?>
    <section class="card">
      <header class="card__head">
        <h1 class="mt-2 type-h1">Page Header</h1>
        <p class="mt-2 max-w-3xl text-muted">
          Reusable top section for page title, supporting context, breadcrumbs, and actions.
        </p>
      </header>

      <section class="card__list" aria-label="Page header component showcase">
        <ul class="list">
          <li class="list__item">
            <section class="w-full max-w-4xl py-4">
        <article class="space-y-4 py-7 first:pt-0 last:pb-0">
          <header>
            <h2 class="type-h2">Main + Actions Layout</h2>
            <p class="mt-1 text-muted">
              Explicit demo: actions stay bottom-right while main section grows.
            </p>
          </header>
          <?= $page_header_layout_content ?>
        </article>
            </section>
          </li>
        </ul>
      </section>
    </section>
<?php layout('app-end'); ?>
