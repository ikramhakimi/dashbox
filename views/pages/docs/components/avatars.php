<?php

$page_title   = 'Avatar Component';
$page_current = 'avatars';

$menu_items = build_main_menu_items($page_current);

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

layout('app-start', [
  'page_title'   => $page_title,
  'page_current' => $page_current,
]);
?>
    <section class="card">
      <header class="card__head">
        <h1 class="mt-2 type-h1">Avatar UI Component</h1>
        <p class="mt-2 max-w-3xl text-muted">
          Use avatars to represent customers, team members, and ownership context with consistent fallback behavior.
        </p>
      </header>

      <section class="card__list" aria-label="Avatar component showcase">
        <ul class="list">
          <li class="list__item">
            <section class="w-full max-w-4xl py-4">
              <h3 class="type-h3">Size Variations</h3>
              <p class="mb-4 text-muted">
                Use <code>sm</code> in dense tables, default in cards/forms, and <code>lg</code> for profile-focused surfaces.
              </p>
              <?= $avatar_sizes_content ?>
            </section>
          </li>

          <li class="list__item">
            <section class="w-full max-w-4xl py-4">
              <h3 class="type-h3">Initials Tones</h3>
              <p class="mb-4 text-muted">
                When photos are unavailable, initials still provide clear identity anchors in lists and records.
              </p>
              <?= $avatar_fallback_content ?>
            </section>
          </li>

          <li class="list__item">
            <section class="w-full max-w-4xl py-4">
              <h3 class="type-h3">Avatar Group</h3>
              <p class="mb-4 text-muted">
                Overlapping groups work well for assignees, participants, and shared ownership previews.
              </p>
              <?= $avatar_group_content ?>
            </section>
          </li>

          <li class="list__item">
            <section class="w-full max-w-4xl py-4">
              <h3 class="type-h3">Usage Patterns</h3>
              <p class="mb-4 text-muted">
                Pick one pattern per context to keep identity presentation consistent across the product.
              </p>
              <div class="rounded-lg border border-gray-100 bg-white p-4">
                <ul class="list-disc space-y-2 pl-5">
                  <li><span class="type-semibold">Table rows:</span> avatar + name + secondary meta.</li>
                  <li><span class="type-semibold">Cards:</span> avatar near title to show owner/responsible person.</li>
                  <li><span class="type-semibold">Group previews:</span> max 3 visible + overflow badge (e.g. <code>+3</code>).</li>
                </ul>
              </div>
            </section>
          </li>

          <li class="list__item">
            <section class="w-full max-w-4xl py-4">
              <h3 class="type-h3">Accessibility Notes</h3>
              <p class="mb-4 text-muted">
                Avatars are visual identity cues, but context should remain understandable without images.
              </p>
              <div class="rounded-lg border border-gray-100 bg-white p-4">
                <ul class="list-disc space-y-2 pl-5">
                  <li>Provide meaningful <code>alt</code> text for user photos.</li>
                  <li>Use initials fallback so identity remains visible if image fails to load.</li>
                  <li>For decorative-only avatars, hide from assistive tech using appropriate ARIA attributes.</li>
                </ul>
              </div>
            </section>
          </li>
        </ul>
      </section>
    </section>
<?php layout('app-end'); ?>
