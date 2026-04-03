<?php

$page_title   = 'Analytics Pageviews';
$page_current = 'analytics-pageviews';

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
    'trend'      => '+12.4%',
    'trend_mode' => 'positive',
    'note'       => 'vs previous 30 days',
    'icon_name'  => 'eye',
  ],
  [
    'title'      => 'Unique Visitors',
    'value'      => '542',
    'trend'      => '+8.1%',
    'trend_mode' => 'positive',
    'note'       => 'vs previous 30 days',
    'icon_name'  => 'users',
  ],
  [
    'title'      => 'Sessions',
    'value'      => '614',
    'trend'      => '+4.9%',
    'trend_mode' => 'positive',
    'note'       => 'vs previous 30 days',
    'icon_name'  => 'activity',
  ],
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
  ['cells' => [['primary' => 'Booking Confirmed - TheCameraGuyStudio', 'secondary' => '/store/booking/confirmed'], ['value' => '2', 'align' => 'right'], ['value' => '1', 'align' => 'right']]],
  ['cells' => [['primary' => 'Campaign Landing | Raya Special - TheCameraGuyStudio', 'secondary' => '/campaign/raya-special'], ['value' => '2', 'align' => 'right'], ['value' => '1', 'align' => 'right']]],
  ['cells' => [['primary' => 'FAQ - TheCameraGuyStudio', 'secondary' => '/faq'], ['value' => '1', 'align' => 'right'], ['value' => '1', 'align' => 'right']]],
  ['cells' => [['primary' => 'Contact Us - TheCameraGuyStudio', 'secondary' => '/contact'], ['value' => '1', 'align' => 'right'], ['value' => '1', 'align' => 'right']]],
];

$daily_pageviews_headers = [
  ['label' => 'Date', 'align' => 'left'],
  ['label' => 'Pageviews', 'align' => 'right'],
  ['label' => 'Unique Visitors', 'align' => 'right'],
  ['label' => 'Sessions', 'align' => 'right'],
];

$daily_pageviews_rows = [
  ['cells' => [['value' => 'Mar 14, Sat'], ['value' => '30', 'align' => 'right'], ['value' => '17', 'align' => 'right'], ['value' => '17', 'align' => 'right']]],
  ['cells' => [['value' => 'Mar 15, Sun'], ['value' => '77', 'align' => 'right'], ['value' => '38', 'align' => 'right'], ['value' => '40', 'align' => 'right']]],
  ['cells' => [['value' => 'Mar 16, Mon'], ['value' => '154', 'align' => 'right'], ['value' => '80', 'align' => 'right'], ['value' => '84', 'align' => 'right']]],
  ['cells' => [['value' => 'Mar 17, Tue'], ['value' => '93', 'align' => 'right'], ['value' => '63', 'align' => 'right'], ['value' => '66', 'align' => 'right']]],
  ['cells' => [['value' => 'Mar 18, Wed'], ['value' => '145', 'align' => 'right'], ['value' => '105', 'align' => 'right'], ['value' => '106', 'align' => 'right']]],
  ['cells' => [['value' => 'Mar 19, Thu'], ['value' => '55', 'align' => 'right'], ['value' => '29', 'align' => 'right'], ['value' => '31', 'align' => 'right']]],
  ['cells' => [['value' => 'Mar 20, Fri'], ['value' => '42', 'align' => 'right'], ['value' => '25', 'align' => 'right'], ['value' => '25', 'align' => 'right']]],
  ['cells' => [['value' => 'Mar 21, Sat'], ['value' => '54', 'align' => 'right'], ['value' => '30', 'align' => 'right'], ['value' => '31', 'align' => 'right']]],
  ['cells' => [['value' => 'Mar 22, Sun'], ['value' => '24', 'align' => 'right'], ['value' => '14', 'align' => 'right'], ['value' => '14', 'align' => 'right']]],
  ['cells' => [['value' => 'Mar 23, Mon'], ['value' => '42', 'align' => 'right'], ['value' => '15', 'align' => 'right'], ['value' => '18', 'align' => 'right']]],
  ['cells' => [['value' => 'Mar 24, Tue'], ['value' => '49', 'align' => 'right'], ['value' => '36', 'align' => 'right'], ['value' => '37', 'align' => 'right']]],
  ['cells' => [['value' => 'Mar 25, Wed'], ['value' => '34', 'align' => 'right'], ['value' => '21', 'align' => 'right'], ['value' => '23', 'align' => 'right']]],
  ['cells' => [['value' => 'Mar 26, Thu'], ['value' => '32', 'align' => 'right'], ['value' => '21', 'align' => 'right'], ['value' => '23', 'align' => 'right']]],
  ['cells' => [['value' => 'Mar 27, Fri'], ['value' => '32', 'align' => 'right'], ['value' => '22', 'align' => 'right'], ['value' => '24', 'align' => 'right']]],
  ['cells' => [['value' => 'Mar 28, Sat'], ['value' => '23', 'align' => 'right'], ['value' => '14', 'align' => 'right'], ['value' => '17', 'align' => 'right']]],
  ['cells' => [['value' => 'Mar 29, Sun'], ['value' => '14', 'align' => 'right'], ['value' => '11', 'align' => 'right'], ['value' => '11', 'align' => 'right']]],
  ['cells' => [['value' => 'Mar 30, Mon'], ['value' => '23', 'align' => 'right'], ['value' => '11', 'align' => 'right'], ['value' => '15', 'align' => 'right']]],
  ['cells' => [['value' => 'Mar 31, Tue'], ['value' => '22', 'align' => 'right'], ['value' => '8', 'align' => 'right'], ['value' => '10', 'align' => 'right']]],
  ['cells' => [['value' => 'Apr 01, Wed'], ['value' => '20', 'align' => 'right'], ['value' => '8', 'align' => 'right'], ['value' => '8', 'align' => 'right']]],
  ['cells' => [['value' => 'Apr 02, Thu'], ['value' => '13', 'align' => 'right'], ['value' => '9', 'align' => 'right'], ['value' => '9', 'align' => 'right']]],
  ['cells' => [['value' => 'Apr 03, Fri'], ['value' => '23', 'align' => 'right'], ['value' => '12', 'align' => 'right'], ['value' => '14', 'align' => 'right']]],
];

