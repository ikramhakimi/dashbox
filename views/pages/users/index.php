<?php

$page_title   = 'All Users';
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
$avatar_sources = [
  'https://images.unsplash.com/photo-1494790108377-be9c29b29330?auto=format&fit=crop&w=120&q=80',
  'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&w=120&q=80',
  'https://images.unsplash.com/photo-1438761681033-6461ffad8d80?auto=format&fit=crop&w=120&q=80',
  'https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?auto=format&fit=crop&w=120&q=80',
  'https://images.unsplash.com/photo-1544005313-94ddf0286df2?auto=format&fit=crop&w=120&q=80',
  'https://images.unsplash.com/photo-1519085360753-af0119f7cbe7?auto=format&fit=crop&w=120&q=80',
  'https://images.unsplash.com/photo-1488426862026-3ee34a7d66df?auto=format&fit=crop&w=120&q=80',
  'https://images.unsplash.com/photo-1568602471122-7832951cc4c5?auto=format&fit=crop&w=120&q=80',
];

foreach ($users_on_page as $user_index => $user) {
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

  $avatar_src = $avatar_sources[$user_index % count($avatar_sources)];

  $avatar = $capture('avatar', [
    'name' => $user['name'],
    'size' => 'lg',
    'src'  => $avatar_src,
  ]);

  $role_badge = $capture('badge', [
    'label' => $user['role'],
    'mode'  => $role_mode,
  ]);

  $status_badge = $capture('badge', [
    'label' => $user['status'],
    'mode'  => $status_mode,
  ]);

  $view_button = $capture('button', [
    'label'      => 'View user',
    'aria_label' => 'View ' . $user['name'],
    'icon_name'  => 'eye',
    'icon_only'  => true,
    'href'       => '#',
  ]);

  $more_dropdown = $capture('dropdown', [
    'trigger_label' => 'More',
    'trigger_size'  => 'sm',
    'items'         => [
      ['label' => 'Edit Profile', 'href' => '#'],
      ['label' => 'Reset Password', 'href' => '#'],
      ['type' => 'divider'],
      ['label' => 'Suspend User', 'href' => '#', 'kind' => 'danger'],
    ],
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
        'html'  => '<div class="table__actions">' . $view_button . $more_dropdown . '</div>',
        'align' => 'right',
      ],
    ],
  ];
}

$users_actions_left = $capture('search-input', [
  'id'          => 'users-search',
  'name'        => 'users_search',
  'label'       => '',
  'placeholder' => 'Find by name or email',
]);

$users_filter = $capture('select', [
  'id'      => 'users-role-filter',
  'name'    => 'users_role_filter',
  'label'   => '',
  'value'   => '',
  'options' => [
    ['label' => 'Filter By', 'value' => '', 'disabled' => true],
    ['label' => 'Admin', 'value' => 'admin'],
    ['label' => 'Editor', 'value' => 'editor'],
    ['label' => 'Viewer', 'value' => 'viewer'],
    ['label' => 'Invited', 'value' => 'invited'],
    ['label' => 'Inactive', 'value' => 'inactive'],
  ],
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
      <?php
      component('page-header', [
        'title'       => 'All Users',
        'description' => 'Live-style user listing with search, status badges, and compact navigation.',
      ]);
      ?>

      <section class="space-y-6" aria-label="Users table">
        <div class="inline-flex flex-wrap items-end gap-3">
          <div class="w-72">
            <?= $users_actions_left ?>
          </div>
          <div class="w-56">
            <?= $users_filter ?>
          </div>
        </div>

        <article class="card space-y-6" aria-label="Users list">
          <?php
          component('table', [
            'headers' => ['User', 'Role', 'Status', 'Last Active', ['label' => '', 'align' => 'right']],
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
        </article>
      </section>
    </section>
  </main>
</div>
<?php layout('layout-end'); ?>
