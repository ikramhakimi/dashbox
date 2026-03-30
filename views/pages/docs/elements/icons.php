<?php

$page_title   = 'Icons';
$page_current = 'icons';

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

$capture_icon = static function (array $props): string {
  ob_start();
  component('icon', $props);
  return (string) ob_get_clean();
};

$icon_sizes = [16, 24, 32, 64];

$icon_paths = glob(__DIR__ . '/../../node_modules/heroicons/24/outline/*.svg');
$icon_names = [];
if (is_array($icon_paths)) {
  foreach ($icon_paths as $icon_path) {
    $icon_name = pathinfo($icon_path, PATHINFO_FILENAME);
    if (is_string($icon_name) && $icon_name !== '') {
      $icon_names[] = $icon_name;
    }
  }
}

sort($icon_names);

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
        <p class="font-semibold uppercase tracking-wide text-gray-500">UI Elements</p>
        <h1 class="text-2xl font-semibold tracking-tight text-gray-900">Icons UI Library</h1>
        <p class="mt-2 max-w-3xl text-gray-500">
          Shared icon set with reusable sizes for buttons, inputs, cards, and navigation.
        </p>
      </header>

      <section class="divide-y divide-gray-100" aria-label="Icon component showcase">
        <article class="space-y-4 py-7 first:pt-0 last:pb-0">
          <header>
            <h2 class="text-lg font-semibold text-gray-900">Icon Sizes</h2>
            <p class="mt-1 text-gray-500">Available `icon_size` values for the icon component.</p>
          </header>

          <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
            <?php foreach ($icon_sizes as $icon_size): ?>
              <div class="rounded-lg border border-gray-100 bg-white p-4">
                <p class="mb-3 font-medium text-gray-700">Size <?= e((string) $icon_size) ?></p>
                <div class="flex items-center gap-3 text-gray-700">
                  <?= $capture_icon(['icon_name' => 'activity', 'icon_size' => $icon_size]) ?>
                  <?= $capture_icon(['icon_name' => 'star', 'icon_size' => $icon_size]) ?>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
        </article>

        <article class="space-y-4 py-7 first:pt-0 last:pb-0">
          <header>
            <h2 class="text-lg font-semibold text-gray-900">Icon List</h2>
            <p class="mt-1 text-gray-500">Current icon names available in the repository.</p>
          </header>

          <div class="grid gap-3 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
            <?php foreach ($icon_names as $icon_name): ?>
              <div class="rounded-lg border border-gray-100 bg-white px-4 py-3">
                <div class="flex items-center justify-between gap-3">
                  <div class="flex items-center gap-3 text-gray-700">
                    <?= $capture_icon(['icon_name' => $icon_name, 'icon_size' => 24]) ?>
                    <span class="font-medium text-gray-900"><?= e($icon_name) ?></span>
                  </div>
                  <code class="text-gray-500">24</code>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
        </article>
      </section>
    </section>
  </main>
</div>
<?php layout('layout-end'); ?>
