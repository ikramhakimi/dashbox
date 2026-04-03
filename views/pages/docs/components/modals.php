<?php

$page_title   = 'Modals';
$page_current = 'modals';

$menu_items = build_main_menu_items($page_current);

$capture = static function (string $name, array $props): string {
  ob_start();
  component($name, $props);
  return (string) ob_get_clean();
};

$button_cancel = $capture('button', [
  'label'      => 'Cancel',
  'attributes' => ['data-modal-close' => true],
]);

$button_close = $capture('button', [
  'label'      => 'Close',
  'attributes' => ['data-modal-close' => true],
]);

$button_save = $capture('button', [
  'label'   => 'Save',
  'variant' => 'primary',
]);

$button_apply = $capture('button', [
  'label'   => 'Apply Filters',
  'variant' => 'primary',
]);

$button_delete = $capture('button', [
  'label'   => 'Delete',
  'variant' => 'danger',
]);

$button_next = $capture('button', [
  'label'   => 'Next',
  'variant' => 'primary',
]);

$button_back = $capture('button', [
  'label'   => 'Back',
]);

$form_modal_content = '
  <form class="space-y-4">
    ' . $capture('input', [
      'id'          => 'modal-form-name',
      'label'       => 'Team Name',
      'placeholder' => 'e.g. Growth Operations',
    ]) . '
    ' . $capture('input', [
      'id'          => 'modal-form-email',
      'label'       => 'Owner Email',
      'placeholder' => 'owner@company.com',
    ]) . '
    ' . $capture('select', [
      'id'      => 'modal-form-role',
      'label'   => 'Default Role',
      'value'   => 'manager',
      'options' => [
        ['label' => 'Manager', 'value' => 'manager'],
        ['label' => 'Editor', 'value' => 'editor'],
        ['label' => 'Viewer', 'value' => 'viewer'],
      ],
    ]) . '
    ' . $capture('switch', [
      'id'      => 'modal-form-active',
      'label'   => 'Active by default',
      'checked' => true,
    ]) . '
  </form>
';

$form_modal_footer = '
  <div class="flex items-center gap-2">
    ' . $button_cancel . '
    ' . $button_save . '
  </div>
';

$delete_modal_content = '
  <div class="space-y-3">
    <p class="type-body">
      This will permanently delete <span class="type-semibold text-dark">Project Mercury</span>.
    </p>
    <p class="text-muted">You cannot undo this action.</p>
  </div>
';

$delete_modal_footer = '
  <div class="flex items-center gap-2">
    ' . $button_cancel . '
    ' . $button_delete . '
  </div>
';

$filter_modal_content = '
  <form class="space-y-4">
    <div class="grid gap-4 md:grid-cols-2">
      ' . $capture('select', [
        'id'      => 'modal-filter-status',
        'label'   => 'Status',
        'value'   => 'open',
        'options' => [
          ['label' => 'Open', 'value' => 'open'],
          ['label' => 'In Progress', 'value' => 'in_progress'],
          ['label' => 'Closed', 'value' => 'closed'],
        ],
      ]) . '
      ' . $capture('select', [
        'id'      => 'modal-filter-priority',
        'label'   => 'Priority',
        'value'   => 'high',
        'options' => [
          ['label' => 'High', 'value' => 'high'],
          ['label' => 'Medium', 'value' => 'medium'],
          ['label' => 'Low', 'value' => 'low'],
        ],
      ]) . '
      ' . $capture('datetime-input', [
        'id'    => 'modal-filter-date-start',
        'label' => 'Start Date',
        'mode'  => 'date',
      ]) . '
      ' . $capture('datetime-input', [
        'id'    => 'modal-filter-date-end',
        'label' => 'End Date',
        'mode'  => 'date',
      ]) . '
    </div>
    <div class="space-y-2">
      ' . $capture('checkbox', [
        'id'      => 'modal-filter-billing',
        'label'   => 'Include billing-related tickets',
        'checked' => true,
      ]) . '
      ' . $capture('checkbox', [
        'id'      => 'modal-filter-urgent',
        'label'   => 'Only urgent items',
        'checked' => false,
      ]) . '
    </div>
  </form>
';

$filter_modal_footer = '
  <div class="flex items-center gap-2">
    ' . $button_cancel . '
    ' . $capture('button', ['label' => 'Reset']) . '
    ' . $button_apply . '
  </div>
';

$detail_modal_content = '
  <div class="grid gap-4 md:grid-cols-2">
    <div class="space-y-2 py-2">
      <p class="type-caption type-semibold">Customer</p>
      <p class="type-body text-dark">Nadia Syahirah</p>
      <p class="text-muted">nadia@example.com</p>
      <p class="text-muted">+60 12-345 6789</p>
    </div>
    <div class="space-y-2 py-2">
      <p class="type-caption type-semibold">Order</p>
      <p class="type-body text-dark">ORD-2026-00991</p>
      <p class="text-muted">Created: 29 Mar 2026</p>
      <p class="text-muted">Status: Processing</p>
    </div>
  </div>
';

$detail_modal_footer = '
  <div class="flex items-center gap-2">
    ' . $button_close . '
    ' . $capture('button', ['label' => 'Open Full Details', 'variant' => 'primary']) . '
  </div>
