<?php

$page_title   = 'Avatar Component';
$page_current = 'avatars';

$menu_items = [
  [
    'label' => 'Overview',
    'href'  => asset('/'),
  ],
  [
    'label'    => 'UI Elements',
    'children' => ui_elements_sidebar_children('avatars'),
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
<div class="flex flex-wrap items-center gap-3">
  <?= $capture('avatar', [
    'name' => 'Aisyah Ahmad',
    'size' => 'sm',
    'src'  => 'https://images.unsplash.com/photo-1487412720507-e7ab37603c6f?auto=format&fit=crop&w=200&q=80',
  ]) ?>
  <?= $capture('avatar', [
    'name' => 'Mohamad Noor',
    'src'  => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=240&q=80',
  ]) ?>
  <?= $capture('avatar', [
    'name' => 'Nur Amirah',
    'size' => 'lg',
    'src'  => 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?auto=format&fit=crop&w=260&q=80',
  ]) ?>
</div>
<?php
$avatar_sizes_content = (string) ob_get_clean();

ob_start();
?>
<div class="flex flex-wrap items-center gap-3">
  <?= $capture('avatar', [
    'name' => 'Siti Balqis',
  ]) ?>
  <?= $capture('avatar', [
    'name' => 'Farhan Hafiz',
  ]) ?>
  <?= $capture('avatar', [
    'name' => 'Nora',
  ]) ?>
  <?= $capture('avatar', [
    'name' => 'Abu',
    'size' => 'lg',
  ]) ?>
</div>
<?php
$avatar_fallback_content = (string) ob_get_clean();

ob_start();
?>
<div class="avatar-group">
    <?= $capture('avatar', [
      'name' => 'Aisyah Ahmad',
      'src'  => 'https://images.unsplash.com/photo-1488426862026-3ee34a7d66df?auto=format&fit=crop&w=180&q=80',
    ]) ?>
    <?= $capture('avatar', [
      'name' => 'Siti Balqis',
      'src'  => 'https://images.unsplash.com/photo-1438761681033-6461ffad8d80?auto=format&fit=crop&w=180&q=80',
    ]) ?>
    <?= $capture('avatar', ['name' => 'Farhan Hafiz']) ?>
    <?= $capture('avatar', [
      'fallback_text' => '+3',
      'tone_class'    => 'bg-gray-900 text-white',
      'attributes'    => [
        'aria-label' => '3 more team members',
      ],
    ]) ?>
</div>
<?php
$avatar_group_content = (string) ob_get_clean();

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
        <h1 class="mt-2 type-h1">Avatar</h1>
        <p class="mt-2 max-w-3xl type-body-muted">
          Avatar component with image and initials fallback, size variants, and group stacking.
        </p>
      </header>

      <section class="divide-y divide-gray-100" aria-label="Avatar component showcase">
        <article class="space-y-4 py-7 first:pt-0 last:pb-0">
          <header>
            <h2 class="type-h2">Size Variations</h2>
            <p class="mt-1 type-body-muted">Small, default, and large avatar scales.</p>
          </header>
          <?= $avatar_sizes_content ?>
        </article>

        <article class="space-y-4 py-7 first:pt-0 last:pb-0">
          <header>
            <h2 class="type-h2">Initials Tones</h2>
            <p class="mt-1 type-body-muted">
              Automatic background and text color combinations for fallback initials.
            </p>
          </header>
          <?= $avatar_fallback_content ?>
        </article>

        <article class="space-y-4 py-7 first:pt-0 last:pb-0">
          <header>
            <h2 class="type-h2">Avatar Group</h2>
            <p class="mt-1 type-body-muted">
              Overlapping stack pattern for team and assignee lists.
            </p>
          </header>
          <?= $avatar_group_content ?>
        </article>
      </section>
    </section>
  </main>
</div>
<?php layout('layout-end'); ?>
