<?php

$page_title   = 'Trashed Portfolio';
$page_current = 'portfolio-trashed';

$menu_items = build_main_menu_items();

$capture = static function (string $component_name, array $props): string {
  ob_start();
  component($component_name, $props);
  return (string) ob_get_clean();
};

$trashed_items = [
  ['title' => 'Legacy Brand Preview', 'type' => 'Product', 'deleted_at' => '2 hours ago'],
  ['title' => 'Old Product Microsite', 'type' => 'Product', 'deleted_at' => '1 day ago'],
  ['title' => 'Campaign Mockup v1', 'type' => 'Product', 'deleted_at' => '4 days ago'],
  ['title' => 'Seasonal Promo Archive', 'type' => 'Product', 'deleted_at' => '1 week ago'],
];

$rows = [];
foreach ($trashed_items as $item) {
  $restore_button = $capture('button', [
    'label' => 'Restore',
    'href'  => '#',
  ]);

  $delete_button = $capture('button', [
    'label'   => 'Delete Permanently',
    'variant' => 'danger',
    'href'    => '#',
  ]);

  $rows[] = [
    'cells' => [
      [
        'html' => '
          <div class="table__media-cell">
            <div class="h-14 w-14 shrink-0 rounded-md border border-gray-200 bg-gray-100"></div>
            <div class="table__stack">
              <p class="table__primary">' . e($item['title']) . '</p>
              <p class="table__secondary">' . e($item['type']) . '</p>
            </div>
          </div>
        ',
      ],
      ['value' => $item['deleted_at']],
      [
        'html'  => '<div class="table__actions">' . $restore_button . $delete_button . '</div>',
        'align' => 'right',
      ],
    ],
  ];
}

layout('app-start', [
  'page_title'   => $page_title,
  'page_current' => $page_current,
]);
?>
    <section class="card" aria-label="Trashed portfolio list">
      <div class="card__head">
        <?php
        component('page-header', [
          'title'       => 'Trashed Portfolio',
          'description' => 'Restore or permanently remove deleted portfolio items.',
        ]);
        ?>
      </div>

      <article class="card__table">
        <?php
        component('table', [
          'class'   => 'table--comfortable',
          'headers' => [
            ['label' => 'Portfolio', 'align' => 'left'],
            ['label' => 'Deleted', 'align' => 'left'],
            ['label' => '', 'align' => 'right'],
          ],
          'rows' => $rows,
        ]);
        ?>
      </article>
    </section>
<?php layout('app-end'); ?>
