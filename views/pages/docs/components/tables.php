<?php

$page_title   = 'Table Component';
$page_current = 'tables';

$menu_items = build_main_menu_items($page_current);

$capture = static function (string $component_name, array $props): string {
  ob_start();
  component($component_name, $props);
  return (string) ob_get_clean();
};

$orders = [
  [
    'code'           => 'SR2600-260326-00065',
    'created_at'     => '26 Mar, 09:10 PM',
    'studio'         => 'Serambi Raya',
    'session'        => '2026-03-28 12:30 PM',
    'customer_name'  => 'Zahirah',
    'customer_phone' => '0137599060',
    'payment'        => 'Paid Full',
    'status'         => 'Completed',
    'manage_url'     => '#',
  ],
  [
    'code'           => 'RK2600-260325-00064',
    'created_at'     => '25 Mar, 10:03 PM',
    'studio'         => 'Raya Kasih',
    'session'        => '2026-03-28 05:00 PM',
    'customer_name'  => 'Mohamad Noor',
    'customer_phone' => '01126587133',
    'payment'        => 'Paid Deposit',
    'status'         => 'Pending',
    'manage_url'     => '#',
  ],
  [
    'code'           => 'LR2600-260324-00063',
    'created_at'     => '24 Mar, 10:41 AM',
    'studio'         => 'Laman Raya',
    'session'        => '2026-03-29 01:30 PM',
    'customer_name'  => 'Amira Sofea',
    'customer_phone' => '0123456789',
    'payment'        => 'Processing',
    'status'         => 'In Progress',
    'manage_url'     => '#',
  ],
];

$booking_table = build_booking_table_dataset($orders, [
  'action_button_size'      => 'default',
  'action_menu_size'        => 'default',
  'action_button_icon_only' => true,
  'action_button_icon_name' => 'pencil-line',
]);
$basic_table_headers = $booking_table['headers'];
$basic_table_rows    = $booking_table['rows'];
array_splice($basic_table_headers, 3, 1);
foreach ($basic_table_rows as &$basic_table_row) {
  if (isset($basic_table_row['cells']) && is_array($basic_table_row['cells'])) {
    array_splice($basic_table_row['cells'], 3, 1);
  }
}
unset($basic_table_row);

$basic_avatar_photos = [
  'https://images.unsplash.com/photo-1494790108377-be9c29b29330?auto=format&fit=crop&w=120&q=80',
  '',
  '',
];

foreach ($basic_table_rows as $basic_index => &$basic_table_row) {
  if (!isset($basic_table_row['cells']) || !is_array($basic_table_row['cells']) || !isset($orders[$basic_index])) {
    continue;
  }

  $basic_order = $orders[$basic_index];
  $basic_name  = isset($basic_order['customer_name']) ? (string) $basic_order['customer_name'] : 'Customer';
  $basic_phone = isset($basic_order['customer_phone']) ? (string) $basic_order['customer_phone'] : '-';
  $basic_src   = isset($basic_avatar_photos[$basic_index]) ? (string) $basic_avatar_photos[$basic_index] : '';

  $basic_avatar = $capture('avatar', [
    'name'  => $basic_name,
    'src'   => $basic_src,
    'size'  => 'sm',
    'class' => 'table__avatar',
  ]);

  $basic_table_row['cells'][1] = [
    'html' => '
      <div class="table__media-cell">
        ' . $basic_avatar . '
        <div class="table__stack">
          <p class="table__primary">' . e($basic_name) . '</p>
          <p class="table__secondary">' . e($basic_phone) . '</p>
        </div>
      </div>
    ',
  ];
}
unset($basic_table_row);
$empty_table   = build_booking_table_dataset([]);
$comfortable_table = build_booking_table_dataset($orders, [
  'action_button_size'      => 'default',
  'action_menu_size'        => 'default',
  'action_button_icon_only' => true,
  'action_button_icon_name' => 'pencil-line',
]);
$density_headers = [
  ['label' => 'Studio', 'align' => 'left'],
  ['label' => 'Module', 'align' => 'left'],
];
$density_rows = [
  [
    'cells' => [
      ['value' => 'Serambi Raya'],
      ['value' => 'Order Pipeline'],
    ],
  ],
  [
    'cells' => [
      ['value' => 'Raya Kasih'],
      ['value' => 'Package Catalog'],
    ],
  ],
  [
    'cells' => [
      ['value' => 'Laman Raya'],
      ['value' => 'Customer Segments'],
    ],
  ],
];

