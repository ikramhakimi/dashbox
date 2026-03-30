<?php

$page_title   = 'Invite Member';
$page_current = 'people-invite';

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
    'label'    => 'People',
    'children' => people_sidebar_children($page_current),
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

layout('layout-start', [
  'page_title'   => $page_title,
  'page_current' => $page_current,
]);
?>
<div class="flex min-h-screen">
  <?php component('sidebar', ['menu_items' => $menu_items]); ?>

  <main class="content flex-1 p-4 lg:p-10">
    <section class="space-y-6">
      <header class="border-b border-gray-200 pb-6">
        <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">People</p>
        <h1 class="mt-2 text-2xl font-semibold tracking-tight text-gray-900">Invite Member</h1>
        <p class="mt-2 text-sm text-gray-500">Invite new teammate with the right access level from day one.</p>
      </header>

      <form class="max-w-4xl space-y-5" action="#" method="post">
        <?= $capture('alert', [
          'variant'     => 'warning',
          'title'       => 'Before sending invite',
          'description' => 'Assign least-privileged role first. You can always promote later.',
        ]) ?>

        <div class="grid gap-4 md:grid-cols-2">
          <?= $capture('input', [
            'id'          => 'invite-full-name',
            'name'        => 'full_name',
            'label'       => 'Full Name',
            'placeholder' => 'e.g. Sarah Lee',
            'required'    => true,
          ]) ?>

          <?= $capture('input', [
            'id'          => 'invite-email',
            'name'        => 'email',
            'type'        => 'email',
            'label'       => 'Work Email',
            'placeholder' => 'sarah@startup.com',
            'required'    => true,
          ]) ?>

          <?= $capture('select', [
            'id'      => 'invite-role',
            'name'    => 'role',
            'label'   => 'Role',
            'value'   => 'editor',
            'options' => [
              ['label' => 'Admin', 'value' => 'admin'],
              ['label' => 'Editor', 'value' => 'editor'],
              ['label' => 'Viewer', 'value' => 'viewer'],
              ['label' => 'Support', 'value' => 'support'],
            ],
          ]) ?>

          <?= $capture('select', [
            'id'      => 'invite-team',
            'name'    => 'team',
            'label'   => 'Team',
            'value'   => 'general',
            'options' => [
              ['label' => 'General', 'value' => 'general'],
              ['label' => 'Operations', 'value' => 'operations'],
              ['label' => 'Customer Support', 'value' => 'support'],
            ],
          ]) ?>

          <div class="md:col-span-2">
            <?= $capture('textarea', [
              'id'          => 'invite-message',
              'name'        => 'welcome_message',
              'label'       => 'Welcome Message (Optional)',
              'rows'        => 3,
              'placeholder' => 'Add short onboarding context for this member.',
            ]) ?>
          </div>
        </div>

        <div class="grid gap-3 md:grid-cols-2">
          <?= $capture('checkbox', [
            'id'      => 'invite-send-email',
            'name'    => 'send_email',
            'label'   => 'Send invite email immediately',
            'checked' => true,
          ]) ?>

          <?= $capture('switch', [
            'id'      => 'invite-require-mfa',
            'name'    => 'require_mfa',
            'label'   => 'Require MFA on first login',
            'checked' => true,
          ]) ?>
        </div>

        <div class="flex flex-wrap items-center gap-2 pt-2">
          <?= $capture('button', [
            'label'   => 'Cancel',
            'href'    => asset('/people'),
          ]) ?>
          <?= $capture('button', [
            'label'   => 'Send Invite',
            'variant' => 'primary',
            'type'    => 'submit',
          ]) ?>
        </div>
      </form>
    </section>
  </main>
</div>
<?php layout('layout-end'); ?>
