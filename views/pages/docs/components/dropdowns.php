<?php

$page_title   = 'Dropdown (Interactive JS Component)';
$page_current = 'dropdowns';

$menu_items = build_main_menu_items($page_current);

$capture = static function (string $component_name, array $props): string {
  ob_start();
  component($component_name, $props);
  return (string) ob_get_clean();
};

ob_start();
?>
<div class="flex flex-wrap items-center gap-3">
  <?= $capture('dropdown', [
    'trigger_label' => 'Actions',
    'items'         => [
      ['label' => 'View details', 'href' => '#'],
      ['label' => 'Edit record', 'href' => '#'],
      ['type' => 'divider'],
      ['label' => 'Archive', 'href' => '#'],
      ['label' => 'Delete', 'href' => '#', 'kind' => 'danger'],
    ],
  ]) ?>

  <?= $capture('dropdown', [
    'trigger_label' => 'Menu',
    'align'         => 'left',
    'items'         => [
      ['type' => 'label', 'label' => 'Workspace'],
      ['label' => 'Team settings', 'href' => '#'],
      ['label' => 'Billing', 'href' => '#'],
      ['type' => 'divider'],
      ['label' => 'Disabled action', 'href' => '#', 'disabled' => true],
    ],
  ]) ?>
</div>
<?php
$dropdown_default_content = (string) ob_get_clean();

ob_start();
?>
<div class="flex flex-wrap items-center gap-3">
  <?= $capture('dropdown', [
    'trigger_label'     => 'Quick actions',
    'trigger_icon_name' => 'plus',
    'items'             => [
      ['label' => 'Create user', 'href' => '#', 'icon_name' => 'users'],
      ['label' => 'Open tickets', 'href' => '#', 'icon_name' => 'ticket'],
      ['label' => 'Pulse report', 'href' => '#', 'icon_name' => 'activity'],
    ],
  ]) ?>

  <?= $capture('dropdown', [
    'trigger_label'     => 'More options',
    'icon_only'         => true,
    'trigger_icon_name' => 'plus',
    'items'             => [
      ['label' => 'Pin to top', 'href' => '#'],
      ['label' => 'Duplicate', 'href' => '#'],
      ['type' => 'divider'],
      ['label' => 'Delete', 'href' => '#', 'kind' => 'danger'],
    ],
  ]) ?>
</div>
<?php
$dropdown_trigger_content = (string) ob_get_clean();

ob_start();
?>
<div class="flex flex-wrap items-center gap-3">
  <?= $capture('dropdown', [
    'trigger_label' => 'Small',
    'trigger_size'  => 'sm',
    'items'         => [
      ['label' => 'Open', 'href' => '#'],
      ['label' => 'Edit', 'href' => '#'],
    ],
  ]) ?>

  <?= $capture('dropdown', [
    'trigger_label' => 'Default',
    'trigger_size'  => 'md',
    'items'         => [
      ['label' => 'Open', 'href' => '#'],
      ['label' => 'Edit', 'href' => '#'],
    ],
  ]) ?>

  <?= $capture('dropdown', [
    'trigger_label' => 'Large',
    'trigger_size'  => 'lg',
    'items'         => [
      ['label' => 'Open', 'href' => '#'],
      ['label' => 'Edit', 'href' => '#'],
    ],
  ]) ?>

  <?= $capture('dropdown', [
    'trigger_label'     => 'Icon Small',
    'trigger_size'      => 'sm',
    'icon_only'         => true,
    'trigger_icon_name' => 'plus',
    'items'             => [
      ['label' => 'Create item', 'href' => '#'],
      ['label' => 'Import data', 'href' => '#'],
    ],
  ]) ?>
</div>
<?php
$dropdown_size_content = (string) ob_get_clean();

ob_start();
?>
<div class="flex flex-wrap items-center gap-3">
  <?= $capture('dropdown', [
    'trigger_tag'   => 'a',
    'trigger_label' => 'Open workspace',
    'trigger_href'  => '#workspace',
    'items'         => [
      ['label' => 'Workspace overview', 'href' => '#'],
      ['label' => 'Members', 'href' => '#'],
      ['label' => 'Billing', 'href' => '#'],
    ],
  ]) ?>

  <?= $capture('dropdown', [
    'trigger_tag'     => 'a',
    'trigger_label'   => 'More actions',
    'trigger_href'    => '#actions',
    'items'           => [
      ['label' => 'Duplicate', 'href' => '#'],
      ['label' => 'Export', 'href' => '#'],
      ['type' => 'divider'],
      ['label' => 'Delete', 'href' => '#', 'kind' => 'danger'],
    ],
  ]) ?>
</div>
<?php
$dropdown_link_content = (string) ob_get_clean();

