<?php

$page_title   = 'Toasts';
$page_current = 'toasts';

$menu_items = build_main_menu_items($page_current);

$capture = static function (array $props): string {
  ob_start();
  component('toast', $props);
  return (string) ob_get_clean();
};

ob_start();
?>
<div class="space-y-4">
  <div class="py-4">
    <p class="mb-3 type-caption type-semibold">Variants</p>
    <div class="space-y-3">
      <?= $capture([
        'variant'     => 'info',
        'title'       => 'Sync started',
        'description' => 'Your data sync has started in the background.',
      ]) ?>
      <?= $capture([
        'variant'     => 'success',
        'title'       => 'Saved successfully',
        'description' => 'Your changes have been published.',
      ]) ?>
      <?= $capture([
        'variant'     => 'warning',
        'title'       => 'Storage low',
        'description' => 'Only 8% storage remaining in current plan.',
      ]) ?>
      <?= $capture([
        'variant'     => 'danger',
        'title'       => 'Request failed',
        'description' => 'Unable to complete action. Try again in a moment.',
      ]) ?>
    </div>
  </div>

  <div class="py-4">
    <p class="mb-3 type-caption type-semibold">Dismissible & No Icon</p>
    <div class="space-y-3">
      <?= $capture([
        'variant'     => 'success',
        'title'       => 'Profile updated',
        'description' => 'New profile details are now active.',
        'dismissible' => true,
      ]) ?>
      <?= $capture([
        'variant'     => 'info',
        'title'       => 'Quiet mode',
        'description' => 'No icon variant for denser notification stack.',
        'show_icon'   => false,
        'dismissible' => true,
      ]) ?>
    </div>
  </div>

  <div class="py-4">
    <p class="mb-3 type-caption type-semibold">Floating Toast Demo</p>
    <p class="mb-3 type-body-muted">
      Trigger floating toasts from top-right stack (auto dismiss in 4 seconds).
    </p>
    <div class="flex flex-wrap gap-2">
      <button type="button" class="button" data-toast-demo-trigger="info">Show Info</button>
      <button type="button" class="button" data-toast-demo-trigger="success">Show Success</button>
      <button type="button" class="button" data-toast-demo-trigger="warning">Show Warning</button>
      <button type="button" class="button" data-toast-demo-trigger="danger">Show Danger</button>
    </div>
  </div>
</div>
<?php
$toast_content = (string) ob_get_clean();

$toast_template_info = $capture([
  'variant'     => 'info',
  'title'       => 'Sync queued',
  'description' => 'Background sync has been added to the queue.',
  'dismissible' => true,
  'attributes'  => ['class' => 'pointer-events-auto w-[320px] shadow-sm'],
]);

$toast_template_success = $capture([
  'variant'     => 'success',
  'title'       => 'Update successful',
  'description' => 'Project settings were saved successfully.',
  'dismissible' => true,
  'attributes'  => ['class' => 'pointer-events-auto w-[320px] shadow-sm'],
]);

$toast_template_warning = $capture([
  'variant'     => 'warning',
  'title'       => 'Storage warning',
  'description' => 'Remaining storage is under 10%.',
  'dismissible' => true,
  'attributes'  => ['class' => 'pointer-events-auto w-[320px] shadow-sm'],
]);

$toast_template_danger = $capture([
  'variant'     => 'danger',
  'title'       => 'Failed to save',
  'description' => 'A network error occurred. Please retry.',
  'dismissible' => true,
  'attributes'  => ['class' => 'pointer-events-auto w-[320px] shadow-sm'],
]);

layout('app-start', [
  'page_title'   => $page_title,
  'page_current' => $page_current,
]);
?>
    <section class="card">
      <header class="card__head">
        <h1 class="mt-2 type-h1">Toast UI Library</h1>
        <p class="mt-2 max-w-3xl type-body-muted">
          Lightweight feedback toasts for transient notifications and action confirmation.
        </p>
      </header>

      <section class="card__list" aria-label="Toast component showcase">
        <ul class="list">
          <li class="list__item">
            <section class="w-full max-w-4xl py-4">
        <article class="space-y-4 py-7 first:pt-0 last:pb-0">
          <header>
            <h2 class="type-h2">Toast Variations</h2>
            <p class="mt-1 type-body-muted">
              Variant tones with optional icon and dismiss action.
            </p>
          </header>
          <?= $toast_content ?>
        </article>
            </section>
          </li>
        </ul>
      </section>
    </section>
<div id="toast-demo-stack" class="pointer-events-none fixed right-6 top-6 z-50 space-y-2"></div>

<template id="toast-template-info"><?= $toast_template_info ?></template>
<template id="toast-template-success"><?= $toast_template_success ?></template>
<template id="toast-template-warning"><?= $toast_template_warning ?></template>
<template id="toast-template-danger"><?= $toast_template_danger ?></template>

<script>
  (() => {
    const stack = document.getElementById('toast-demo-stack');
    if (!stack) return;

    const template_map = {
      info: document.getElementById('toast-template-info'),
      success: document.getElementById('toast-template-success'),
      warning: document.getElementById('toast-template-warning'),
      danger: document.getElementById('toast-template-danger'),
    };

    const show_toast = (variant) => {
      const template = template_map[variant];
      if (!template) return;

      const wrapper = document.createElement('div');
      wrapper.innerHTML = template.innerHTML.trim();
      const toast = wrapper.firstElementChild;
      if (!toast) return;

      stack.prepend(toast);
      window.setTimeout(() => {
        if (toast && toast.parentNode) toast.remove();
      }, 4000);
    };

    document.addEventListener('click', (event) => {
      const trigger = event.target.closest('[data-toast-demo-trigger]');
      if (!trigger) return;
      const variant = trigger.getAttribute('data-toast-demo-trigger');
      if (!variant) return;
      show_toast(variant);
    });
  })();
</script>
<?php layout('app-end'); ?>
