<?php

$page_title   = 'All Portfolio';
$page_current = 'portfolio';

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

$portfolio_items = [
  ['title' => 'Spring Campaign Pack', 'type' => 'Product', 'images' => 9,  'updated' => '2 hours ago', 'status' => 'Published'],
  ['title' => 'Corporate Branding 2026', 'type' => 'Product', 'images' => 7, 'updated' => '1 day ago', 'status' => 'Published'],
  ['title' => 'Retail Promo Boards', 'type' => 'Product', 'images' => 10, 'updated' => '3 days ago', 'status' => 'Published'],
  ['title' => 'Studio Product Shoot', 'type' => 'Product', 'images' => 6,  'updated' => '5 days ago', 'status' => 'Draft'],
  ['title' => 'UI Launch Screens', 'type' => 'Product', 'images' => 8, 'updated' => '1 week ago', 'status' => 'Published'],
  ['title' => 'Marketplace Banners', 'type' => 'Product', 'images' => 5, 'updated' => '1 week ago', 'status' => 'Draft'],
  ['title' => 'Travel Feature Cards', 'type' => 'Product', 'images' => 10, 'updated' => '2 weeks ago', 'status' => 'Published'],
  ['title' => 'Event Promo Assets', 'type' => 'Product', 'images' => 4,  'updated' => '2 weeks ago', 'status' => 'Draft'],
  ['title' => 'Premium Product Bundle', 'type' => 'Product', 'images' => 10, 'updated' => '3 weeks ago', 'status' => 'Published'],
  ['title' => 'Summer Feature Deck', 'type' => 'Product', 'images' => 6, 'updated' => '1 month ago', 'status' => 'Published'],
];

$rows = [];
foreach ($portfolio_items as $item) {
  $status_mode = $item['status'] === 'Published' ? 'positive' : 'warning';

  $status_badge = $capture('badge', [
    'label' => $item['status'],
    'mode'  => $status_mode,
  ]);

  $view_button = $capture('button', [
    'label'      => 'View portfolio',
    'aria_label' => 'View ' . $item['title'],
    'icon_name'  => 'eye',
    'icon_only'  => true,
    'href'       => '#',
  ]);

  $more_dropdown = $capture('dropdown', [
    'trigger_label' => 'More',
    'trigger_size'  => 'sm',
    'items'         => [
      ['label' => 'Edit Portfolio', 'href' => asset('/portfolio/create')],
      ['label' => 'Duplicate', 'href' => '#'],
      ['type' => 'divider'],
      ['label' => 'Move to Trash', 'href' => asset('/portfolio/trashed'), 'kind' => 'danger'],
    ],
  ]);

  $rows[] = [
    'cells' => [
      [
        'html' => '
          <div class="table__media-cell">
            <div class="h-16 w-16 shrink-0 rounded-md border border-gray-200 bg-gray-100"></div>
            <div class="table__stack">
              <p class="table__primary">' . e($item['title']) . '</p>
              <p class="table__secondary">' . e($item['type']) . '</p>
            </div>
          </div>
        ',
      ],
      [
        'value' => (string) $item['images'] . '/10',
      ],
      [
        'value' => $item['updated'],
      ],
      [
        'html' => '<div class="table__badge-cell">' . $status_badge . '</div>',
      ],
      [
        'html'  => '<div class="table__actions">' . $view_button . $more_dropdown . '</div>',
        'align' => 'right',
      ],
    ],
  ];
}

$search = $capture('search-input', [
  'id'          => 'portfolio-search',
  'name'        => 'portfolio_search',
  'label'       => '',
  'placeholder' => 'Find portfolio by title',
]);

$filter = $capture('select', [
  'id'      => 'portfolio-filter',
  'name'    => 'portfolio_filter',
  'label'   => '',
  'value'   => 'all',
  'options' => [
    ['label' => 'All Status', 'value' => 'all'],
    ['label' => 'Published', 'value' => 'published'],
    ['label' => 'Draft', 'value' => 'draft'],
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
        'title'       => 'All Portfolio',
        'description' => 'Manage published and draft portfolio sets in one place.',
      ]);
      ?>

      <div class="inline-flex flex-wrap items-end gap-3" aria-label="Portfolio filters">
        <div class="w-80">
          <?= $search ?>
        </div>
        <div class="w-48">
          <?= $filter ?>
        </div>
      </div>

      <article class="card space-y-6" aria-label="Portfolio table">
        <?php
        component('table', [
          'headers' => [
            ['label' => 'Portfolio', 'align' => 'left'],
            ['label' => 'Images', 'align' => 'left'],
            ['label' => 'Updated', 'align' => 'left'],
            ['label' => 'Status', 'align' => 'left'],
            ['label' => '', 'align' => 'right'],
          ],
          'rows' => $rows,
        ]);

        component('pagination', [
          'current_page' => 1,
          'total_pages'  => 3,
          'show_info'    => true,
          'show_pages'   => true,
          'total_items'  => 30,
          'per_page'     => 10,
          'base_url'     => asset('/portfolio?page=%d'),
        ]);
        ?>
      </article>
    </section>
  </main>
</div>
<?php layout('layout-end'); ?>