$financial_headers = [
  ['label' => 'Invoice', 'align' => 'left'],
  ['label' => 'Issued Date', 'align' => 'left'],
  ['label' => 'Status', 'align' => 'left'],
  ['label' => 'Amount (RM)', 'align' => 'right'],
];

$financial_rows = [
  [
    'cells' => [
      ['primary' => 'INV-2847', 'secondary' => 'Studio Session'],
      '30 Mar 2026',
      ['badge' => ['label' => 'Pending', 'mode' => 'warning']],
      ['value' => '2,437.00', 'align' => 'right'],
    ],
  ],
  [
    'cells' => [
      ['primary' => 'INV-2848', 'secondary' => 'Family Package'],
      '31 Mar 2026',
      ['badge' => ['label' => 'Paid', 'mode' => 'positive']],
      ['value' => '1,850.00', 'align' => 'right'],
    ],
  ],
  [
    'cells' => [
      ['primary' => 'INV-2849', 'secondary' => 'Graduation Portrait'],
      '01 Apr 2026',
      ['badge' => ['label' => 'Overdue', 'mode' => 'negative']],
      ['value' => '920.00', 'align' => 'right'],
    ],
  ],
];

$state_headers = [
  ['label' => 'Order', 'align' => 'left'],
  ['label' => 'Customer', 'align' => 'left'],
  ['label' => 'Progress', 'align' => 'left'],
  ['label' => 'State', 'align' => 'left'],
];

$state_rows = [
  [
    'cells' => [
      ['primary' => 'SR2600-260326-00065', 'secondary' => 'Selected row sample'],
      'Zahirah',
      ['value' => 'Edited 12 / 18 photos'],
      ['badge' => ['label' => 'Selected', 'mode' => 'info']],
    ],
  ],
  [
    'cells' => [
      ['primary' => 'RK2600-260325-00064', 'secondary' => 'Default row sample'],
      'Mohamad Noor',
      ['value' => 'Payment verified'],
      ['badge' => ['label' => 'Default', 'mode' => 'neutral']],
    ],
  ],
  [
    'cells' => [
      ['primary' => 'LR2600-260324-00063', 'secondary' => 'Muted/disabled row sample'],
      'Amira Sofea',
      ['value' => 'Awaiting customer response'],
      ['badge' => ['label' => 'Muted', 'mode' => 'warning']],
    ],
  ],
];

$content_headers = [
  ['label' => 'Customer', 'align' => 'left'],
  ['label' => 'Package', 'align' => 'left'],
  ['label' => 'Rating', 'align' => 'left'],
  ['label' => 'Action', 'align' => 'right'],
];

$nurin_avatar = $capture('avatar', [
  'name'  => 'Nurin Aisyah',
  'src'   => 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?auto=format&fit=crop&w=120&q=80',
  'size'  => 'sm',
  'class' => 'table__avatar',
]);

$aiman_avatar = $capture('avatar', [
  'name'  => 'Aiman Firdaus',
  'size'  => 'sm',
  'class' => 'table__avatar',
]);

