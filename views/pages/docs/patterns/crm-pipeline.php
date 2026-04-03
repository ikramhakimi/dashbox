<?php

$page_title   = 'CRM Pipeline';
$page_current = 'crm-pipeline';

$menu_items = build_main_menu_items('', $page_current);

$capture = static function (string $component_name, array $props): string {
  ob_start();
  component($component_name, $props);
  return (string) ob_get_clean();
};

$pipeline_widgets = [
  [
    'title'     => 'New Leads',
    'value'     => '38',
    'trend'     => '+8%',
    'note'      => 'this week',
    'icon_name' => 'users',
  ],
  [
    'title'     => 'Qualified',
    'value'     => '17',
    'trend'     => '+3',
    'note'      => 'ready for proposal',
    'icon_name' => 'activity',
  ],
  [
    'title'     => 'Proposal Sent',
    'value'     => '11',
    'trend'     => '+2',
    'note'      => 'awaiting response',
    'icon_name' => 'ticket',
  ],
  [
    'title'     => 'Win Rate',
    'value'     => '31%',
    'trend'     => '+4%',
    'note'      => 'last 30 days',
    'icon_name' => 'star',
  ],
];

$lead_rows = [
  [
    'lead_name'   => 'Aina Sofea',
    'company'     => 'Nova Retail',
    'email'       => 'aina@novaretail.com',
    'stage'       => 'Qualified',
    'priority'    => 'High',
    'owner'       => 'RZ',
    'last_contact'=> 'Today, 10:30 AM',
  ],
  [
    'lead_name'   => 'Daniel Chua',
    'company'     => 'Pixel Forge',
    'email'       => 'daniel@pixelforge.io',
    'stage'       => 'Proposal',
    'priority'    => 'Medium',
    'owner'       => 'LK',
    'last_contact'=> 'Yesterday, 04:15 PM',
  ],
  [
    'lead_name'   => 'Farah Nabila',
    'company'     => 'Blue Origin Studio',
    'email'       => 'farah@blueorigin.studio',
    'stage'       => 'Negotiation',
    'priority'    => 'High',
    'owner'       => 'YM',
    'last_contact'=> '2 days ago',
  ],
  [
    'lead_name'   => 'Ravi Kumar',
    'company'     => 'Atlas Works',
    'email'       => 'ravi@atlasworks.com',
    'stage'       => 'New',
    'priority'    => 'Low',
    'owner'       => 'QN',
    'last_contact'=> '3 days ago',
  ],
  [
    'lead_name'   => 'Siti Nadia',
    'company'     => 'Urban Mart',
    'email'       => 'siti@urbanmart.co',
    'stage'       => 'Qualified',
    'priority'    => 'Medium',
    'owner'       => 'RZ',
    'last_contact'=> 'Today, 09:05 AM',
  ],
  [
    'lead_name'   => 'Hafiz Rahman',
    'company'     => 'Green Pixel Labs',
    'email'       => 'hafiz@greenpixel.io',
    'stage'       => 'Proposal',
    'priority'    => 'High',
    'owner'       => 'LK',
    'last_contact'=> 'Yesterday, 02:10 PM',
  ],
  [
    'lead_name'   => 'Mei Ling',
    'company'     => 'Sunrise Tech',
    'email'       => 'meiling@sunrisetech.com',
    'stage'       => 'New',
    'priority'    => 'Low',
    'owner'       => 'YM',
    'last_contact'=> 'Yesterday, 11:44 AM',
  ],
  [
    'lead_name'   => 'Azri Faiz',
    'company'     => 'Peak Studio',
    'email'       => 'azri@peakstudio.my',
    'stage'       => 'Negotiation',
    'priority'    => 'High',
    'owner'       => 'QN',
    'last_contact'=> 'Today, 08:35 AM',
  ],
  [
    'lead_name'   => 'Nurin Izzati',
    'company'     => 'Cloudline Sdn Bhd',
    'email'       => 'nurin@cloudline.com',
    'stage'       => 'Qualified',
    'priority'    => 'Medium',
    'owner'       => 'RZ',
    'last_contact'=> '2 days ago',
  ],
  [
    'lead_name'   => 'Benjamin Tan',
    'company'     => 'Hexa Commerce',
    'email'       => 'ben@hexacommerce.io',
    'stage'       => 'Proposal',
    'priority'    => 'Medium',
    'owner'       => 'LK',
    'last_contact'=> '3 days ago',
  ],
  [
    'lead_name'   => 'Ivy Chan',
    'company'     => 'Nova Foods',
    'email'       => 'ivy@novafoods.my',
    'stage'       => 'New',
    'priority'    => 'Low',
    'owner'       => 'YM',
    'last_contact'=> '4 days ago',
  ],
  [
    'lead_name'   => 'Kamil Ariff',
    'company'     => 'Signal Hub',
    'email'       => 'kamil@signalhub.co',
    'stage'       => 'Negotiation',
    'priority'    => 'High',
    'owner'       => 'QN',
    'last_contact'=> 'Today, 12:12 PM',
  ],
  [
    'lead_name'   => 'Rina Abdullah',
    'company'     => 'Orbit Wellness',
    'email'       => 'rina@orbitwellness.com',
    'stage'       => 'Qualified',
    'priority'    => 'Medium',
    'owner'       => 'RZ',
    'last_contact'=> '1 day ago',
  ],
  [
    'lead_name'   => 'Jason Lee',
    'company'     => 'Blue Lake Agency',
    'email'       => 'jason@bluelake.agency',
    'stage'       => 'Proposal',
    'priority'    => 'Low',
    'owner'       => 'LK',
    'last_contact'=> '2 days ago',
  ],
  [
    'lead_name'   => 'Amirah Zulkifli',
    'company'     => 'Sprint Labs',
    'email'       => 'amirah@sprintlabs.io',
    'stage'       => 'New',
    'priority'    => 'Medium',
    'owner'       => 'YM',
    'last_contact'=> '5 days ago',
  ],
  [
    'lead_name'   => 'Darren Wong',
    'company'     => 'Motive Works',
    'email'       => 'darren@motiveworks.co',
    'stage'       => 'Negotiation',
    'priority'    => 'High',
    'owner'       => 'QN',
    'last_contact'=> 'Today, 01:47 PM',
  ],
  [
    'lead_name'   => 'Fatin Zahra',
    'company'     => 'Crate Supply',
    'email'       => 'fatin@cratesupply.com',
    'stage'       => 'Qualified',
    'priority'    => 'Low',
    'owner'       => 'RZ',
    'last_contact'=> 'Yesterday, 05:02 PM',
  ],
  [
    'lead_name'   => 'Omar Idris',
    'company'     => 'Frontier Auto',
    'email'       => 'omar@frontierauto.my',
    'stage'       => 'Proposal',
    'priority'    => 'Medium',
    'owner'       => 'LK',
    'last_contact'=> '3 days ago',
  ],
  [
    'lead_name'   => 'Jia Wen',
    'company'     => 'Lotus Interiors',
    'email'       => 'jiawen@lotusinteriors.com',
    'stage'       => 'New',
    'priority'    => 'Low',
    'owner'       => 'YM',
    'last_contact'=> '6 days ago',
  ],
  [
    'lead_name'   => 'Syafiq Ismail',
    'company'     => 'Trackline',
    'email'       => 'syafiq@trackline.app',
    'stage'       => 'Negotiation',
    'priority'    => 'High',
    'owner'       => 'QN',
    'last_contact'=> 'Today, 03:20 PM',
  ],
];

