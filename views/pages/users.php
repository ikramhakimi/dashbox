<?php

$page_title   = 'Browse Users';
$page_current = 'users';

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

$users = [
  ['name' => 'Aina Sofea',      'email' => 'aina.sofea@dashbox.io',      'role' => 'Admin',   'status' => 'Active',   'last_active' => '2 min ago'],
  ['name' => 'Daniel Chua',     'email' => 'daniel.chua@dashbox.io',     'role' => 'Editor',  'status' => 'Active',   'last_active' => '7 min ago'],
  ['name' => 'Farah Nabila',    'email' => 'farah.nabila@dashbox.io',    'role' => 'Viewer',  'status' => 'Invited',  'last_active' => 'Never'],
  ['name' => 'Ravi Kumar',      'email' => 'ravi.kumar@dashbox.io',      'role' => 'Editor',  'status' => 'Active',   'last_active' => '15 min ago'],
  ['name' => 'Nur Iman',        'email' => 'nur.iman@dashbox.io',        'role' => 'Viewer',  'status' => 'Inactive', 'last_active' => '2 days ago'],
  ['name' => 'Siti Aisyah',     'email' => 'siti.aisyah@dashbox.io',     'role' => 'Editor',  'status' => 'Active',   'last_active' => '35 min ago'],
  ['name' => 'Hakim Rahman',    'email' => 'hakim.rahman@dashbox.io',    'role' => 'Admin',   'status' => 'Active',   'last_active' => '1 hour ago'],
  ['name' => 'Mei Ling',        'email' => 'mei.ling@dashbox.io',        'role' => 'Viewer',  'status' => 'Invited',  'last_active' => 'Never'],
  ['name' => 'Syafiq Iskandar', 'email' => 'syafiq.iskandar@dashbox.io', 'role' => 'Editor',  'status' => 'Active',   'last_active' => '3 hours ago'],
  ['name' => 'Nadia Zahir',     'email' => 'nadia.zahir@dashbox.io',     'role' => 'Viewer',  'status' => 'Inactive', 'last_active' => '4 days ago'],
  ['name' => 'Amirul Azwan',    'email' => 'amirul.azwan@dashbox.io',    'role' => 'Editor',  'status' => 'Active',   'last_active' => '10 min ago'],
  ['name' => 'Liyana Shah',     'email' => 'liyana.shah@dashbox.io',     'role' => 'Viewer',  'status' => 'Active',   'last_active' => '28 min ago'],
  ['name' => 'Marcus Lee',      'email' => 'marcus.lee@dashbox.io',      'role' => 'Editor',  'status' => 'Active',   'last_active' => '50 min ago'],
  ['name' => 'Qistina Amani',   'email' => 'qistina.amani@dashbox.io',   'role' => 'Admin',   'status' => 'Active',   'last_active' => '1 hour ago'],
  ['name' => 'John Lim',        'email' => 'john.lim@dashbox.io',        'role' => 'Viewer',  'status' => 'Inactive', 'last_active' => '6 days ago'],
  ['name' => 'Sara Beh',        'email' => 'sara.beh@dashbox.io',        'role' => 'Editor',  'status' => 'Invited',  'last_active' => 'Never'],
  ['name' => 'Adrian Tan',      'email' => 'adrian.tan@dashbox.io',      'role' => 'Viewer',  'status' => 'Active',   'last_active' => '5 min ago'],
  ['name' => 'Irfan Husin',     'email' => 'irfan.husin@dashbox.io',     'role' => 'Editor',  'status' => 'Active',   'last_active' => '17 min ago'],
  ['name' => 'Hana Fatin',      'email' => 'hana.fatin@dashbox.io',      'role' => 'Admin',   'status' => 'Active',   'last_active' => '32 min ago'],
  ['name' => 'Wong Jia Min',    'email' => 'wong.jiamin@dashbox.io',     'role' => 'Viewer',  'status' => 'Invited',  'last_active' => 'Never'],
];

$current_page = isset($_GET['page']) ? max(1, (int) $_GET['page']) : 1;
$per_page     = 5;
$total_users  = count($users);
$total_pages  = max(1, (int) ceil($total_users / $per_page));

if ($current_page > $total_pages) {
  $current_page = $total_pages;
}

$offset         = ($current_page - 1) * $per_page;
$users_on_page  = array_slice($users, $offset, $per_page);
$user_table_rows = [];

foreach ($users_on_page as $user) {
  $role_mode = 'neutral';
  if ($user['role'] === 'Admin') {
    $role_mode = 'accent';
  } elseif ($user['role'] === 'Editor') {
    $role_mode = 'info';
  }

  $status_mode = 'neutral';
  if ($user['status'] === 'Active') {
    $status_mode = 'positive';
  } elseif ($user['status'] === 'Invited') {
    $status_mode = 'warning';
  } elseif ($user['status'] === 'Inactive') {
    $status_mode = 'negative';
  }

  $avatar = $capture('avatar', [
    'name' => $user['name'],
    'size' => 'sm',
  ]);

  $role_badge = $capture('badge', [
    'label' => $user['role'],
    'mode'  => $role_mode,
  ]);

  $status_badge = $capture('badge', [
    'label' => $user['status'],
    'mode'  => $status_mode,
  ]);

  $action_button = $capture('button', [
    'label'   => 'View',
    'size'    => 'sm',
    'href'    => '#',
  ]);

  $user_table_rows[] = [
    'cells' => [
      [
        'html' => '
          <div class="table__media-cell">
            ' . $avatar . '
            <div class="table__stack">
              <p class="table__primary">' . e($user['name']) . '</p>
              <p class="table__secondary">' . e($user['email']) . '</p>
            </div>
          </div>
        ',
      ],
      [
        'html' => '<div class="table__badge-cell">' . $role_badge . '</div>',
      ],
      [
        'html' => '<div class="table__badge-cell">' . $status_badge . '</div>',
      ],
      [
        'value' => $user['last_active'],
      ],
      [
        'html'  => '<div class="table__actions">' . $action_button . '</div>',
        'align' => 'right',
      ],
    ],
  ];
}

$users_actions_left = $capture('search-input', [
  'id'          => 'users-search',
  'name'        => 'users_search',
  'label'       => 'Search Users',
  'size'        => 'sm',
  'placeholder' => 'Find by name or email',
]);

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
        <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">Users</p>
        <h1 class="mt-2 text-2xl font-semibold tracking-tight text-gray-900">Browse All Users</h1>
        <p class="mt-2 max-w-3xl text-sm text-gray-500">
          Live-style user listing with search, status badges, and compact navigation.
        </p>
      </header>

      <section class="space-y-4" aria-label="Users table">
        <div class="max-w-sm">
          <?= $users_actions_left ?>
        </div>

        <?php
        component('table', [
          'headers' => ['User', 'Role', 'Status', 'Last Active', ['label' => 'Action', 'align' => 'right']],
          'rows'    => $user_table_rows,
        ]);

        component('pagination', [
          'current_page' => $current_page,
          'total_pages'  => max(1, (int) ceil($total_users / $per_page)),
          'show_info'    => true,
          'total_items'  => $total_users,
          'per_page'     => $per_page,
          'base_url'     => asset('/users?page=%d'),
        ]);
        ?>
      </section>
    </section>
  </main>
</div>
<?php layout('layout-end'); ?>
