<?php

$page_title   = 'All Packages';
$page_current = 'packages';

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

$delete_modal_id = 'packages-delete-confirm';

$products = [
  ['name' => 'Starter CRM Template',      'sku' => 'PRD-1001', 'price' => 'RM 150', 'deposit' => 'RM 50', 'total_orders' => 34, 'status' => 'Active'],
  ['name' => 'Growth Analytics Pack',     'sku' => 'PRD-1002', 'price' => 'RM 100', 'deposit' => 'RM 30', 'total_orders' => 18, 'status' => 'Active'],
  ['name' => 'Sales Follow-up Kit',       'sku' => 'PRD-1003', 'price' => 'RM 100', 'deposit' => 'RM 30', 'total_orders' => 0,  'status' => 'Draft'],
  ['name' => 'Customer Portal Theme',     'sku' => 'PRD-1004', 'price' => 'RM 150', 'deposit' => 'RM 50', 'total_orders' => 12, 'status' => 'Active'],
  ['name' => 'Support Ticket Blueprint',  'sku' => 'PRD-1005', 'price' => 'RM 100', 'deposit' => 'RM 30', 'total_orders' => 44, 'status' => 'Active'],
  ['name' => 'Finance Ops Dashboard',     'sku' => 'PRD-1006', 'price' => 'RM 150', 'deposit' => 'RM 50', 'total_orders' => 7,  'status' => 'Active'],
  ['name' => 'Team Onboarding Bundle',    'sku' => 'PRD-1007', 'price' => 'RM 100', 'deposit' => 'RM 30', 'total_orders' => 0,  'status' => 'Archived'],
  ['name' => 'Lead Scoring Ruleset',      'sku' => 'PRD-1008', 'price' => 'RM 150', 'deposit' => 'RM 50', 'total_orders' => 27, 'status' => 'Active'],
  ['name' => 'Pipeline QA Checklist',     'sku' => 'PRD-1009', 'price' => 'RM 100', 'deposit' => 'RM 30', 'total_orders' => 60, 'status' => 'Active'],
  ['name' => 'Ops Reporting Pack',        'sku' => 'PRD-1010', 'price' => 'RM 150', 'deposit' => 'RM 50', 'total_orders' => 15, 'status' => 'Draft'],
  ['name' => 'Invoice Reminder Workflow', 'sku' => 'PRD-1011', 'price' => 'RM 100', 'deposit' => 'RM 30', 'total_orders' => 23, 'status' => 'Active'],
  ['name' => 'Storefront UI Blocks',      'sku' => 'PRD-1012', 'price' => 'RM 150', 'deposit' => 'RM 50', 'total_orders' => 19, 'status' => 'Active'],
  ['name' => 'Recruitment Kanban Board',  'sku' => 'PRD-1013', 'price' => 'RM 150', 'deposit' => 'RM 50', 'total_orders' => 9,  'status' => 'Active'],
  ['name' => 'Email Campaign Presets',    'sku' => 'PRD-1014', 'price' => 'RM 100', 'deposit' => 'RM 30', 'total_orders' => 31, 'status' => 'Draft'],
  ['name' => 'Client Handoff Checklist',  'sku' => 'PRD-1015', 'price' => 'RM 100', 'deposit' => 'RM 30', 'total_orders' => 55, 'status' => 'Active'],
  ['name' => 'Retention Booster Bundle',  'sku' => 'PRD-1016', 'price' => 'RM 150', 'deposit' => 'RM 50', 'total_orders' => 6,  'status' => 'Active'],
  ['name' => 'Warehouse Sync Connector',  'sku' => 'PRD-1017', 'price' => 'RM 150', 'deposit' => 'RM 50', 'total_orders' => 4,  'status' => 'Archived'],
  ['name' => 'Sales Territory Matrix',    'sku' => 'PRD-1018', 'price' => 'RM 100', 'deposit' => 'RM 30', 'total_orders' => 40, 'status' => 'Active'],
  ['name' => 'Customer Health Widgets',   'sku' => 'PRD-1019', 'price' => 'RM 100', 'deposit' => 'RM 30', 'total_orders' => 14, 'status' => 'Draft'],
  ['name' => 'Renewal Forecast Report',   'sku' => 'PRD-1020', 'price' => 'RM 150', 'deposit' => 'RM 50', 'total_orders' => 11, 'status' => 'Active'],
];