$table_headers = [
  ['label' => 'Lead',         'align' => 'left'],
  ['label' => 'Company',      'align' => 'left'],
  ['label' => 'Stage',        'align' => 'left'],
  ['label' => 'Priority',     'align' => 'left'],
  ['label' => 'Last Contact', 'align' => 'left'],
  ['label' => '',             'align' => 'right'],
];

$avatar_sources = [
  'https://images.unsplash.com/photo-1494790108377-be9c29b29330?auto=format&fit=crop&w=120&q=80',
  '',
  'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&w=120&q=80',
  '',
  'https://images.unsplash.com/photo-1438761681033-6461ffad8d80?auto=format&fit=crop&w=120&q=80',
  '',
  'https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?auto=format&fit=crop&w=120&q=80',
  '',
  'https://images.unsplash.com/photo-1544005313-94ddf0286df2?auto=format&fit=crop&w=120&q=80',
  '',
];

$table_rows = [];
foreach ($lead_rows as $lead_index => $lead_row) {
  $avatar_src = $avatar_sources[$lead_index % count($avatar_sources)];

  $avatar_props = [
    'name' => (string) $lead_row['lead_name'],
    'size' => 'lg',
  ];
  if ($avatar_src !== '') {
    $avatar_props['src'] = $avatar_src;
  }

  ob_start();
  component('avatar', $avatar_props);
  $lead_avatar = (string) ob_get_clean();

  $stage_mode = 'neutral';
  if ($lead_row['stage'] === 'Qualified') {
    $stage_mode = 'info';
  } elseif ($lead_row['stage'] === 'Proposal') {
    $stage_mode = 'warning';
  } elseif ($lead_row['stage'] === 'Negotiation') {
    $stage_mode = 'accent';
  }

  $priority_mode = 'neutral';
  if ($lead_row['priority'] === 'High') {
    $priority_mode = 'negative';
  } elseif ($lead_row['priority'] === 'Medium') {
    $priority_mode = 'warning';
  }

  ob_start();
  component('badge', [
    'label' => (string) $lead_row['stage'],
    'mode'  => $stage_mode,
  ]);
  $stage_badge = (string) ob_get_clean();

  ob_start();
  component('badge', [
    'label' => (string) $lead_row['priority'],
    'mode'  => $priority_mode,
  ]);
  $priority_badge = (string) ob_get_clean();

  ob_start();
  component('button', [
    'label'      => 'View lead',
    'aria_label' => 'View lead',
    'icon_name'  => 'eye',
    'icon_only'  => true,
    'href'       => '#',
  ]);
  $view_button = (string) ob_get_clean();

  ob_start();
  component('dropdown', [
    'trigger_label'   => 'More',
    'trigger_size'    => 'sm',
    'items'           => [
      ['label' => 'Schedule follow-up', 'href' => '#'],
      ['label' => 'Move stage', 'href' => '#'],
      ['type' => 'divider'],
      ['label' => 'Archive lead', 'href' => '#', 'kind' => 'danger'],
    ],
  ]);
  $lead_dropdown = (string) ob_get_clean();

  $lead_cell = '
    <div class="flex items-center gap-3">
      ' . $lead_avatar . '
      <div>
        <p class="type-medium text-dark">' . e((string) $lead_row['lead_name']) . '</p>
        <p class="text-muted">' . e((string) $lead_row['email']) . '</p>
      </div>
    </div>
  ';

  $company_cell = '
    <div>
      <p class="type-medium text-dark">' . e((string) $lead_row['company']) . '</p>
      <p class="text-muted">Owner: ' . e((string) $lead_row['owner']) . '</p>
    </div>
  ';

  $actions_cell = '
    <div class="flex items-center justify-end gap-2">
      ' . $view_button . '
      ' . $lead_dropdown . '
    </div>
  ';

  $table_rows[] = [
    'cells' => [
      ['html' => $lead_cell],
      ['html' => $company_cell],
      ['html' => $stage_badge],
      ['html' => $priority_badge],
      ['value' => (string) $lead_row['last_contact']],
      ['html' => $actions_cell, 'align' => 'right'],
    ],
  ];
}

