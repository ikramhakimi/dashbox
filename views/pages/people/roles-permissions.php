<?php

$page_title   = 'Roles & Permissions';
$page_current = 'people-roles-permissions';

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

$roles = [
  ['role' => 'Owner', 'members' => 1, 'scope' => 'Full access to all modules', 'status' => 'System'],
  ['role' => 'Admin', 'members' => 3, 'scope' => 'Manage users, billing, and settings', 'status' => 'System'],
  ['role' => 'Editor', 'members' => 9, 'scope' => 'Create/update operational records', 'status' => 'System'],
  ['role' => 'Support', 'members' => 6, 'scope' => 'Handle tickets and customer updates', 'status' => 'Custom'],
];

$rows = [];
foreach ($roles as $role) {
  ob_start();
  component('badge', [
    'label' => $role['status'],
    'mode'  => $role['status'] === 'System' ? 'info' : 'accent',
  ]);
  $status_badge = (string) ob_get_clean();

  $rows[] = [
    'cells' => [
      ['value' => $role['role']],
      ['value' => (string) $role['members']],
      ['value' => $role['scope']],
      ['html' => '<div class="table__badge-cell">' . $status_badge . '</div>'],
      ['html' => '<div class="table__actions">' . $capture('button', ['label' => 'Edit']) . '</div>', 'align' => 'right'],
    ],
  ];
}

layout('layout-start', [
  'page_title'   => $page_title,
  'page_current' => $page_current,
]);
?>
<div class="flex min-h-screen">
  <?php component('sidebar', ['menu_items' => $menu_items]); ?>

  <main class="content flex-1 p-4 lg:p-10">
    <section class="mx-auto max-w-7xl space-y-6">
      <header class="border-b border-gray-200 pb-6">
        <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">People</p>
        <h1 class="mt-2 text-2xl font-semibold tracking-tight text-gray-900">Roles & Permissions</h1>
        <p class="mt-2 max-w-3xl text-sm text-gray-500">Define access boundaries clearly before scaling the team.</p>
      </header>

      <?= $capture('alert', [
        'variant'     => 'info',
        'title'       => 'Startup Tip',
        'description' => 'Keep role set small in early stage: Owner, Admin, Editor, Viewer.',
      ]) ?>

      <?php
      component('table', [
        'headers' => ['Role', 'Members', 'Access Scope', 'Type', ['label' => 'Action', 'align' => 'right']],
        'rows'    => $rows,
      ]);
      ?>

      <section class="divide-y divide-gray-100" aria-label="Permission quick matrix">
        <article class="py-5 first:pt-0 last:pb-0">
          <h2 class="text-lg font-semibold text-gray-900">Permission Matrix (Quick)</h2>
          <p class="mt-1 text-sm text-gray-500">Module-level visibility to simplify access review.</p>
          <div class="mt-4 overflow-x-auto">
            <table class="w-full min-w-[640px] border-separate border-spacing-y-2 text-sm">
              <thead>
                <tr class="text-left text-gray-500">
                  <th class="px-3 py-2">Module</th>
                  <th class="px-3 py-2">Owner</th>
                  <th class="px-3 py-2">Admin</th>
                  <th class="px-3 py-2">Editor</th>
                  <th class="px-3 py-2">Support</th>
                </tr>
              </thead>
              <tbody>
                <tr class="bg-white">
                  <td class="px-3 py-2 font-medium text-gray-900">Users</td>
                  <td class="px-3 py-2">Full</td>
                  <td class="px-3 py-2">Full</td>
                  <td class="px-3 py-2">No</td>
                  <td class="px-3 py-2">No</td>
                </tr>
                <tr class="bg-white">
                  <td class="px-3 py-2 font-medium text-gray-900">Billing</td>
                  <td class="px-3 py-2">Full</td>
                  <td class="px-3 py-2">Read</td>
                  <td class="px-3 py-2">No</td>
                  <td class="px-3 py-2">No</td>
                </tr>
                <tr class="bg-white">
                  <td class="px-3 py-2 font-medium text-gray-900">Pipeline</td>
                  <td class="px-3 py-2">Full</td>
                  <td class="px-3 py-2">Full</td>
                  <td class="px-3 py-2">Write</td>
                  <td class="px-3 py-2">Write</td>
                </tr>
              </tbody>
            </table>
          </div>
        </article>
      </section>
    </section>
  </main>
</div>
<?php layout('layout-end'); ?>