$content_rows = [
  [
    'cells' => [
      [
        'html' => '
          <div class="table__media-cell">
            ' . $nurin_avatar . '
            <div class="table__stack">
              <p class="table__primary">Nurin Aisyah</p>
              <p class="table__secondary">Lead customer</p>
            </div>
          </div>
        ',
      ],
      ['primary' => 'Starter Portrait Package', 'secondary' => '1 session'],
      ['badge' => ['label' => '4.8 / 5', 'mode' => 'positive']],
      [
        'html' => '<div class="flex justify-end gap-2">'
          . $capture('button', [
            'label'      => 'Preview',
            'icon_name'  => 'eye-line',
            'icon_only'  => true,
            'aria_label' => 'Preview record',
          ])
          . $capture('button', [
            'label'      => 'Edit',
            'icon_name'  => 'pencil-line',
            'icon_only'  => true,
            'aria_label' => 'Edit record',
          ])
          . '</div>',
      ],
    ],
  ],
  [
    'cells' => [
      [
        'html' => '
          <div class="table__media-cell">
            ' . $aiman_avatar . '
            <div class="table__stack">
              <p class="table__primary">Aiman Firdaus</p>
              <p class="table__secondary">Returning customer</p>
            </div>
          </div>
        ',
      ],
      ['primary' => 'Family Portrait Package', 'secondary' => '2 sessions'],
      ['badge' => ['label' => '4.5 / 5', 'mode' => 'info']],
      [
        'html' => '<div class="flex justify-end gap-2">'
          . $capture('button', [
            'label'      => 'Preview',
            'icon_name'  => 'eye-line',
            'icon_only'  => true,
            'aria_label' => 'Preview record',
          ])
          . $capture('button', [
            'label'      => 'Edit',
            'icon_name'  => 'pencil-line',
            'icon_only'  => true,
            'aria_label' => 'Edit record',
          ])
          . '</div>',
      ],
    ],
  ],
];

ob_start();
?>
<?= $capture('search-input', [
  'id'          => 'table-booking-finder',
  'name'        => 'booking_finder',
  'label'       => '',
  'size'        => 'default',
  'placeholder' => 'Search booking or customer',
]) ?>
<?= $capture('select', [
  'id'      => 'table-booking-filter-payment',
  'name'    => 'payment_filter',
  'label'   => '',
  'size'    => 'default',
  'value'   => 'all',
  'options' => [
    ['label' => 'All payment', 'value' => 'all'],
    ['label' => 'Paid Full', 'value' => 'paid_full'],
    ['label' => 'Paid Deposit', 'value' => 'paid_deposit'],
    ['label' => 'Processing', 'value' => 'processing'],
  ],
]) ?>
<?= $capture('select', [
  'id'      => 'table-booking-filter-status',
  'name'    => 'status_filter',
  'label'   => '',
  'size'    => 'default',
  'value'   => 'all',
  'options' => [
    ['label' => 'All status', 'value' => 'all'],
    ['label' => 'Completed', 'value' => 'completed'],
    ['label' => 'Pending', 'value' => 'pending'],
    ['label' => 'In Progress', 'value' => 'in_progress'],
  ],
]) ?>
<?php
$booking_actions_left = (string) ob_get_clean();

ob_start();
?>
<?= $capture('button', [
  'label'   => 'Export',
  'size'    => 'default',
  'icon_name' => 'download-2-line',
]) ?>
<?= $capture('button', [
  'label'   => 'Create Booking',
  'variant' => 'primary',
  'size'    => 'default',
  'icon_name' => 'add-line',
]) ?>
<?php
$booking_actions_right = (string) ob_get_clean();