ob_start();
?>
<?= $capture('page-header', [
  'title'       => 'Customer Pipeline',
  'description' => 'Track lead progress from first contact to closed-won with clear ownership and follow-ups.',
  'breadcrumb_items' => [
    ['label' => 'Home', 'href' => asset('/')],
    ['label' => 'CRM', 'href' => '#'],
    ['label' => 'Pipeline'],
  ],
  'actions' => [
    ['label' => 'Export CSV'],
  ],
  'actions_html' => $capture('dropdown', [
    'trigger_label'     => 'More',
    'trigger_variant'   => 'primary',
    'trigger_size'      => 'sm',
    'items'             => [
      ['label' => 'Import leads', 'href' => '#'],
      ['label' => 'Assign owner rules', 'href' => '#'],
      ['type' => 'divider'],
      ['label' => 'Archive pipeline', 'href' => '#', 'kind' => 'danger'],
    ],
  ]),
  'actions_html_trusted' => true,
]) ?>
<?php
$crm_header = (string) ob_get_clean();

ob_start();
?>
<div class="space-y-4">
  <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
    <?php foreach ($pipeline_widgets as $pipeline_widget): ?>
      <?php component('card-metric', $pipeline_widget); ?>
    <?php endforeach; ?>
  </div>
</div>
<?php
$crm_summary = (string) ob_get_clean();

