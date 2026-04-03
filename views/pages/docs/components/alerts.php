<?php

$page_title   = 'Alerts';
$page_current = 'alerts';

$menu_items = build_main_menu_items($page_current);

$capture = static function (array $props): string {
  ob_start();
  component('alert', $props);
  return (string) ob_get_clean();
};

ob_start();
?>
<ul class="list">
  <li class="list__item">
    <section class="w-full max-w-4xl py-4">
      <h3 class="type-h3">Soft Variants</h3>
      <p class="mb-4 text-muted">
        Default alert variants for informational, success, warning, and danger messaging.
      </p>
      <div class="grid grid-cols-2 gap-3">
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
  </li>

  <li class="list__item">
    <section class="w-full max-w-4xl py-4">
      <h3 class="type-h3">With / Without Icon</h3>
      <p class="mb-4 text-muted">
        Compare icon-led alerts versus minimal alerts for dense content areas.
      </p>
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
  </li>

  <li class="list__item">
    <section class="w-full max-w-4xl py-4">
      <h3 class="type-h3">Dismissible</h3>
      <p class="mb-4 text-muted">
        Alerts with close controls for temporary notices and user-managed visibility.
      </p>
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
  </li>

  <li class="list__item">
    <section class="w-full max-w-4xl py-4">
      <h3 class="type-h3">Inline Alert</h3>
      <p class="mb-4 text-muted">
        Compact inline alert style for embedding status updates within flowing content.
      </p>
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
  </li>

  <li class="list__item">
    <section class="w-full max-w-4xl py-4">
      <h3 class="type-h3">Alert With Link</h3>
      <p class="mb-4 text-muted">
        Action-oriented alerts that include a direct link to the next recommended step.
      </p>
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
  </li>
</ul>
<?php
$alert_content = (string) ob_get_clean();

layout('app-start', [
  'page_title'   => $page_title,
  'page_current' => $page_current,
]);
?>
    <section class="card">
      <header class="card__head">
        <h1 class="mt-2 type-h1">Alert UI Component</h1>
        <p class="mt-2 max-w-3xl text-muted">
          Soft alert variants with title and description, icon toggle, and dismiss behavior.
        </p>
      </header>

      <section class="card__list" aria-label="Alert component showcase">
        <?= $alert_content ?>
      </section>
    </section>
<?php layout('app-end'); ?>
