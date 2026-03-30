<?php

$page_title   = 'Create New User';
$page_current = 'users-create';

$menu_items = [
  [
    'label' => 'Overview',
    'href'  => asset('/'),
  ],
  [
    'label'    => 'UI Elements',
    'children' => ui_elements_sidebar_children(),
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
<form class="space-y-5" action="#" method="post">
  <div class="grid gap-4 md:grid-cols-2">
    <?= $capture('input', [
      'id'          => 'user-full-name',
      'name'        => 'full_name',
      'label'       => 'Full Name',
      'placeholder' => 'e.g. Nur Aina',
      'required'    => true,
    ]) ?>

    <?= $capture('input', [
      'id'          => 'user-email',
      'name'        => 'work_email',
      'type'        => 'email',
      'label'       => 'Work Email',
      'placeholder' => 'aina@company.com',
      'required'    => true,
    ]) ?>

    <?= $capture('input', [
      'id'          => 'user-phone',
      'name'        => 'phone_number',
      'type'        => 'tel',
      'label'       => 'Phone Number',
      'placeholder' => '012-3456789',
    ]) ?>

    <?= $capture('select', [
      'id'      => 'user-role',
      'name'    => 'role',
      'label'   => 'Role',
      'value'   => 'editor',
      'options' => [
        ['label' => 'Admin', 'value' => 'admin'],
        ['label' => 'Editor', 'value' => 'editor'],
        ['label' => 'Viewer', 'value' => 'viewer'],
      ],
    ]) ?>

    <div class="md:col-span-2">
      <?= $capture('textarea', [
        'id'          => 'user-notes',
        'name'        => 'notes',
        'label'       => 'Notes',
        'rows'        => 3,
        'placeholder' => 'Internal note about this user',
      ]) ?>
    </div>
  </div>

  <div class="grid gap-3 md:grid-cols-2">
    <?= $capture('checkbox', [
      'id'      => 'user-send-invite',
      'name'    => 'send_invite',
      'label'   => 'Send invite email immediately',
      'checked' => true,
    ]) ?>

    <?= $capture('switch', [
      'id'      => 'user-active-status',
      'name'    => 'is_active',
      'label'   => 'Set user as active',
      'checked' => true,
    ]) ?>
  </div>

  <div class="flex flex-wrap items-center gap-2 pt-2">
    <?= $capture('button', [
      'label'   => 'Cancel',
      'href'    => asset('/users'),
    ]) ?>
    <?= $capture('button', [
      'label'   => 'Create User',
      'variant' => 'primary',
      'type'    => 'submit',
    ]) ?>
  </div>
</form>
<?php
$create_user_form_content = (string) ob_get_clean();

layout('layout-start', [
  'page_title'   => $page_title,
  'page_current' => $page_current,
]);
?>
<div class="flex min-h-screen">
  <?php component('sidebar', ['menu_items' => $menu_items]); ?>

  <main class="content flex-1 p-4 lg:p-10">
    <header class="border-b border-gray-200 pb-6">
      <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">Users</p>
      <h1 class="mt-2 text-2xl font-semibold tracking-tight text-gray-900">Create New User</h1>
      <p class="mt-2 text-sm text-gray-500">
        Template form for onboarding new users into the dashboard system.
      </p>
    </header>

    <article class="space-y-4 py-2">
      <?= $create_user_form_content ?>
    </article>
  </main>
</div>
<?php layout('layout-end'); ?>