ob_start();
?>
<div class="flex flex-wrap items-end gap-3">
  <div class="w-full md:w-64">
    <?= $capture('search-input', [
      'id'          => 'crm-search',
      'name'        => 'search',
      'label'       => '',
      'size'        => 'sm',
      'placeholder' => 'Name, company, or email',
    ]) ?>
  </div>
</div>
<?php
$crm_actions_left = (string) ob_get_clean();

ob_start();
?>
<?= $capture('button', [
  'label'   => 'Reset',
  'size'    => 'sm',
]) ?>
<?= $capture('button', [
  'label'   => 'Apply Filters',
  'variant' => 'primary',
  'size'    => 'sm',
]) ?>
<?php
$crm_actions_right = (string) ob_get_clean();

ob_start();
?>
<article class="card space-y-6" aria-label="Pipeline workspace table">
  <header class="space-y-1">
    <h2 class="type-h2">Pipeline Workspace</h2>
    <p class="text-muted">Review stage, priority, and assigned owner before taking action.</p>
  </header>

  <div class="grid gap-3 lg:grid-cols-[minmax(0,1fr)_auto] lg:items-end">
    <div class="flex flex-wrap items-end gap-3">
      <?= $crm_actions_left ?>
    </div>
    <div class="flex flex-wrap items-center justify-start gap-2 lg:justify-end">
      <?= $crm_actions_right ?>
    </div>
  </div>

  <?php
  component('table', [
    'headers' => $table_headers,
    'rows'    => $table_rows,
  ]);

  component('pagination', [
    'current_page' => 1,
    'total_pages'  => 4,
    'show_info'    => true,
    'total_items'  => 38,
    'per_page'     => 10,
    'base_url'     => '#page=%d',
  ]);
  ?>
</article>
<?php
$crm_table_card = (string) ob_get_clean();

$modal_body = '
  <div class="grid gap-4 md:grid-cols-2">
    ' . $capture('input', [
      'id'          => 'crm-lead-name',
      'name'        => 'lead_name',
      'label'       => 'Lead Name',
      'placeholder' => 'e.g. Sara Lim',
      'required'    => true,
    ]) . '
    ' . $capture('input', [
      'id'          => 'crm-lead-email',
      'name'        => 'lead_email',
      'type'        => 'email',
      'label'       => 'Work Email',
      'placeholder' => 'sara@company.com',
      'required'    => true,
    ]) . '
    ' . $capture('input', [
      'id'          => 'crm-company',
      'name'        => 'company_name',
      'label'       => 'Company',
      'placeholder' => 'Company name',
      'required'    => true,
    ]) . '
    ' . $capture('select', [
      'id'      => 'crm-stage',
      'name'    => 'lead_stage',
      'label'   => 'Initial Stage',
      'value'   => 'new',
      'options' => [
        ['label' => 'New', 'value' => 'new'],
        ['label' => 'Qualified', 'value' => 'qualified'],
        ['label' => 'Proposal', 'value' => 'proposal'],
      ],
    ]) . '
  </div>
';

$modal_footer = '
  <div class="flex flex-wrap justify-end gap-2">
    ' . $capture('button', ['label' => 'Cancel', 'attributes' => ['data-modal-close' => true]]) . '
    ' . $capture('button', ['label' => 'Save Lead', 'variant' => 'primary']) . '
  </div>
';

layout('app-start', [
  'page_title'   => $page_title,
  'page_current' => $page_current,
]);
?>
    <section class="mx-auto max-w-7xl space-y-6">
      <?= $crm_header ?>
      <?= $crm_summary ?>

      <?php
      echo $crm_table_card;
      ?>
    </section>
<?php
component('modal', [
  'id'          => 'crm-add-lead-modal',
  'title'       => 'Add New Lead',
  'description' => 'Create a lead record and place it in the initial pipeline stage.',
  'content'     => $modal_body,
  'footer'      => $modal_footer,
  'size'        => 'lg',
  'dismissible' => true,
]);

layout('app-end');
?>