layout('app-start', [
  'page_title'   => $page_title,
  'page_current' => $page_current,
]);
?>
<section class="space-y-6">
  <section aria-label="Analytics pageviews header">
    <?php
    component('page-header', [
      'title'       => 'Pageviews',
      'description' => 'Monitor pageview volume and daily traffic consistency across the selected date range.',
    ]);
    ?>
  </section>

  <section aria-label="Analytics controls">
    <div class="inline-flex w-full flex-wrap items-end gap-3">
      <div class="w-52">
        <?php
        component('input', [
          'id'    => 'analytics-pageviews-date-from',
          'name'  => 'analytics_pageviews_date_from',
          'label' => 'Date From',
          'type'  => 'date',
          'value' => '2026-03-05',
        ]);
        ?>
      </div>
      <div class="w-52">
        <?php
        component('input', [
          'id'    => 'analytics-pageviews-date-to',
          'name'  => 'analytics_pageviews_date_to',
          'label' => 'Date To',
          'type'  => 'date',
          'value' => '2026-04-03',
        ]);
        ?>
      </div>
      <div class="w-40">
        <?= $capture('button', ['label' => 'Apply Filter', 'variant' => 'primary']) ?>
      </div>
      <div class="ml-auto">
        <?= $capture('button', ['label' => 'Export CSV', 'icon_name' => 'download-2-line']) ?>
      </div>
    </div>
  </section>

  <section class="grid gap-4 lg:grid-cols-3" aria-label="Pageviews metric cards">
    <?php foreach ($metric_cards as $metric_card): ?>
      <?php component('card-metric', $metric_card); ?>
    <?php endforeach; ?>
  </section>

  <section class="grid gap-4 xl:grid-cols-2" aria-label="Pageviews data tables">
    <article class="card">
      <header class="card__head">
        <h3 class="card__title">Daily Pageviews</h3>
        <p class="card__description">Daily traffic trend with pageviews, unique visitors, and sessions.</p>
        <p class="card__description"><?= e($date_range) ?></p>
      </header>
      <div class="card__table">
        <?php component('table', ['headers' => $daily_pageviews_headers, 'rows' => $daily_pageviews_rows]); ?>
      </div>
    </article>

    <article class="card">
      <header class="card__head">
        <h3 class="card__title">Top Pages</h3>
        <p class="card__description">Most visited pages ranked by pageviews and visitor reach.</p>
        <p class="card__description"><?= e($date_range) ?></p>
      </header>
      <div class="card__table">
        <?php component('table', ['headers' => $top_pages_headers, 'rows' => $top_pages_rows]); ?>
      </div>
    </article>
  </section>
</section>
<?php layout('app-end'); ?>
