<?php

$page_title   = 'Tooltip Component';
$page_current = 'tooltips';

$menu_items = [
  [
    'label' => 'Overview',
    'href'  => asset('/'),
  ],
  [
    'label'    => 'UI Elements',
    'children' => ui_elements_sidebar_children($page_current),
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

$capture = static function (string $component_name, array $props): string {
  ob_start();
  component($component_name, $props);
  return (string) ob_get_clean();
};

ob_start();
?>
<div class="flex flex-wrap items-center gap-4">
  <?= $capture('tooltip', [
    'trigger_label' => 'Top',
    'content'       => 'Used for short helper text.',
    'placement'     => 'top',
  ]) ?>

  <?= $capture('tooltip', [
    'trigger_label' => 'Right',
    'content'       => 'Tooltip on the right side.',
    'placement'     => 'right',
  ]) ?>

  <?= $capture('tooltip', [
    'trigger_label' => 'Bottom',
    'content'       => 'Tooltip below trigger.',
    'placement'     => 'bottom',
  ]) ?>

  <?= $capture('tooltip', [
    'trigger_label' => 'Left',
    'content'       => 'Tooltip on the left side.',
    'placement'     => 'left',
  ]) ?>
</div>
<?php
$tooltip_placement_content = (string) ob_get_clean();

$icon_trigger = $capture('button', [
  'label'         => 'More info',
  'variant'       => 'ghost',
  'size'          => 'sm',
  'icon_name'     => 'activity',
  'icon_position' => 'left',
]);

ob_start();
?>
<div class="flex flex-wrap items-center gap-4">
  <?= $capture('tooltip', [
    'trigger_tag'   => 'a',
    'trigger_label' => 'API Limits',
    'trigger_href'  => '#',
    'content'       => 'Current limit is 120 requests per minute.',
    'placement'     => 'bottom',
  ]) ?>

  <?= $capture('tooltip', [
    'trigger_html' => $icon_trigger,
    'content'      => 'Shows contextual guidance without extra page space.',
    'placement'    => 'right',
  ]) ?>

  <?= $capture('tooltip', [
    'trigger_tag'   => 'span',
    'trigger_label' => 'Status',
    'content'       => 'Sync completed 2 minutes ago.',
    'placement'     => 'top',
  ]) ?>
</div>
<?php
$tooltip_trigger_content = (string) ob_get_clean();

layout('layout-start', [
  'page_title'   => $page_title,
  'page_current' => $page_current,
]);
?>
<div class="flex min-h-screen">
  <?php component('sidebar', ['menu_items' => $menu_items]); ?>

  <main class="flex-1">
    <section class="mx-auto max-w-7xl px-6 py-8 lg:px-10">
      <header class="mb-8 border-b border-gray-200 pb-6">
        <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">UI Elements</p>
        <h1 class="mt-2 text-2xl font-semibold tracking-tight text-gray-900">Tooltip</h1>
        <p class="mt-2 max-w-3xl text-sm text-gray-500">
          Lightweight helper text pattern for short hints and contextual information.
        </p>
      </header>

      <section class="space-y-7" aria-label="Tooltip component showcase">
        <?php
        component('card-module', [
          'title'       => 'Placement Variations',
          'subtitle'    => 'Top, right, bottom, and left placement options.',
          'show_graph'  => false,
          'show_footer' => false,
          'show_menu'   => false,
          'content'     => $tooltip_placement_content,
        ]);

        component('card-module', [
          'title'       => 'Trigger Variations',
          'subtitle'    => 'Supports link, custom trigger HTML, and plain text trigger.',
          'show_graph'  => false,
          'show_footer' => false,
          'show_menu'   => false,
          'content'     => $tooltip_trigger_content,
        ]);
        ?>
      </section>
    </section>
  </main>
</div>
<?php layout('layout-end'); ?>
