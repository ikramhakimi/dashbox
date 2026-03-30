<?php

$page_title   = 'Alerts';
$page_current = 'alerts';

$menu_items = [
  [
    'label' => 'Overview',
    'href'  => asset('/'),
  ],
  [
    'label'    => 'UI Elements',
    'children' => ui_elements_sidebar_children('alerts'),
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

$capture = static function (array $props): string {
  ob_start();
  component('alert', $props);
  return (string) ob_get_clean();
};

ob_start();
?>
<div class="divide-y divide-gray-100">
  <section class="py-5 first:pt-0 last:pb-0">
    <p class="mb-3 text-xs font-semibold uppercase tracking-wide text-gray-500">Soft Variants</p>
    <div class="space-y-3">
      <?= $capture([
        'variant'     => 'info',
        'title'       => 'Informational update',
        'description' => 'Report generation completed and is now available in your downloads.',
      ]) ?>
      <?= $capture([
        'variant'     => 'success',
        'title'       => 'Payment confirmed',
        'description' => 'Your subscription renewal was successful and invoice was sent by email.',
      ]) ?>
      <?= $capture([
        'variant'     => 'warning',
        'title'       => 'Storage almost full',
        'description' => 'You have used 92% of your storage quota. Consider upgrading your plan.',
      ]) ?>
      <?= $capture([
        'variant'     => 'danger',
        'title'       => 'Action required',
        'description' => 'Two-factor authentication is disabled. Enable it to secure your account.',
      ]) ?>
    </div>
  </section>

  <section class="py-5 first:pt-0 last:pb-0">
    <p class="mb-3 text-xs font-semibold uppercase tracking-wide text-gray-500">With / Without Icon</p>
    <div class="space-y-3">
      <?= $capture([
        'variant'     => 'info',
        'title'       => 'With icon',
        'description' => 'This alert keeps icon visible for quick scanning.',
        'show_icon'   => true,
      ]) ?>
      <?= $capture([
        'variant'     => 'info',
        'title'       => 'Without icon',
        'description' => 'This alert removes icon to keep layout cleaner in dense sections.',
        'show_icon'   => false,
      ]) ?>
    </div>
  </section>

  <section class="py-5 first:pt-0 last:pb-0">
    <p class="mb-3 text-xs font-semibold uppercase tracking-wide text-gray-500">Dismissible</p>
    <div class="space-y-3">
      <?= $capture([
        'variant'     => 'success',
        'title'       => 'Changes saved',
        'description' => 'Your profile preferences have been updated.',
        'dismissible' => true,
      ]) ?>
      <?= $capture([
        'variant'     => 'warning',
        'title'       => 'Session expiring',
        'description' => 'Your session will expire in 3 minutes due to inactivity.',
        'dismissible' => true,
        'show_icon'   => false,
      ]) ?>
    </div>
  </section>

  <section class="py-5 first:pt-0 last:pb-0">
    <p class="mb-3 text-xs font-semibold uppercase tracking-wide text-gray-500">Inline Alert</p>
    <div class="space-y-3">
      <?= $capture([
        'variant'     => 'warning',
        'title'       => 'Phase 1 Progress: 82% complete.',
        'description' => 'Foundation UI is in final stretch before developer handoff.',
        'inline'      => true,
      ]) ?>
      <?= $capture([
        'variant'     => 'info',
        'title'       => 'Sync status:',
        'description' => 'All demo pages are aligned with latest component variants.',
        'inline'      => true,
        'dismissible' => true,
      ]) ?>
    </div>
  </section>

  <section class="py-5 first:pt-0 last:pb-0">
    <p class="mb-3 text-xs font-semibold uppercase tracking-wide text-gray-500">Alert With Link</p>
    <div class="space-y-3">
      <?= $capture([
        'variant'     => 'warning',
        'title'       => 'Payment method expiring soon.',
        'description' => 'Update billing details before 31 March to avoid service interruption.',
        'link_label'  => 'Update billing method',
        'link_href'   => '#',
      ]) ?>
      <?= $capture([
        'variant'     => 'info',
        'title'       => 'Need setup guide?',
        'description' => 'Follow the latest onboarding checklist.',
        'link_label'  => 'View setup docs',
        'link_href'   => '#',
        'inline'      => true,
      ]) ?>
    </div>
  </section>
</div>
<?php
$alert_content = (string) ob_get_clean();

layout('layout-start', [
  'page_title'            => $page_title,
  'page_current'          => $page_current,
  'top_banner_text'       => 'Phase 1 Progress: 82% complete.',
  'top_banner_description'=> 'Foundation UI is in final stretch before developer handoff.',
]);
?>
<div class="flex min-h-screen">
  <?php component('sidebar', ['menu_items' => $menu_items]); ?>

  <main class="content flex-1 p-4 lg:p-10">
    <section class="mx-auto max-w-7xl">
      <header class="mb-8 border-b border-gray-200 pb-6">
        <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">UI Elements</p>
        <h1 class="mt-2 text-2xl font-semibold tracking-tight text-gray-900">Alert UI Library</h1>
        <p class="mt-2 max-w-3xl text-sm text-gray-500">
          Soft alert variants with title and description, icon toggle, and dismiss behavior.
        </p>
      </header>

      <section class="divide-y divide-gray-100" aria-label="Alert component showcase">
        <article class="space-y-4 py-7 first:pt-0 last:pb-0">
          <header>
            <h2 class="text-lg font-semibold text-gray-900">Alert Variations</h2>
            <p class="mt-1 text-sm text-gray-500">
              Info, success, warning, and danger in soft treatment only.
            </p>
          </header>
          <?= $alert_content ?>
        </article>
      </section>
    </section>
  </main>
</div>
<?php layout('layout-end'); ?>
