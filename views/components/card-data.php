<?php

$orders = is_array($orders ?? null) ? $orders : [];

$headers = [
  'Order',
  'Customer',
  [
    'label' => 'Payment',
    'align' => 'right',
  ],
  [
    'label' => 'Status',
    'align' => 'right',
  ],
  'Action',
];

$rows = [];

foreach ($orders as $order) {
  $session_raw = isset($order['session']) ? (string) $order['session'] : '';

  $session_dt = DateTime::createFromFormat('Y-m-d h:i A', $session_raw);
  if (!$session_dt) {
    $session_dt = DateTime::createFromFormat('Y-m-d H:i', $session_raw);
  }

  $session_brief = $session_dt ? $session_dt->format('d M / h:i A') : ($session_raw !== '' ? $session_raw : '-');

  $created_at_raw = isset($order['created_at']) ? (string) $order['created_at'] : '';
  $created_date   = $created_at_raw !== '' ? $created_at_raw : '-';
  $created_time   = '';

  if (preg_match('/^(\d{1,2}\s+[A-Za-z]{3}),\s*(\d{1,2}:\d{2}\s*[AP]M)$/', $created_at_raw, $matches) === 1) {
    $year         = $session_dt ? $session_dt->format('Y') : date('Y');
    $created_date = $matches[1] . ' ' . $year;
    $created_time = $matches[2];
  }

  $customer_phone_raw = isset($order['customer_phone']) ? (string) $order['customer_phone'] : '';
  $customer_digits    = preg_replace('/\D+/', '', $customer_phone_raw);
  $customer_phone     = $customer_phone_raw;

  if (is_string($customer_digits)) {
    if (strlen($customer_digits) === 10) {
      $customer_phone = substr($customer_digits, 0, 3) . '-' . substr($customer_digits, 3, 4) . '-' . substr($customer_digits, 7, 3);
    } elseif (strlen($customer_digits) === 11) {
      $customer_phone = substr($customer_digits, 0, 3) . '-' . substr($customer_digits, 3, 4) . '-' . substr($customer_digits, 7, 4);
    }
  }

  $payment_label = isset($order['payment']) ? (string) $order['payment'] : '-';
  $status_label  = isset($order['status']) ? (string) $order['status'] : '-';

  $payment_mode = 'neutral';
  if (strtolower($payment_label) === 'paid full') {
    $payment_mode = 'positive';
  } elseif (strtolower($payment_label) === 'paid deposit') {
    $payment_mode = 'warning';
  } elseif (strtolower($payment_label) === 'processing') {
    $payment_mode = 'info';
  }

  $status_mode = 'neutral';
  if (strtolower($status_label) === 'completed') {
    $status_mode = 'positive';
  } elseif (strtolower($status_label) === 'pending') {
    $status_mode = 'warning';
  } elseif (strtolower($status_label) === 'in progress') {
    $status_mode = 'info';
  } elseif (strtolower($status_label) === 'priority') {
    $status_mode = 'accent';
  } elseif (strtolower($status_label) === 'failed' || strtolower($status_label) === 'cancelled') {
    $status_mode = 'negative';
  }

  $rows[] = [
    'cells' => [
      [
        'media_placeholder' => true,
        'primary' => $order['studio'] ?? '-',
        'secondary' => $order['code'] ?? '-',
        'tertiary' => trim($created_date . ($created_time !== '' ? ', ' . $created_time : '')),
      ],
      [
        'primary' => $order['customer_name'] ?? '-',
        'secondary' => $customer_phone !== '' ? $customer_phone : '-',
        'tertiary' => $session_brief,
      ],
      [
        'badge' => [
          'label' => $payment_label,
          'mode' => $payment_mode,
        ],
        'align' => 'right',
      ],
      [
        'badge' => [
          'label' => $status_label,
          'mode' => $status_mode,
        ],
        'align' => 'right',
      ],
    ],
    'actions' => [
      [
        'label' => 'Manage',
        'href'  => isset($order['manage_url']) ? (string) $order['manage_url'] : '#',
        'kind'  => 'default',
      ],
    ],
  ];
}
?>
<section class="<?= e($component_class) ?> overflow-hidden">
  <header class="card__header flex items-center justify-between gap-3">
    <div>
      <h2 class="text-xl font-semibold text-gray-900">Orders</h2>
      <p class="text-gray-500 mt-1">Booking orders by studio, session, payment, and status.</p>
    </div>
    <span class="badge badge--neutral"><?= e((string) count($orders)) ?> records</span>
  </header>

  <div class="card__content">
    <?php component('table', ['headers' => $headers, 'rows' => $rows]); ?>
  </div>

  <footer class="card__footer">
    <p class="text-sm text-gray-500">Showing 1 to <?= e((string) count($orders)) ?> of <?= e((string) count($orders)) ?> orders</p>
    <div class="flex items-center gap-2">
      <button class="rounded-md border border-gray-200 px-3 py-1.5 text-xs font-medium text-gray-600 hover:bg-gray-100">Previous</button>
      <button class="rounded-md border border-gray-200 px-3 py-1.5 text-xs font-medium text-gray-700 hover:bg-gray-100">Next</button>
    </div>
  </footer>
</section>