$current_page = isset($_GET['page']) ? max(1, (int) $_GET['page']) : 1;
$per_page     = 10;
$total_items  = count($products);
$total_pages  = max(1, (int) ceil($total_items / $per_page));

if ($current_page > $total_pages) {
  $current_page = $total_pages;
}

$offset           = ($current_page - 1) * $per_page;
$products_on_page = array_slice($products, $offset, $per_page);
$table_rows       = [];
$product_drawers  = [];

foreach ($products_on_page as $product_index => $product) {
  $product_row_number = $offset + $product_index + 1;
  $drawer_id          = 'packages-quick-edit-' . (string) $product_row_number;

  $status_mode = 'neutral';
  if ($product['status'] === 'Active') {
    $status_mode = 'positive';
  } elseif ($product['status'] === 'Draft') {
    $status_mode = 'warning';
  } elseif ($product['status'] === 'Archived') {
    $status_mode = 'negative';
  }

  $status_badge = $capture('badge', [
    'label' => $product['status'],
    'mode'  => $status_mode,
  ]);

  $delete_button = $capture('button', [
    'label'      => 'Delete package',
    'aria_label' => 'Delete ' . $product['name'],
    'icon_name'  => 'trash',
    'icon_only'  => true,
    'attributes' => [
      'data-modal-open' => $delete_modal_id,
    ],
  ]);

  $view_button = $capture('button', [
    'label'      => 'Edit',
    'attributes' => [
      'data-drawer-open' => $drawer_id,
    ],
  ]);

  $table_rows[] = [
    'cells' => [
      [
        'html' => '
          <div class="table__media-cell">
            <div class="h-16 aspect-[4/3] shrink-0 rounded-md border border-gray-200 bg-gray-100"></div>
            <div class="table__stack">
              <p class="table__primary">' . e($product['name']) . '</p>
              <p class="table__secondary">' . e($product['sku']) . '</p>
            </div>
          </div>
        ',
      ],
      [
        'value' => $product['price'],
      ],
      [
        'value' => $product['deposit'],
      ],
      [
        'value' => (string) $product['total_orders'],
      ],
      [
        'html' => '<div class="table__badge-cell">' . $status_badge . '</div>',
      ],
      [
        'html'  => '<div class="table__actions">' . $delete_button . $view_button . '</div>',
        'align' => 'right',
      ],
    ],
  ];

  ob_start();
  ?>
  <form action="#" method="post" class="space-y-5">
    <?php
    component('input', [
      'id'          => 'quick-product-name-' . (string) $product_row_number,
      'name'        => 'product_name',
      'label'       => 'Product Name',
      'value'       => $product['name'],
      'placeholder' => 'Product name',
      'required'    => true,
    ]);

    component('input', [
      'id'          => 'quick-product-sku-' . (string) $product_row_number,
      'name'        => 'product_sku',
      'label'       => 'SKU',
      'value'       => $product['sku'],
      'placeholder' => 'PRD-1001',
      'required'    => true,
    ]);
    ?>

    <div class="grid gap-5 sm:grid-cols-2">
      <?php
      component('input', [
        'id'          => 'quick-product-price-' . (string) $product_row_number,
        'name'        => 'price',
        'type'        => 'text',
        'label'       => 'Price',
        'value'       => $product['price'],
        'placeholder' => 'RM 150',
      ]);

      component('input', [
        'id'          => 'quick-product-deposit-' . (string) $product_row_number,
        'name'        => 'deposit',
        'type'        => 'text',
        'label'       => 'Deposit',
        'value'       => $product['deposit'],
        'placeholder' => 'RM 50',
      ]);

      component('input', [
        'id'          => 'quick-product-orders-' . (string) $product_row_number,
        'name'        => 'total_orders',
        'type'        => 'number',
        'label'       => 'Total Orders',
        'value'       => (string) $product['total_orders'],
      ]);

      component('select', [
        'id'      => 'quick-product-status-' . (string) $product_row_number,
        'name'    => 'status',
        'label'   => 'Status',
        'value'   => strtolower($product['status']),
        'options' => [
          ['label' => 'Active', 'value' => 'active'],
          ['label' => 'Draft', 'value' => 'draft'],
          ['label' => 'Archived', 'value' => 'archived'],
        ],
      ]);
      ?>
    </div>
  </form>
  <?php
  $drawer_content = (string) ob_get_clean();

  $drawer_footer = '
    <div class="flex items-center gap-2">
      ' . $capture('button', [
        'label'      => 'Cancel',
        'attributes' => ['data-drawer-close' => true],
      ]) . '
      ' . $capture('button', [
        'label'   => 'Save Changes',
        'variant' => 'primary',
        'type'    => 'submit',
      ]) . '
    </div>
  ';

  $product_drawers[] = [
    'id'          => $drawer_id,
    'title'       => 'Edit Package',
    'description' => $product['name'],
    'content'     => $drawer_content,
    'footer'      => $drawer_footer,
  ];
}

