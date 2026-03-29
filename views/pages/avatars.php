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

  <main class="flex-1">
    <section class="mx-auto max-w-7xl px-6 py-8 lg:px-10">
      <header class="mb-8 border-b border-gray-200 pb-6">
        <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">UI Elements</p>
        <h1 class="mt-2 text-2xl font-semibold tracking-tight text-gray-900">Avatar</h1>
        <p class="mt-2 max-w-3xl text-sm text-gray-500">
          Avatar component with image and initials fallback, size variants, and group stacking.
        </p>
      </header>

      <section class="space-y-7" aria-label="Avatar component showcase">
        <?php
        component('card-module', [
          'title'       => 'Size Variations',
          'subtitle'    => 'Small, default, and large avatar scales.',
          'show_graph'  => false,
          'show_footer' => false,
          'show_menu'   => false,
          'content'     => $avatar_sizes_content,
        ]);

        component('card-module', [
          'title'       => 'Initials Tones',
          'subtitle'    => 'Automatic background and text color combinations for fallback initials.',
          'show_graph'  => false,
          'show_footer' => false,
          'show_menu'   => false,
          'content'     => $avatar_fallback_content,
        ]);

        component('card-module', [
          'title'       => 'Avatar Group',
          'subtitle'    => 'Overlapping stack pattern for team and assignee lists.',
          'show_graph'  => false,
          'show_footer' => false,
          'show_menu'   => false,
          'content'     => $avatar_group_content,
        ]);
        ?>
      </section>
    </section>
  </main>
</div>
<?php layout('layout-end'); ?>
