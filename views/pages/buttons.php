<?php

$page_title   = 'Buttons';
$page_current = 'buttons';

$menu_items = [
  [
    'label' => 'Overview',
    'href'  => asset('/'),
  ],
  [
    'label'    => 'UI Elements',
    'children' => [
      [
        'label'  => 'Buttons',
        'href'   => asset('/buttons'),
        'active' => true,
      ],
      [
        'label'  => 'Cards',
        'href'   => asset('/cards'),
        'active' => false,
      ],
      [
        'label'  => 'Badges',
        'href'   => asset('/badges'),
        'active' => false,
      ],
      [
        'label'  => 'Inputs',
        'href'   => asset('/inputs'),
        'active' => false,
      ],
    ],
  ],
  [
    'label' => 'Settings',
    'href'  => '#',
  ],
];

$capture_button = static function (array $props): string {
  ob_start();
  component('button', $props);
  return (string) ob_get_clean();
};

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
        <h1 class="text-2xl font-semibold tracking-tight text-gray-900">Button UI Library</h1>
        <p class="mt-1 text-sm text-gray-500">
          Centralized showcase for all button variants, sizes, and interaction states.
        </p>
      </header>

      <section class="mb-6">
        <?php
        component('card-module', [
          'title'       => 'Variants',
          'subtitle'    => 'Primary, neutral, ghost, and danger buttons.',
          'show_graph'  => false,
          'show_footer' => false,
          'show_menu'   => false,
          'content'     => '
            <div class="grid gap-4 md:grid-cols-2">
              <div class="rounded-lg border border-gray-100 bg-white p-4">
                <p class="mb-3 text-xs font-semibold uppercase tracking-wide text-gray-500">Primary</p>
                <div class="flex flex-wrap gap-2">
                  ' . $capture_button(['label' => 'Primary', 'variant' => 'primary']) . '
                  ' . $capture_button(['label' => 'Primary Link', 'variant' => 'primary', 'href' => '#']) . '
                </div>
              </div>
              <div class="rounded-lg border border-gray-100 bg-white p-4">
                <p class="mb-3 text-xs font-semibold uppercase tracking-wide text-gray-500">Neutral</p>
                <div class="flex flex-wrap gap-2">
                  ' . $capture_button(['label' => 'Neutral', 'variant' => 'neutral']) . '
                  ' . $capture_button(['label' => 'Neutral Link', 'variant' => 'neutral', 'href' => '#']) . '
                </div>
              </div>
              <div class="rounded-lg border border-gray-100 bg-white p-4">
                <p class="mb-3 text-xs font-semibold uppercase tracking-wide text-gray-500">Ghost</p>
                <div class="flex flex-wrap gap-2">
                  ' . $capture_button(['label' => 'Ghost', 'variant' => 'ghost']) . '
                  ' . $capture_button(['label' => 'Ghost Link', 'variant' => 'ghost', 'href' => '#']) . '
                </div>
              </div>
              <div class="rounded-lg border border-gray-100 bg-white p-4">
                <p class="mb-3 text-xs font-semibold uppercase tracking-wide text-gray-500">Danger</p>
                <div class="flex flex-wrap gap-2">
                  ' . $capture_button(['label' => 'Danger', 'variant' => 'danger']) . '
                  ' . $capture_button(['label' => 'Danger Link', 'variant' => 'danger', 'href' => '#']) . '
                </div>
              </div>
            </div>',
        ]);
        ?>
      </section>

      <section class="mb-6">
        <?php
        component('card-module', [
          'title'       => 'Sizes',
          'subtitle'    => 'Size scale across all supported sizes.',
          'show_graph'  => false,
          'show_footer' => false,
          'show_menu'   => false,
          'content'     => '
            <div class="rounded-lg border border-gray-100 bg-white p-4">
              <div class="flex flex-wrap items-center gap-2">
                ' . $capture_button(['label' => 'Button', 'variant' => 'primary', 'size' => 'sm']) . '
                ' . $capture_button(['label' => 'Button', 'variant' => 'primary', 'size' => 'md']) . '
                ' . $capture_button(['label' => 'Button', 'variant' => 'primary', 'size' => 'lg']) . '
              </div>
            </div>',
        ]);
        ?>
      </section>

      <section>
        <?php
        component('card-module', [
          'title'       => 'States',
          'subtitle'    => 'Default and disabled states.',
          'show_graph'  => false,
          'show_footer' => false,
          'show_menu'   => false,
          'content'     => '
            <div class="rounded-lg border border-gray-100 bg-white p-4">
              <div class="flex flex-wrap items-center gap-2">
                ' . $capture_button(['label' => 'Enabled', 'variant' => 'neutral']) . '
                ' . $capture_button(['label' => 'Disabled', 'variant' => 'neutral', 'disabled' => true]) . '
                ' . $capture_button(['label' => 'Disabled Link', 'variant' => 'ghost', 'href' => '#', 'disabled' => true]) . '
              </div>
            </div>',
        ]);
        ?>
      </section>

      <section class="mt-6">
        <?php
        component('card-module', [
          'title'       => 'Icon Variations',
          'subtitle'    => 'Icon + text, text + icon, and icon-only button patterns.',
          'show_graph'  => false,
          'show_footer' => false,
          'show_menu'   => false,
          'content'     => '
            <div class="grid gap-4 md:grid-cols-3">
              <div class="rounded-lg border border-gray-100 bg-white p-4">
                <p class="mb-3 text-xs font-semibold uppercase tracking-wide text-gray-500">Icon + Text</p>
                <div class="flex flex-wrap items-center gap-2">
                  ' . $capture_button([
                    'label'      => 'Add New',
                    'variant'    => 'primary',
                    'icon_name'  => 'plus',
                    'icon_position' => 'left',
                  ]) . '
                </div>
              </div>
              <div class="rounded-lg border border-gray-100 bg-white p-4">
                <p class="mb-3 text-xs font-semibold uppercase tracking-wide text-gray-500">Text + Icon</p>
                <div class="flex flex-wrap items-center gap-2">
                  ' . $capture_button([
                    'label'         => 'View Team',
                    'variant'       => 'neutral',
                    'icon_name'     => 'users',
                    'icon_position' => 'right',
                  ]) . '
                </div>
              </div>
              <div class="rounded-lg border border-gray-100 bg-white p-4">
                <p class="mb-3 text-xs font-semibold uppercase tracking-wide text-gray-500">Icon Only</p>
                <div class="flex flex-wrap items-center gap-2">
                  ' . $capture_button([
                    'label'      => 'Open Tickets',
                    'aria_label' => 'Open Tickets',
                    'variant'    => 'ghost',
                    'icon_name'  => 'ticket',
                    'icon_only'  => true,
                    'size'       => 'md',
                  ]) . '
                </div>
              </div>
            </div>',
        ]);
        ?>
      </section>
    </section>
  </main>
</div>
<?php layout('layout-end'); ?>
