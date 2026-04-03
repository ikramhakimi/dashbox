<?php

$page_title   = 'Analytics Overview';
$page_current = 'analytics-overview';

$menu_items = build_main_menu_items();

$capture = static function (string $component_name, array $props): string {
  ob_start();
  component($component_name, $props);
  return (string) ob_get_clean();
};

$date_range = '05 Mar ~ 03 Apr';

$metric_cards = [
  [
    'title'      => 'Pageviews',
    'value'      => '984',
    'trend'      => $date_range,
    'trend_mode' => 'neutral',
    'note'       => 'Total pageviews',
    'icon_name'  => 'eye',
  ],
  [
    'title'      => 'Unique Visitors',
    'value'      => '542',
    'trend'      => $date_range,
    'trend_mode' => 'neutral',
    'note'       => 'Unique visitors',
    'icon_name'  => 'users',
  ],
  [
    'title'      => 'Sessions',
    'value'      => '614',
    'trend'      => $date_range,
    'trend_mode' => 'neutral',
    'note'       => 'Total sessions',
    'icon_name'  => 'activity',
  ],
  [
    'title'      => 'Clicks',
    'value'      => '315',
    'trend'      => $date_range,
    'trend_mode' => 'neutral',
    'note'       => 'Tracked clicks',
    'icon_name'  => 'mouse-pointer-click',
  ],
];

$top_referrers_headers = [
  ['label' => 'Source', 'align' => 'left'],
  ['label' => 'Sessions', 'align' => 'right'],
];

$top_referrers_rows = [
  ['cells' => [['primary' => 'l.instagram.com', 'secondary' => 'utm'], ['value' => '60', 'align' => 'right']]],
  ['cells' => [['primary' => 'm.facebook.com', 'secondary' => 'utm'], ['value' => '53', 'align' => 'right']]],
  ['cells' => [['primary' => 'l.instagram.com', 'secondary' => 'social'], ['value' => '18', 'align' => 'right']]],
  ['cells' => [['primary' => 'm.facebook.com', 'secondary' => 'social'], ['value' => '18', 'align' => 'right']]],
  ['cells' => [['primary' => 'google.com', 'secondary' => 'referral'], ['value' => '17', 'align' => 'right']]],
  ['cells' => [['primary' => 'lm.facebook.com', 'secondary' => 'social'], ['value' => '17', 'align' => 'right']]],
  ['cells' => [['primary' => 'facebook.com', 'secondary' => 'social'], ['value' => '6', 'align' => 'right']]],
  ['cells' => [['primary' => 'instagram.com', 'secondary' => 'social'], ['value' => '4', 'align' => 'right']]],
  ['cells' => [['primary' => 'instagram.com', 'secondary' => 'utm'], ['value' => '4', 'align' => 'right']]],
  ['cells' => [['primary' => 'thecameraguystudio.com', 'secondary' => 'utm'], ['value' => '4', 'align' => 'right']]],
];

$top_social_headers = [
  ['label' => 'Network', 'align' => 'left'],
  ['label' => 'Sessions', 'align' => 'right'],
];

$top_social_rows = [
  ['cells' => [['value' => 'Facebook'], ['value' => '42', 'align' => 'right']]],
  ['cells' => [['value' => 'Instagram'], ['value' => '22', 'align' => 'right']]],
];

$top_campaigns_headers = [
  ['label' => 'Campaign', 'align' => 'left'],
  ['label' => 'Pageviews', 'align' => 'right'],
];

$top_campaigns_rows = [
  ['cells' => [['primary' => 'IG-AD-RAYA26', 'secondary' => 'IG-SOCIAL / instagram'], ['value' => '118', 'align' => 'right']]],
  ['cells' => [['primary' => 'FB-AD-RAYA26', 'secondary' => '120243728270780045 / facebook'], ['value' => '71', 'align' => 'right']]],
];

$top_click_headers = [
  ['label' => 'Label', 'align' => 'left'],
  ['label' => 'Clicks', 'align' => 'right'],
];

$top_click_rows = [
  ['cells' => [['value' => '/store/booking/form/SR26'], ['value' => '145', 'align' => 'right']]],
  ['cells' => [['value' => '/'], ['value' => '39', 'align' => 'right']]],
  ['cells' => [['value' => '/store/booking/form/RK26'], ['value' => '37', 'align' => 'right']]],
  ['cells' => [['value' => '/store/booking/form/LR26'], ['value' => '27', 'align' => 'right']]],
  ['cells' => [['value' => '/ul'], ['value' => '16', 'align' => 'right']]],
  ['cells' => [['value' => '/store/booking/form-post/SR26'], ['value' => '15', 'align' => 'right']]],
  ['cells' => [['value' => '/sitemap.xml'], ['value' => '13', 'align' => 'right']]],
  ['cells' => [['value' => '/store/booking/form/RI26'], ['value' => '10', 'align' => 'right']]],
  ['cells' => [['value' => '/store/booking/form-post/RK26'], ['value' => '5', 'align' => 'right']]],
  ['cells' => [['value' => '/store/booking/form-post/LR26'], ['value' => '3', 'align' => 'right']]],
];

$top_pages_headers = [
  ['label' => 'Page', 'align' => 'left'],
  ['label' => 'Pageviews', 'align' => 'right'],
  ['label' => 'Visitors', 'align' => 'right'],
];

