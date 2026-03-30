<?php

$page_title   = 'Team Members';
$page_current = 'people-team-members';

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
];

$capture = static function (string $component_name, array $props): string {
  ob_start();
  component($component_name, $props);
  return (string) ob_get_clean();
};

$delete_modal_id = 'team-members-delete-confirm';

$team_members = [
  ['name' => 'Nadia Syahirah', 'email' => 'nadia@startup.com', 'role' => 'Owner',   'status' => 'Active',    'last_active' => 'Today, 10:40 AM'],
  ['name' => 'Faris Hakim',    'email' => 'faris@startup.com', 'role' => 'Admin',   'status' => 'Active',    'last_active' => 'Today, 09:22 AM'],
  ['name' => 'Aina Husna',     'email' => 'aina@startup.com',  'role' => 'Editor',  'status' => 'Active',    'last_active' => 'Yesterday, 11:03 PM'],
  ['name' => 'Rizal Nordin',   'email' => 'rizal@startup.com', 'role' => 'Support', 'status' => 'Invited',   'last_active' => 'Pending invite'],
  ['name' => 'Qistina Azhar',  'email' => 'qistina@startup.com', 'role' => 'Viewer','status' => 'Suspended', 'last_active' => '3 days ago'],
  ['name' => 'Hafiz Rahman',   'email' => 'hafiz@startup.com', 'role' => 'Editor',  'status' => 'Active',    'last_active' => '2 hours ago'],
  ['name' => 'Nurin Aisyah',   'email' => 'nurin@startup.com', 'role' => 'Viewer',  'status' => 'Active',    'last_active' => '1 hour ago'],
  ['name' => 'Kamil Arif',     'email' => 'kamil@startup.com', 'role' => 'Support', 'status' => 'Active',    'last_active' => '4 hours ago'],
  ['name' => 'Izzat Firdaus',  'email' => 'izzat@startup.com', 'role' => 'Editor',  'status' => 'Invited',   'last_active' => 'Pending invite'],
  ['name' => 'Sarah Lim',      'email' => 'sarah@startup.com', 'role' => 'Viewer',  'status' => 'Active',    'last_active' => 'Today, 08:11 AM'],
  ['name' => 'Amir Zulkifli',  'email' => 'amir@startup.com',  'role' => 'Admin',   'status' => 'Active',    'last_active' => 'Yesterday, 06:20 PM'],
  ['name' => 'Mei Ling Tan',   'email' => 'meiling@startup.com', 'role' => 'Editor','status' => 'Active',    'last_active' => 'Yesterday, 04:44 PM'],
  ['name' => 'Azra Danish',    'email' => 'azra@startup.com',  'role' => 'Support', 'status' => 'Suspended', 'last_active' => '5 days ago'],
  ['name' => 'Yusuf Karim',    'email' => 'yusuf@startup.com', 'role' => 'Viewer',  'status' => 'Active',    'last_active' => 'Today, 07:32 AM'],
  ['name' => 'Alia Sofea',     'email' => 'alia@startup.com',  'role' => 'Editor',  'status' => 'Active',    'last_active' => 'Today, 09:58 AM'],
  ['name' => 'Bryan Cho',      'email' => 'bryan@startup.com', 'role' => 'Support', 'status' => 'Invited',   'last_active' => 'Pending invite'],
  ['name' => 'Nur Amalina',    'email' => 'amalina@startup.com', 'role' => 'Viewer','status' => 'Active',    'last_active' => '2 days ago'],
  ['name' => 'Rakesh Menon',   'email' => 'rakesh@startup.com','role' => 'Admin',   'status' => 'Active',    'last_active' => 'Today, 11:05 AM'],
  ['name' => 'Dhiya Nabilah',  'email' => 'dhiya@startup.com', 'role' => 'Editor',  'status' => 'Active',    'last_active' => 'Yesterday, 02:30 PM'],
  ['name' => 'Harith Iskandar','email' => 'harith@startup.com','role' => 'Support', 'status' => 'Suspended', 'last_active' => '1 week ago'],
];

$current_page = isset($_GET['page']) ? max(1, (int) $_GET['page']) : 1;
$per_page     = 10;
$total_items  = count($team_members);
$total_pages  = max(1, (int) ceil($total_items / $per_page));

if ($current_page > $total_pages) {
  $current_page = $total_pages;
}

$offset              = ($current_page - 1) * $per_page;
$team_members_on_page = array_slice($team_members, $offset, $per_page);
$rows                = [];

