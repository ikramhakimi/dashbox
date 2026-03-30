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
    <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">Source Module</p>
    <p class="mt-2 font-medium text-gray-900"><code>assets/js/dropzone.js</code></p>
    <p class="mt-1 text-gray-500">Drag/drop behavior, preview, and remove actions.</p>
  </div>
  <div class="py-3">
    <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">Bundle Entry</p>
    <p class="mt-2 font-medium text-gray-900"><code>assets/js/app.js</code></p>
    <p class="mt-1 text-gray-500">Initializes dropzone together with other JS components.</p>
  </div>
  <div class="py-3">
    <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">Compiled Output</p>
    <p class="mt-2 font-medium text-gray-900"><code>assets/build/app.js</code></p>
    <p class="mt-1 text-gray-500">Global minified script loaded from layout.</p>
  </div>
</div>
<?php
$upload_js_doc_content = (string) ob_get_clean();

ob_start();
?>
<div class="grid gap-6 lg:grid-cols-2">
  <div class="space-y-4">
    <?= $capture('dropzone', [
      'id'        => 'dropzone-image',
      'name'      => 'dropzone_image',
      'label'     => 'Product Photo',
      'accept'    => 'image/*',
      'help_text' => 'Supports JPG, PNG, and WEBP.',
    ]) ?>
  </div>

  <div class="space-y-4">
    <?= $capture('dropzone', [
      'id'          => 'dropzone-document',
      'name'        => 'dropzone_document',
      'label'       => 'Product Spec Sheet',
      'accept'      => '.pdf,.doc,.docx',
      'previewable' => false,
      'help_text'   => 'Upload PDF or Word file for internal reference.',
    ]) ?>
  </div>
</div>
<?php
$dropzone_default_content = (string) ob_get_clean();

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
        <h1 class="mt-2 text-2xl font-semibold tracking-tight text-gray-900">Uploads (Interactive JS Component)</h1>
        <p class="mt-2 max-w-3xl text-gray-500">
          Dropzone uploader with drag-and-drop, file preview, and remove action.
        </p>
      </header>

      <section class="divide-y divide-gray-100" aria-label="Upload component showcase">
        <article class="space-y-4 py-7 first:pt-0 last:pb-0">
          <header>
            <h2 class="text-lg font-semibold text-gray-900">JS Documentation</h2>
            <p class="mt-1 text-gray-500">
              Paths for upload interactive behavior and compiled assets.
            </p>
          </header>
          <?= $upload_js_doc_content ?>
        </article>

        <article class="space-y-4 py-7 first:pt-0 last:pb-0">
          <header>
            <h2 class="text-lg font-semibold text-gray-900">Dropzone Variations</h2>
            <p class="mt-1 text-gray-500">
              Image upload with preview and document upload without preview.
            </p>
          </header>
          <?= $dropzone_default_content ?>
        </article>
      </section>
    </section>
  </main>
</div>
<?php layout('layout-end'); ?>