$search_filter = $capture('search-input', [
  'id'          => 'packages-search',
  'name'        => 'packages_search',
  'label'       => '',
  'placeholder' => 'Find package by name or SKU',
  'icon_name'   => 'magnifying-glass',
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
        'title'       => 'All Packages',
        'description' => 'Manage package offerings with clear status and order visibility.',
      ]);
      ?>

      <div class="max-w-sm">
        <?= $search_filter ?>
      </div>

      <article class="card space-y-6" aria-label="Packages list">
        <?php
        component('table', [
          'headers' => [
            ['label' => 'Product',  'align' => 'left'],
            ['label' => 'Price',    'align' => 'left'],
            ['label' => 'Deposit',  'align' => 'left'],
            ['label' => 'Total Orders', 'align' => 'left'],
            ['label' => 'Status',   'align' => 'left'],
            ['label' => '',         'align' => 'right'],
          ],
          'rows' => $table_rows,
        ]);

        component('pagination', [
          'current_page' => $current_page,
          'total_pages'  => $total_pages,
          'show_info'    => true,
          'show_pages'   => true,
          'total_items'  => $total_items,
          'per_page'     => $per_page,
          'base_url'     => asset('/packages?page=%d'),
        ]);
        ?>
      </article>

      <?php
      component('modal', [
        'id'          => $delete_modal_id,
        'title'       => 'Delete Package',
        'description' => 'This action cannot be undone.',
        'dismissible' => true,
        'content'     => '<p class="text-secondary">Are you sure you want to delete this package?</p>',
        'footer'      => '
          <div class="flex items-center justify-end gap-2">
            ' . $capture('button', [
              'label'      => 'Cancel',
              'attributes' => ['data-modal-close' => true],
            ]) . '
            ' . $capture('button', [
              'label'      => 'Delete',
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
<?php foreach ($product_drawers as $product_drawer): ?>
  <?php
  component('drawer', [
    'id'          => $product_drawer['id'],
    'title'       => $product_drawer['title'],
    'description' => $product_drawer['description'],
    'content'     => $product_drawer['content'],
    'footer'      => $product_drawer['footer'],
    'placement'   => 'right',
    'size'        => 'lg',
  ]);
  ?>
<?php endforeach; ?>
<?php layout('layout-end'); ?>
