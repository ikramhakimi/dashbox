<?php

$page_title   = 'CRM Pipeline';
$page_current = 'crm-pipeline';

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
    'children' => ui_patterns_sidebar_children($page_current),
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
];

$table_headers = [
  ['label' => 'Lead',         'align' => 'left'],
  ['label' => 'Company',      'align' => 'left'],
  ['label' => 'Stage',        'align' => 'left'],
  ['label' => 'Priority',     'align' => 'left'],
  ['label' => 'Last Contact', 'align' => 'left'],
  ['label' => 'Actions',      'align' => 'right'],
];

$table_rows = [];
foreach ($lead_rows as $lead_row) {
  ob_start();
  component('avatar', [
    'name' => (string) $lead_row['lead_name'],
    'size' => 'sm',
  ]);
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
    'label'   => 'View',
    'size'    => 'sm',
    'variant' => 'neutral',
    'href'    => '#',
  ]);
  $view_button = (string) ob_get_clean();

  ob_start();
  component('dropdown', [
    'trigger_label'   => 'More',
    'trigger_variant' => 'ghost',
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
        <p class="font-medium text-gray-900">' . e((string) $lead_row['lead_name']) . '</p>
        <p class="text-xs text-gray-500">' . e((string) $lead_row['email']) . '</p>
      </div>
    </div>
  ';

  $company_cell = '
    <div>
      <p class="font-medium text-gray-900">' . e((string) $lead_row['company']) . '</p>
      <p class="text-xs text-gray-500">Owner: ' . e((string) $lead_row['owner']) . '</p>
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
    ['label' => 'Export CSV', 'variant' => 'neutral'],
    [
      'label'      => 'Add Lead',
      'variant'    => 'primary',
      'icon_name'  => 'plus',
      'attributes' => ['data-modal-open' => 'crm-add-lead-modal'],
    ],
  ],
  'actions_html' => $capture('dropdown', [
    'trigger_label'     => 'More',
    'trigger_variant'   => 'ghost',
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
  <?= $capture('alert', [
    'variant'     => 'warning',
    'show_icon'   => true,
    'dismissible' => true,
    'description' => '9 leads have no activity in the last 7 days. Review and schedule follow-up.',
    'link_href'   => '#',
    'link_label'  => 'Open stale leads',
  ]) ?>

  <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
    <?php foreach ($pipeline_widgets as $pipeline_widget): ?>
      <?php component('card-widget', $pipeline_widget); ?>
    <?php endforeach; ?>
  </div>
</div>
<?php
$crm_summary = (string) ob_get_clean();

ob_start();
?>
<?= $capture('tabs', [
  'items' => [
    ['label' => 'All Leads', 'href' => '#', 'active' => true],
    ['label' => 'Qualified', 'href' => '#'],
    ['label' => 'Proposal', 'href' => '#'],
    ['label' => 'Negotiation', 'href' => '#'],
  ],
]) ?>
<?php
$crm_table_content = (string) ob_get_clean();

ob_start();
?>
<div class="flex flex-wrap items-end gap-3">
  <div class="w-full md:w-64">
    <?= $capture('search-input', [
      'id'          => 'crm-search',
      'name'        => 'search',
      'label'       => 'Finder',
      'size'        => 'sm',
      'placeholder' => 'Name, company, or email',
    ]) ?>
  </div>
  <div class="w-full sm:w-48">
    <?= $capture('select', [
      'id'      => 'crm-owner',
      'name'    => 'owner',
      'label'   => 'Owner',
      'size'    => 'sm',
      'value'   => 'all',
      'options' => [
        ['label' => 'All owners', 'value' => 'all'],
        ['label' => 'RZ', 'value' => 'rz'],
        ['label' => 'LK', 'value' => 'lk'],
        ['label' => 'YM', 'value' => 'ym'],
      ],
    ]) ?>
  </div>
  <div class="w-full sm:w-48">
    <?= $capture('select', [
      'id'      => 'crm-priority',
      'name'    => 'priority',
      'label'   => 'Priority',
      'size'    => 'sm',
      'value'   => 'all',
      'options' => [
        ['label' => 'All priorities', 'value' => 'all'],
        ['label' => 'High', 'value' => 'high'],
        ['label' => 'Medium', 'value' => 'medium'],
        ['label' => 'Low', 'value' => 'low'],
      ],
    ]) ?>
  </div>
  <div class="flex items-center gap-2 pt-6">
    <div>
      <?= $capture('checkbox', [
        'id'      => 'crm-show-stale',
        'name'    => 'show_stale_only',
        'label'   => 'Stale only',
        'checked' => false,
      ]) ?>
    </div>
    <?= $capture('tooltip', [
      'trigger_html' => $capture('badge', [
        'label' => 'SLA',
        'mode'  => 'info',
      ]),
      'content'      => 'Leads should be followed up within 24 hours.',
    ]) ?>
  </div>
</div>
<?php
$crm_actions_left = (string) ob_get_clean();

ob_start();
?>
<?= $capture('button', [
  'label'   => 'Reset',
  'variant' => 'neutral',
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
<?php component('card-table', [
  'title'              => 'Pipeline Workspace',
  'subtitle'           => 'Review stage, priority, and assigned owner before taking action.',
  'actions_left_html'  => $crm_actions_left,
  'actions_right_html' => $crm_actions_right,
  'content_html'       => $crm_table_content,
  'table_headers'      => $table_headers,
  'table_rows'         => $table_rows,
  'record_label'       => 'leads',
  'total_records'      => 38,
  'current_page'       => 1,
  'per_page'           => 10,
  'base_url'           => '#page=%d',
]); ?>
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
    ' . $capture('button', ['label' => 'Cancel', 'variant' => 'ghost', 'attributes' => ['data-modal-close' => true]]) . '
    ' . $capture('button', ['label' => 'Save Lead', 'variant' => 'primary']) . '
  </div>
';

layout('layout-start', [
  'page_title'   => $page_title,
  'page_current' => $page_current,
]);
?>
<div class="flex min-h-screen">
  <?php component('sidebar', ['menu_items' => $menu_items]); ?>

  <main class="flex-1">
    <section class="mx-auto max-w-7xl space-y-6 px-6 py-8 lg:px-10">
      <?= $crm_header ?>
      <?= $crm_summary ?>

      <?php
      echo $crm_table_card;
      ?>
    </section>
  </main>
</div>
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

layout('layout-end');
?>