foreach ($team_members_on_page as $member) {
  $role_mode = 'neutral';
  if ($member['role'] === 'Owner') {
    $role_mode = 'accent';
  } elseif ($member['role'] === 'Admin') {
    $role_mode = 'info';
  }

  $status_mode = 'neutral';
  if ($member['status'] === 'Active') {
    $status_mode = 'positive';
  } elseif ($member['status'] === 'Invited') {
    $status_mode = 'warning';
  } elseif ($member['status'] === 'Suspended') {
    $status_mode = 'negative';
  }

  $avatar = $capture('avatar', [
    'name' => $member['name'],
  ]);

  $role_badge = $capture('badge', [
    'label' => $member['role'],
    'mode'  => $role_mode,
  ]);

  $status_badge = $capture('badge', [
    'label' => $member['status'],
    'mode'  => $status_mode,
  ]);

  $delete_button = $capture('button', [
    'label'      => 'Remove member',
    'aria_label' => 'Remove ' . $member['name'],
    'icon_name'  => 'trash',
    'icon_only'  => true,
    'attributes' => [
      'data-modal-open' => $delete_modal_id,
    ],
  ]);

  $edit_button = $capture('button', [
    'label'   => 'Edit',
    'href'    => asset('/people/roles-permissions'),
  ]);

  $rows[] = [
    'cells' => [
      [
        'html' => '
          <div class="table__media-cell">
            ' . $avatar . '
            <div class="table__stack">
              <p class="table__primary">' . e($member['name']) . '</p>
              <p class="table__secondary">' . e($member['email']) . '</p>
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
        'value' => $member['last_active'],
      ],
      [
        'html'  => '<div class="table__actions">' . $delete_button . $edit_button . '</div>',
        'align' => 'right',
      ],
    ],
  ];
}

$search_block = $capture('search-input', [
  'id'          => 'team-members-search',
  'name'        => 'member_search',
  'label'       => '',
  'placeholder' => 'Find member by name or email',
]);

$role_filter = $capture('select', [
  'id'      => 'team-members-role-filter',
  'name'    => 'role_filter',
  'label'   => '',
  'value'   => '',
  'options' => [
    ['label' => 'Filter By', 'value' => '', 'disabled' => true],
    ['label' => 'Owner', 'value' => 'owner'],
    ['label' => 'Admin', 'value' => 'admin'],
    ['label' => 'Editor', 'value' => 'editor'],
    ['label' => 'Support', 'value' => 'support'],
    ['label' => 'Viewer', 'value' => 'viewer'],
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
    <section class="space-y-6">
      <?php
      component('page-header', [
        'title'       => 'Team Members',
        'description' => 'Manage active members, invites, and access operations for your startup team.',
      ]);
      ?>

      <div class="inline-flex flex-wrap items-end gap-3">
        <div class="w-72">
          <?= $search_block ?>
        </div>
        <div class="w-56">
          <?= $role_filter ?>
        </div>
      </div>

      <article class="card space-y-6" aria-label="Team members list">
        <?php
        component('table', [
          'headers' => [
            ['label' => 'Member',      'align' => 'left'],
            ['label' => 'Role',        'align' => 'left'],
            ['label' => 'Status',      'align' => 'left'],
            ['label' => 'Last Active', 'align' => 'left'],
            ['label' => '',            'align' => 'right'],
          ],
          'rows' => $rows,
        ]);

        component('pagination', [
          'current_page' => $current_page,
          'total_pages'  => $total_pages,
          'show_info'    => true,
          'show_pages'   => true,
          'total_items'  => $total_items,
          'per_page'     => $per_page,
          'base_url'     => asset('/people/team-members?page=%d'),
        ]);
        ?>
      </article>

      <?php
      component('modal', [
        'id'          => $delete_modal_id,
        'title'       => 'Remove Team Member',
        'description' => 'This action cannot be undone.',
        'dismissible' => true,
        'content'     => '<p class="text-gray-600">Are you sure you want to remove this member from your workspace?</p>',
        'footer'      => '
          <div class="flex items-center justify-end gap-2">
            ' . $capture('button', [
              'label'      => 'Cancel',
              'attributes' => ['data-modal-close' => true],
            ]) . '
            ' . $capture('button', [
              'label'      => 'Remove Member',
              'variant'    => 'danger',
              'attributes' => ['data-modal-close' => true],
            ]) . '
          </div>
        ',
      ]);
      ?>
    </section>
  </main>
</div>
<?php layout('layout-end'); ?>