$top_pages_rows = [
  ['cells' => [['primary' => 'Pilih Tema Anda - TheCameraGuyStudio', 'secondary' => '/'], ['value' => '685', 'align' => 'right'], ['value' => '506', 'align' => 'right']]],
  ['cells' => [['primary' => 'Serambi Raya | Tempahan Studio - TheCameraGuyStudio', 'secondary' => '/store/booking/form/SR26'], ['value' => '179', 'align' => 'right'], ['value' => '114', 'align' => 'right']]],
  ['cells' => [['primary' => 'Raya Kasih | Tempahan Studio - TheCameraGuyStudio', 'secondary' => '/store/booking/form/RK26'], ['value' => '47', 'align' => 'right'], ['value' => '40', 'align' => 'right']]],
  ['cells' => [['primary' => 'Laman Raya | Tempahan Studio - TheCameraGuyStudio', 'secondary' => '/store/booking/form/LR26'], ['value' => '34', 'align' => 'right'], ['value' => '28', 'align' => 'right']]],
  ['cells' => [['primary' => 'Raya Indah | Tempahan Studio - TheCameraGuyStudio', 'secondary' => '/store/booking/form/RI26'], ['value' => '11', 'align' => 'right'], ['value' => '9', 'align' => 'right']]],
  ['cells' => [['primary' => 'Something Went Wrong - TheCameraGuyStudio', 'secondary' => '/app/auth/login-post'], ['value' => '6', 'align' => 'right'], ['value' => '3', 'align' => 'right']]],
  ['cells' => [['primary' => 'Pilih Tema Anda - TheCameraGuyStudio', 'secondary' => '/store'], ['value' => '4', 'align' => 'right'], ['value' => '4', 'align' => 'right']]],
  ['cells' => [['primary' => 'Photography Session Experience Feedback - TheCameraGuyStudio', 'secondary' => '/store/order-feedback/2369ae08-060b-4807-93db-8cd334d1649d'], ['value' => '3', 'align' => 'right'], ['value' => '1', 'align' => 'right']]],
  ['cells' => [['primary' => 'Profile Update - TheCameraGuyStudio', 'secondary' => '/store/customer-profile/54db7128-2281-4fca-9ddd-9aff1d313d1e'], ['value' => '2', 'align' => 'right'], ['value' => '1', 'align' => 'right']]],
  ['cells' => [['primary' => '404 - Page Not Found - TheCameraGuyStudio', 'secondary' => '/login'], ['value' => '2', 'align' => 'right'], ['value' => '1', 'align' => 'right']]],
];

layout('app-start', [
  'page_title'   => $page_title,
  'page_current' => $page_current,
]);
?>
<section class="card">
  <div class="card__head">
    <?php
    component('page-header', [
      'title'       => 'Analytics Overview',
      'description' => 'Traffic and engagement summary for selected date range.',
    ]);
    ?>
  </div>

  <div class="card__body inline-flex flex-wrap items-end gap-3" aria-label="Analytics filter form">
    <div class="w-52">
      <?php
      component('input', [
        'id'    => 'analytics-date-from',
        'name'  => 'analytics_date_from',
        'label' => 'Date From',
        'type'  => 'date',
        'value' => '2026-03-05',
      ]);
      ?>
    </div>
    <div class="w-52">
      <?php
      component('input', [
        'id'    => 'analytics-date-to',
        'name'  => 'analytics_date_to',
        'label' => 'Date To',
        'type'  => 'date',
        'value' => '2026-04-03',
      ]);
      ?>
    </div>
    <div class="w-40">
      <?= $capture('button', ['label' => 'Filter', 'variant' => 'primary']) ?>
    </div>
  </div>

  <section class="card__body grid gap-4 lg:grid-cols-4" aria-label="Analytics metric cards">
    <?php foreach ($metric_cards as $metric_card): ?>
      <?php component('card-metric', $metric_card); ?>
    <?php endforeach; ?>
  </section>

  <section class="card__body grid items-start gap-4 xl:grid-cols-2" aria-label="Analytics top pages and click events">
    <article class="card">
      <header class="card__head">
        <h2 class="card__title">Top Pages</h2>
        <p class="card__description"><?= e($date_range) ?></p>
      </header>
      <div class="card__table">
        <?php component('table', ['headers' => $top_pages_headers, 'rows' => $top_pages_rows]); ?>
      </div>
    </article>

    <article class="card">
      <header class="card__head">
        <h2 class="card__title">Top Click Events</h2>
        <p class="card__description"><?= e($date_range) ?></p>
      </header>
      <div class="card__table">
        <?php component('table', ['headers' => $top_click_headers, 'rows' => $top_click_rows]); ?>
      </div>
    </article>
  </section>

  <section class="card__body grid items-start gap-4 xl:grid-cols-3" aria-label="Analytics top tables">
    <article class="card">
      <header class="card__head">
        <h2 class="card__title">Top Referrers</h2>
        <p class="card__description"><?= e($date_range) ?></p>
      </header>
      <div class="card__table">
        <?php component('table', ['headers' => $top_referrers_headers, 'rows' => $top_referrers_rows]); ?>
      </div>
    </article>

    <article class="card">
      <header class="card__head">
        <h2 class="card__title">Top Social Traffic</h2>
        <p class="card__description"><?= e($date_range) ?></p>
      </header>
      <div class="card__table">
        <?php component('table', ['headers' => $top_social_headers, 'rows' => $top_social_rows]); ?>
      </div>
    </article>

    <article class="card">
      <header class="card__head">
        <h2 class="card__title">Top Campaigns</h2>
        <p class="card__description"><?= e($date_range) ?></p>
      </header>
      <div class="card__table">
        <?php component('table', ['headers' => $top_campaigns_headers, 'rows' => $top_campaigns_rows]); ?>
      </div>
    </article>
  </section>
</section>
<?php layout('app-end'); ?>
