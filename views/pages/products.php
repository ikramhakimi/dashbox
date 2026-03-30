<?php

$page_title   = 'All Products';
$page_current = 'products';

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

$delete_modal_id = 'products-delete-confirm';

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

foreach ($products_on_page as $product) {
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
    'label'      => 'Delete product',
    'aria_label' => 'Delete ' . $product['name'],
    'icon_name'  => 'trash',
    'icon_only'  => true,
    'attributes' => [
      'data-modal-open' => $delete_modal_id,
    ],
  ]);

  $view_button = $capture('button', [
    'label'   => 'Edit',
    'href'    => asset('/product-add'),
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
}

$search_filter = $capture('search-input', [
  'id'          => 'products-search',
  'name'        => 'products_search',
  'label'       => '',
  'placeholder' => 'Find product by name or SKU',
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
    <section class="space-y-6">
      <?php
      component('page-header', [
        'title'       => 'All Products',
        'description' => 'Manage catalog items with clear status and stock visibility.',
      ]);
      ?>

      <article class="card space-y-6" aria-label="Products list">
        <div class="max-w-sm">
          <?= $search_filter ?>
        </div>

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
          'base_url'     => asset('/products?page=%d'),
        ]);
        ?>
      </article>

      <?php
      component('modal', [
        'id'          => $delete_modal_id,
        'title'       => 'Delete Product',
        'description' => 'This action cannot be undone.',
        'dismissible' => true,
        'content'     => '<p class="text-gray-600">Are you sure you want to delete this product?</p>',
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
<?php layout('layout-end'); ?>