layout('app-start', [
  'page_title'   => $page_title,
  'page_current' => $page_current,
]);
?>
<section class="card">
  <header class="card__head">
    <h1 class="mt-2 type-h1">Table UI Component</h1>
    <p class="mt-2 max-w-3xl text-muted">
      Foundational table patterns for operational data, state handling, and layout integration.
    </p>
  </header>

  <section class="card__list" aria-label="Table component showcase">
    <ul class="list">
      <li class="list__item">
        <section class="w-full max-w-4xl py-4">
          <?= $capture('alert', [
            'variant'     => 'info',
            'show_icon'   => true,
            'description' => 'Guideline: keep 3-5 columns per table when possible. Stack related details inside a single cell.',
          ]) ?>
        </section>
      </li>

      <li class="list__item">
        <section class="w-full max-w-4xl py-4">
          <h2 class="type-h3">Basic Table</h2>
          <p class="mb-4 text-muted">
            Core structure for column headers, body rows, and row-level actions.
          </p>
          <div class="rounded-lg border border-gray-100 bg-white p-4">
            <?php component('table', ['headers' => $basic_table_headers, 'rows' => $basic_table_rows]); ?>
          </div>
        </section>
      </li>

      <li class="list__item">
        <section class="w-full max-w-4xl py-4">
          <h2 class="type-h3">Density Variants</h2>
          <p class="mb-4 text-muted">
            Compare spacing modes using plain system records for operations, catalog, and CRM modules.
          </p>
          <div class="rounded-lg border border-gray-100 bg-white p-4">
            <div class="grid gap-4 lg:grid-cols-2">
              <div>
                <h3 class="mb-3 type-h4">Default</h3>
                <?php component('table', ['headers' => $density_headers, 'rows' => $density_rows]); ?>
              </div>
              <div>
                <h3 class="mb-3 type-h4">Comfortable</h3>
                <?php component('table', ['headers' => $density_headers, 'rows' => $density_rows, 'class' => 'table--comfortable']); ?>
              </div>
            </div>
          </div>
        </section>
      </li>

      <li class="list__item">
        <section class="w-full max-w-4xl py-4">
          <h2 class="type-h3">Alignment & Data Types</h2>
          <p class="mb-4 text-muted">
            Right-align numeric values, keep textual metadata left-aligned, and use badges for status.
          </p>
          <div class="rounded-lg border border-gray-100 bg-white p-4">
            <?php component('table', ['headers' => $financial_headers, 'rows' => $financial_rows]); ?>
          </div>
        </section>
      </li>

      <li class="list__item">
        <section class="w-full max-w-4xl py-4">
          <h2 class="type-h3">Row States</h2>
          <p class="mb-4 text-muted">
            Communicate row condition using status semantics like selected, default, and muted.
          </p>
          <div class="rounded-lg border border-gray-100 bg-white p-4">
            <?php component('table', ['headers' => $state_headers, 'rows' => $state_rows]); ?>
          </div>
        </section>
      </li>

      <li class="list__item">
        <section class="w-full max-w-4xl py-4">
          <h2 class="type-h3">Cell Content Patterns</h2>
          <p class="mb-4 text-muted">
            Mix avatars, stacked labels, badges, and action controls inside cells without adding extra columns.
          </p>
          <div class="rounded-lg border border-gray-100 bg-white p-4">
            <?php component('table', ['headers' => $content_headers, 'rows' => $content_rows]); ?>
          </div>
        </section>
      </li>

      <li class="list__item">
        <section class="w-full max-w-4xl py-4">
          <h2 class="type-h3">Card Integration</h2>
          <p class="mb-4 text-muted">
            Use
            <span class="inline-flex rounded bg-gray-100 px-1.5 py-0.5 font-mono text-[12px] leading-none text-dark">
              card__table
            </span>
            to make table edges bleed correctly to card spacing tokens.
          </p>
          <section class="card">
            <header class="card__head">
              <h3 class="type-h4">Revenue by Package</h3>
              <p class="text-muted">Example of table embedded inside card anatomy.</p>
            </header>
            <div class="card__table">
              <?php component('table', ['headers' => $financial_headers, 'rows' => $financial_rows]); ?>
            </div>
            <div class="card__actions">
              <?= $capture('pagination', [
                'current_page' => 1,
                'total_pages'  => 3,
                'show_info'    => true,
                'total_items'  => 3,
                'per_page'     => 1,
                'base_url'     => asset('/docs/components/tables?page=%d'),
              ]) ?>
            </div>
          </section>
        </section>
      </li>

      <li class="list__item">
        <section class="w-full max-w-4xl py-4">
          <h2 class="type-h3">Overflow & Responsive</h2>
          <p class="mb-4 text-muted">
            Wrap dense tables with horizontal overflow to preserve readability on narrow viewports.
          </p>
          <div class="overflow-x-auto rounded-lg border border-gray-100 bg-white p-4">
            <?php component('table', ['headers' => $basic_table_headers, 'rows' => $basic_table_rows]); ?>
          </div>
        </section>
      </li>

      <li class="list__item">
        <section class="w-full max-w-4xl py-4">
          <h2 class="type-h3">Empty / Loading / Error</h2>
          <p class="mb-4 text-muted">
            Show fallback state when no records match current filters.
          </p>
          <div class="rounded-lg border border-gray-100 bg-white p-4">
            <h3 class="mb-3 type-h4">Empty</h3>
            <?php
            component('table', [
              'headers'       => $empty_table['headers'],
              'rows'          => $empty_table['rows'],
              'empty_title'   => 'No booking records yet',
              'empty_message' => 'Try creating a new booking or adjust your active filters.',
              'empty_deco'    => '(o_o)/',
            ]);
            ?>
          </div>
        </section>
      </li>

      <li class="list__item">
        <section class="w-full max-w-4xl py-4">
          <h2 class="type-h3">Sorting & Filtering (UI only)</h2>
          <p class="mb-4 text-muted">
            Header controls can be composed above the table without changing table semantics.
          </p>
          <div class="rounded-lg border border-gray-100 bg-white p-4">
            <div class="mb-3 grid gap-3 lg:grid-cols-[minmax(0,1fr)_auto] lg:items-end">
              <div class="flex flex-wrap items-end gap-2">
                <?= $booking_actions_left ?>
              </div>
              <div class="flex flex-wrap items-center justify-start gap-2 lg:justify-end">
                <?= $booking_actions_right ?>
              </div>
            </div>
            <?php component('table', ['headers' => $basic_table_headers, 'rows' => $basic_table_rows]); ?>
          </div>
        </section>
      </li>

      <li class="list__item">
        <section class="w-full max-w-4xl py-4">
          <h2 class="type-h3">Pagination Footer</h2>
          <p class="mb-4 text-muted">
            Keep result controls directly below the table for predictable scanning.
          </p>
          <div class="rounded-lg border border-gray-100 bg-white p-4">
            <?php component('table', ['headers' => $basic_table_headers, 'rows' => $basic_table_rows]); ?>
            <?= $capture('pagination', [
              'current_page' => 1,
              'total_pages'  => 3,
              'show_info'    => true,
              'total_items'  => $booking_table['total'],
              'per_page'     => 1,
              'base_url'     => asset('/docs/components/tables?page=%d'),
            ]) ?>
          </div>
        </section>
      </li>

      <li class="list__item">
        <section class="w-full max-w-4xl py-4">
          <h2 class="type-h3">Accessibility Notes</h2>
          <p class="mb-4 text-muted">
            These checks keep data tables legible and keyboard-friendly in production.
          </p>
          <div class="rounded-lg border border-gray-100 bg-white p-4">
            <ul class="list-disc space-y-2 pl-5">
              <li>Use column headers with <code>scope="col"</code> and keep labels concise.</li>
              <li>Preserve table semantics for assistive technologies; avoid replacing with generic div grids.</li>
              <li>Ensure focusable controls (buttons, dropdowns) have visible focus state inside cells.</li>
              <li>Prefer explicit status labels over color-only cues in badges or row highlights.</li>
            </ul>
          </div>
        </section>
      </li>

      <li class="list__item">
        <section class="w-full max-w-4xl py-4">
          <h2 class="type-h3">Do / Don’t</h2>
          <p class="mb-4 text-muted">
            Practical rules to keep table layout stable as datasets grow.
          </p>
          <div class="grid gap-4 lg:grid-cols-2">
            <div class="rounded-lg border border-gray-100 bg-white p-4">
              <h3 class="mb-3 type-h4">Do</h3>
              <ul class="list-disc space-y-2 pl-5">
                <li>Group related metadata in one stacked cell.</li>
                <li>Align numbers and currency to the right.</li>
                <li>Use consistent row action placement.</li>
              </ul>
            </div>
            <div class="rounded-lg border border-gray-100 bg-white p-4">
              <h3 class="mb-3 type-h4">Don’t</h3>
              <ul class="list-disc space-y-2 pl-5">
                <li>Add low-value columns that force horizontal scrolling.</li>
                <li>Mix multiple CTA priorities in a single cell without hierarchy.</li>
                <li>Rely on color alone for critical status meaning.</li>
              </ul>
            </div>
          </div>
        </section>
      </li>
    </ul>
  </section>
</section>
<?php layout('app-end'); ?>
