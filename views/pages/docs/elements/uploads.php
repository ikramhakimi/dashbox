<?php

$page_title   = 'Uploads (Interactive JS Component)';
$page_current = 'uploads';

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
<div class="grid gap-3 md:grid-cols-3">
  <div class="py-3">
    <p class="type-caption type-semibold">Source Module</p>
    <p class="mt-2 type-medium text-dark"><code>assets/js/dropzone.js</code></p>
    <p class="mt-1 text-muted">Drag/drop behavior, preview, and remove actions.</p>
  </div>
  <div class="py-3">
    <p class="type-caption type-semibold">Bundle Entry</p>
    <p class="mt-2 type-medium text-dark"><code>assets/js/app.js</code></p>
    <p class="mt-1 text-muted">Initializes dropzone together with other JS components.</p>
  </div>
  <div class="py-3">
    <p class="type-caption type-semibold">Compiled Output</p>
    <p class="mt-2 type-medium text-dark"><code>assets/build/app.js</code></p>
    <p class="mt-1 text-muted">Global minified script loaded from layout.</p>
  </div>
</div>
<?php
$upload_js_doc_content = (string) ob_get_clean();

ob_start();
?>
<div class="grid gap-6 lg:grid-cols-2">
  <div class="space-y-4">
    <?= $capture('dropzone', [
      'id'        => 'dropzone-single-photo',
      'name'      => 'single_photo',
      'label'     => 'Package Main Photo',
      'accept'    => 'image/*',
      'help_text' => 'Single mode: one file, one large preview, replace on new upload.',
    ]) ?>
  </div>

  <div class="space-y-4">
    <?= $capture('dropzone', [
      'id'               => 'dropzone-multi-gallery',
      'name'             => 'gallery_photos[]',
      'label'            => 'Package Gallery Photos (Max 10)',
      'accept'           => 'image/*',
      'multiple'         => true,
      'sortable'         => true,
      'max_files'        => 10,
      'order_input_name' => 'gallery_photos_order',
      'help_text'        => 'Multi mode: thumbnails, remove per item, drag-sort, max 10 files.',
    ]) ?>
  </div>
</div>
<?php
$dropzone_default_content = (string) ob_get_clean();

ob_start();
?>
<div class="grid gap-4 md:grid-cols-2">
  <div class="rounded-md border border-gray-200 p-4">
    <p class="type-medium text-dark"><code>multiple</code></p>
    <p class="mt-1 text-muted">Enable multi-file mode with thumbnail grid.</p>
  </div>
  <div class="rounded-md border border-gray-200 p-4">
    <p class="type-medium text-dark"><code>max_files</code></p>
    <p class="mt-1 text-muted">Optional file limit for multi mode.</p>
  </div>
  <div class="rounded-md border border-gray-200 p-4">
    <p class="type-medium text-dark"><code>previewable</code></p>
    <p class="mt-1 text-muted">Turn image preview on or off.</p>
  </div>
  <div class="rounded-md border border-gray-200 p-4">
    <p class="type-medium text-dark"><code>sortable</code></p>
    <p class="mt-1 text-muted">Enable drag-sort for multi mode.</p>
  </div>
  <div class="rounded-md border border-gray-200 p-4 md:col-span-2">
    <p class="type-medium text-dark"><code>order_input_name</code></p>
    <p class="mt-1 text-muted">
      Hidden input metadata for file order persistence in multi mode.
    </p>
  </div>
</div>
<?php
$image_uploaders_content = (string) ob_get_clean();

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
        <p class="type-caption type-semibold">UI Elements</p>
        <h1 class="mt-2 type-h1">Uploads (Interactive JS Component)</h1>
        <p class="mt-2 max-w-3xl text-muted">
          Dropzone uploader with drag-and-drop, file preview, and remove action.
        </p>
      </header>

      <section class="divide-y divide-gray-100" aria-label="Upload component showcase">
        <article class="space-y-4 py-7 first:pt-0 last:pb-0">
          <header>
            <h2 class="type-h2">JS Documentation</h2>
            <p class="mt-1 text-muted">
              Paths for upload interactive behavior and compiled assets.
            </p>
          </header>
          <?= $upload_js_doc_content ?>
        </article>

        <article class="space-y-4 py-7 first:pt-0 last:pb-0">
          <header>
            <h2 class="type-h2">Dropzone Modes</h2>
            <p class="mt-1 text-muted">
              Single and multi upload modes using one dropzone component.
            </p>
          </header>
          <?= $dropzone_default_content ?>
        </article>

        <article class="space-y-4 py-7 first:pt-0 last:pb-0">
          <header>
            <h2 class="type-h2">Dropzone API Props</h2>
            <p class="mt-1 text-muted">
              Props used for single photo, multi photo, and sortable gallery setup.
            </p>
          </header>
          <?= $image_uploaders_content ?>
        </article>
      </section>
    </section>
  </main>
</div>
<?php layout('layout-end'); ?>