';

$step_modal_content = '
  <div class="space-y-4">
    <div class="space-y-1">
      <p class="type-caption type-semibold">Step 2 of 3</p>
      <h4 class="type-body type-semibold text-dark">Choose Notification Channel</h4>
    </div>
    <div class="space-y-2">
      ' . $capture('radio', [
        'id'      => 'modal-step-email',
        'name'    => 'modal_step_channel',
        'label'   => 'Email notifications',
        'value'   => 'email',
        'checked' => true,
      ]) . '
      ' . $capture('radio', [
        'id'      => 'modal-step-sms',
        'name'    => 'modal_step_channel',
        'label'   => 'SMS notifications',
        'value'   => 'sms',
      ]) . '
      ' . $capture('radio', [
        'id'      => 'modal-step-inapp',
        'name'    => 'modal_step_channel',
        'label'   => 'In-app notifications',
        'value'   => 'in_app',
      ]) . '
    </div>
  </div>
';

$step_modal_footer = '
  <div class="flex items-center gap-2">
    ' . $button_back . '
    ' . $button_next . '
  </div>
';

ob_start();
?>
<div class="space-y-4">
  <div class="py-4">
    <p class="mb-3 type-caption type-semibold">Modal Use Cases</p>
    <div class="flex flex-wrap gap-2">
      <?= $capture('button', [
        'label'      => '1. Form Modal',
        'attributes' => ['data-modal-open' => 'demo-modal-form'],
      ]) ?>
      <?= $capture('button', [
        'label'      => '2. Delete Confirmation',
        'variant'    => 'danger',
        'attributes' => ['data-modal-open' => 'demo-modal-delete'],
      ]) ?>
      <?= $capture('button', [
        'label'      => '3. Filter Modal',
        'attributes' => ['data-modal-open' => 'demo-modal-filter'],
      ]) ?>
      <?= $capture('button', [
        'label'      => '4. Read-only Details',
        'attributes' => ['data-modal-open' => 'demo-modal-detail'],
      ]) ?>
      <?= $capture('button', [
        'label'      => '5. Multi-step Light',
        'attributes' => ['data-modal-open' => 'demo-modal-step'],
      ]) ?>
    </div>
  </div>

  <div class="py-4">
    <p class="mb-3 type-caption type-semibold">When To Use</p>
    <ul class="space-y-2 type-body type-secondary">
      <li>1. Form modal for quick create/edit without page transition.</li>
      <li>2. Delete confirmation for destructive actions requiring explicit intent.</li>
      <li>3. Filter modal for dense filtering controls and date ranges.</li>
      <li>4. Read-only details for quick context inspection.</li>
      <li>5. Multi-step light for short guided setup.</li>
    </ul>
  </div>
</div>
<?php
$modal_demo_content = (string) ob_get_clean();

layout('app-start', [
  'page_title'   => $page_title,
  'page_current' => $page_current,
]);
?>
    <section class="card">
      <header class="card__head">
        <h1 class="mt-2 type-h1">Modal UI Library</h1>
        <p class="mt-2 max-w-3xl text-muted">
          Practical modal contexts for production workflows, from form entry to confirmation and step flows.
        </p>
      </header>

      <section class="card__list" aria-label="Modal component showcase">
        <ul class="list">
          <li class="list__item">
            <section class="w-full max-w-4xl py-4">
        <article class="space-y-4 py-7 first:pt-0 last:pb-0">
          <header>
            <h2 class="type-h2">Modal Context Demos</h2>
            <p class="mt-1 text-muted">
              Five production-ready modal examples covering common dashboard use cases.
            </p>
          </header>
          <?= $modal_demo_content ?>
        </article>
            </section>
          </li>
        </ul>
      </section>
    </section>

<?php
component('modal', [
  'id'          => 'demo-modal-form',
  'size'        => 'md',
  'title'       => 'Create Team',
  'description' => 'Set up team details and default permissions.',
  'content'     => $form_modal_content,
  'footer'      => $form_modal_footer,
]);

component('modal', [
  'id'          => 'demo-modal-delete',
  'size'        => 'sm',
  'title'       => 'Delete Project?',
  'description' => 'This action is permanent.',
  'content'     => $delete_modal_content,
  'footer'      => $delete_modal_footer,
]);

component('modal', [
  'id'          => 'demo-modal-filter',
  'size'        => 'lg',
  'title'       => 'Advanced Filters',
  'description' => 'Refine results using status, dates, and flags.',
  'content'     => $filter_modal_content,
  'footer'      => $filter_modal_footer,
]);

component('modal', [
  'id'          => 'demo-modal-detail',
  'size'        => 'lg',
  'title'       => 'Order Snapshot',
  'description' => 'Read-only detail modal for quick review.',
  'content'     => $detail_modal_content,
  'footer'      => $detail_modal_footer,
]);

component('modal', [
  'id'          => 'demo-modal-step',
  'size'        => 'md',
  'title'       => 'Setup Wizard',
  'description' => 'Short multi-step configuration flow.',
  'content'     => $step_modal_content,
  'footer'      => $step_modal_footer,
]);
?>
<?php layout('app-end'); ?>
