<?php

$page_title   = 'All Customers';
$page_current = 'customers';

$menu_items = build_main_menu_items();

$capture = static function (string $component_name, array $props): string {
  ob_start();
  component($component_name, $props);
  return (string) ob_get_clean();
};

$customers = [
  ['name' => 'Aisyah Rahman', 'phone' => '012-882 1044', 'gender' => 'Female', 'age' => '31', 'marital_status' => 'Married',  'occupation' => 'Entrepreneur',               'orders' => '8',  'latest_order' => 'ORD-1042 · 30 Mar 2026', 'avg_rating' => '4.9'],
  ['name' => 'Farid Salleh',  'phone' => '011-332 9132', 'gender' => 'Male',   'age' => '29', 'marital_status' => 'Single',   'occupation' => 'Software Developer',         'orders' => '5',  'latest_order' => 'ORD-1038 · 27 Mar 2026', 'avg_rating' => '4.7'],
  ['name' => 'Nadia Ismail',  'phone' => '017-664 7412', 'gender' => 'Female', 'age' => '34', 'marital_status' => 'Married',  'occupation' => 'Marketing / Sales',          'orders' => '11', 'latest_order' => 'ORD-1047 · 01 Apr 2026', 'avg_rating' => '4.8'],
  ['name' => 'Darren Wong',   'phone' => '013-220 9918', 'gender' => 'Male',   'age' => '37', 'marital_status' => 'Married',  'occupation' => 'Manager',                    'orders' => '6',  'latest_order' => 'ORD-1035 · 24 Mar 2026', 'avg_rating' => '4.6'],
  ['name' => 'Syafiq Azhar',  'phone' => '018-779 6502', 'gender' => 'Male',   'age' => '27', 'marital_status' => 'Single',   'occupation' => 'Content Creator / Influencer','orders' => '4',  'latest_order' => 'ORD-1045 · 31 Mar 2026', 'avg_rating' => '4.5'],
  ['name' => 'Nurin Sofea',   'phone' => '014-519 2830', 'gender' => 'Female', 'age' => '33', 'marital_status' => 'Married',  'occupation' => 'Doctor',                     'orders' => '9',  'latest_order' => 'ORD-1041 · 29 Mar 2026', 'avg_rating' => '4.9'],
];

$rows = [];
foreach ($customers as $customer) {
  $rows[] = [
    'cells' => [
      [
        'html' => '
          <div class="table__stack">
            <p class="table__primary">' . e($customer['name']) . '</p>
            <p class="table__secondary">' . e($customer['latest_order']) . '</p>
          </div>',
      ],
      $customer['phone'],
      $customer['gender'],
      ['value' => $customer['age'], 'align' => 'right'],
      $customer['marital_status'],
      $customer['occupation'],
      ['value' => $customer['orders'], 'align' => 'right'],
      ['value' => $customer['avg_rating'], 'align' => 'right'],
      [
        'html'  => $capture('button', [
          'label' => 'Open Profile',
          'href'  => asset('/customers/profile'),
        ]),
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
    <section class="mx-auto max-w-7xl space-y-6">
      <?php component('page-header', [
        'title'       => 'Customers',
        'description' => 'Customer overview for contact info, purchase behavior, and post-session satisfaction.',
        'actions'     => [
          [
            'label'   => 'Open Customer Profile Form',
            'href'    => asset('/customers/profile'),
            'variant' => 'primary',
          ],
        ],
      ]); ?>

      <article class="card" aria-label="Customer list table">
        <div class="card__table">
          <?php component('table', [
            'class'   => 'table--comfortable',
            'headers' => [
              'Customer',
              'Phone',
              'Gender',
              ['label' => 'Age', 'align' => 'right'],
              'Marital Status',
              'Occupation',
              ['label' => 'Orders', 'align' => 'right'],
              ['label' => 'Avg Rating', 'align' => 'right'],
              ['label' => 'Action', 'align' => 'right'],
            ],
            'rows' => $rows,
          ]); ?>
        </div>
      </article>
    </section>
<?php layout('app-end'); ?>