ob_start();
?>
<nav class="border-b border-gray-200 pb-2" aria-label="Navigation dropdown demo">
  <div class="flex flex-wrap items-center gap-1">
    <?= $capture('dropdown', [
      'trigger_tag'   => 'a',
      'trigger_label' => 'Dashboard',
      'trigger_href'  => '/dashboards',
      'align'         => 'left',
      'items'         => [
        ['label' => 'Overview', 'href' => '#'],
        ['label' => 'Sales', 'href' => '#'],
        ['label' => 'Customers', 'href' => '#'],
      ],
    ]) ?>
    <?= $capture('dropdown', [
      'trigger_tag'   => 'a',
      'trigger_label' => 'Products',
      'trigger_href'  => '/products',
      'align'         => 'left',
      'items'         => [
        ['label' => 'All products', 'href' => '#'],
        ['label' => 'Categories', 'href' => '#'],
        ['label' => 'Inventory', 'href' => '#'],
      ],
    ]) ?>
    <?= $capture('dropdown', [
      'trigger_tag'   => 'a',
      'trigger_label' => 'Settings',
      'trigger_href'  => '/settings',
      'align'         => 'left',
      'items'         => [
        ['label' => 'Team', 'href' => '#'],
        ['label' => 'Roles', 'href' => '#'],
        ['label' => 'API keys', 'href' => '#'],
      ],
    ]) ?>
  </div>
</nav>
<?php
$dropdown_navigation_content = (string) ob_get_clean();

ob_start();
?>
<div class="grid gap-3 md:grid-cols-3">
  <div class="py-3">
    <p class="type-caption type-semibold">Source Module</p>
    <p class="mt-2 type-body type-medium text-dark"><code>assets/js/dropdown.js</code></p>
    <p class="mt-1 type-small text-muted">Dropdown behavior and outside-click dismiss logic.</p>
  </div>
  <div class="py-3">
    <p class="type-caption type-semibold">Bundle Entry</p>
    <p class="mt-2 type-body type-medium text-dark"><code>assets/js/app.js</code></p>
    <p class="mt-1 type-small text-muted">Single entry that initializes submenu, dropdown, and modal.</p>
  </div>
  <div class="py-3">
    <p class="type-caption type-semibold">Compiled Output</p>
    <p class="mt-2 type-body type-medium text-dark"><code>assets/build/app.js</code></p>
    <p class="mt-1 type-small text-muted">Minified production script loaded globally in layout.</p>
  </div>
</div>
<?php
$dropdown_js_doc_content = (string) ob_get_clean();

layout('app-start', [
  'page_title'   => $page_title,
  'page_current' => $page_current,
]);
?>
    <section class="card">
      <header class="card__head">
        <h1 class="mt-2 type-h1">Dropdown (Interactive JS Component)</h1>
        <p class="mt-2 max-w-3xl type-body-muted">
          Reusable dropdown menu for action lists, row menus, and account navigation.
        </p>
      </header>

      <section class="card__list" aria-label="Dropdown component showcase">
        <ul class="list">
          <li class="list__item">
            <section class="w-full max-w-4xl py-4">
        <article class="space-y-4 py-7 first:pt-0 last:pb-0">
          <header>
            <h2 class="type-h2">JS Documentation</h2>
            <p class="mt-1 type-body-muted">
              Implementation paths for dropdown interactive behavior.
            </p>
          </header>
          <?= $dropdown_js_doc_content ?>
        </article>
            </section>
          </li>
          <li class="list__item">
            <section class="w-full max-w-4xl py-4">
        <article class="space-y-4 py-7 first:pt-0 last:pb-0">
          <header>
            <h2 class="type-h2">Default Dropdown</h2>
            <p class="mt-1 type-body-muted">
              Button trigger with dividers, labels, disabled and danger actions.
            </p>
          </header>
          <?= $dropdown_default_content ?>
        </article>
            </section>
          </li>
          <li class="list__item">
            <section class="w-full max-w-4xl py-4">
        <article class="space-y-4 py-7 first:pt-0 last:pb-0">
          <header>
            <h2 class="type-h2">Trigger Variations</h2>
            <p class="mt-1 type-body-muted">
              Neutral style, icon+text trigger, and icon-only trigger.
            </p>
          </header>
          <?= $dropdown_trigger_content ?>
        </article>
            </section>
          </li>
          <li class="list__item">
            <section class="w-full max-w-4xl py-4">
        <article class="space-y-4 py-7 first:pt-0 last:pb-0">
          <header>
            <h2 class="type-h2">Button Size Variations</h2>
            <p class="mt-1 type-body-muted">
              Dropdown trigger reuses button tokens: sm, default, lg, including icon-only.
            </p>
          </header>
          <?= $dropdown_size_content ?>
        </article>
            </section>
          </li>
          <li class="list__item">
            <section class="w-full max-w-4xl py-4">
        <article class="space-y-4 py-7 first:pt-0 last:pb-0">
          <header>
            <h2 class="type-h2">Link Trigger Dropdown</h2>
            <p class="mt-1 type-body-muted">
              Use anchor trigger while keeping JS toggle and outside-click dismiss.
            </p>
          </header>
          <?= $dropdown_link_content ?>
        </article>
            </section>
          </li>
          <li class="list__item">
            <section class="w-full max-w-4xl py-4">
        <article class="space-y-4 py-7 first:pt-0 last:pb-0">
          <header>
            <h2 class="type-h2">Navigation Dropdown</h2>
            <p class="mt-1 type-body-muted">Simple link-style trigger for navigation groups.</p>
          </header>
          <?= $dropdown_navigation_content ?>
        </article>
            </section>
          </li>
        </ul>
      </section>
    </section>
<?php layout('app-end'); ?>
