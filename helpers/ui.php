<?php

declare(strict_types=1);

if (!defined('BASE_PATH')) {
  $configured_base_path = rtrim((string) getenv('APP_BASE_PATH'), '/');

  if ($configured_base_path === '') {
    $script_name        = isset($_SERVER['SCRIPT_NAME']) ? (string) $_SERVER['SCRIPT_NAME'] : '';
    $detected_base_path = str_replace('\\', '/', dirname($script_name));
    $detected_base_path = $detected_base_path === '/' || $detected_base_path === '.'
      ? ''
      : rtrim($detected_base_path, '/');

    define('BASE_PATH', $detected_base_path);
  } else {
    define('BASE_PATH', $configured_base_path);
  }
}

function asset(string $path): string
{
  $clean_path = '/' . ltrim($path, '/');

  if (BASE_PATH === '' || BASE_PATH === '/') {
    return $clean_path;
  }

  return BASE_PATH . $clean_path;
}

function ui_elements_sidebar_children(string $active_page = ''): array
{
  $items = [
    'alerts'      => 'Alerts',
    'avatars'     => 'Avatars',
    'badges'      => 'Badges',
    'breadcrumbs' => 'Breadcrumbs',
    'buttons'     => 'Buttons',
    'cards'       => 'Cards',
    'dropdowns'   => 'Dropdowns',
    'empty-states'=> 'Empty States',
    'icons'       => 'Icons',
    'inputs'      => 'Inputs',
    'modals'      => 'Modals',
    'page-headers'=> 'Page Headers',
    'paginations' => 'Paginations',
    'tables'      => 'Tables',
    'tabs'        => 'Tabs',
    'toasts'      => 'Toasts',
    'typography'  => 'Typography',
    'uploads'     => 'Uploads',
  ];

  $children = [];
  foreach ($items as $slug => $label) {
    $children[] = [
      'label'  => $label,
      'href'   => asset('/' . $slug),
      'active' => $slug === $active_page,
    ];
  }

  return $children;
}

function ui_patterns_sidebar_children(string $active_page = ''): array
{
  $items = [
    'crm-pipeline' => 'CRM Pipeline',
    'forms'        => 'Form',
  ];

  $children = [];
  foreach ($items as $slug => $label) {
    $children[] = [
      'label'  => $label,
      'href'   => asset('/' . $slug),
      'active' => $slug === $active_page,
    ];
  }

  return $children;
}

function users_sidebar_children(string $active_page = ''): array
{
  $items = [
    'users'        => 'Browse All Users',
    'users-create' => 'Create New User',
  ];

  $children = [];
  foreach ($items as $slug => $label) {
    $path = $slug === 'users-create' ? '/users/create' : '/users';

    $children[] = [
      'label'  => $label,
      'href'   => asset($path),
      'active' => $slug === $active_page,
    ];
  }

  return $children;
}

function people_sidebar_children(string $active_page = ''): array
{
  $items = [
    'people'                    => ['label' => 'People Overview', 'path' => '/people'],
    'people-team-members'       => ['label' => 'Team Members', 'path' => '/people/team-members'],
    'people-roles-permissions'  => ['label' => 'Roles & Permissions', 'path' => '/people/roles-permissions'],
    'people-invite'             => ['label' => 'Invite Member', 'path' => '/people/invite'],
  ];

  $children = [];
  foreach ($items as $slug => $item) {
    $children[] = [
      'label'  => $item['label'],
      'href'   => asset($item['path']),
      'active' => $slug === $active_page,
    ];
  }

  return $children;
}

function products_sidebar_children(string $active_page = ''): array
{
  $items = [
    'products'    => ['label' => 'All Products', 'path' => '/products'],
    'product-add' => ['label' => 'Add Product', 'path' => '/product-add'],
  ];

  $children = [];
  foreach ($items as $slug => $item) {
    $children[] = [
      'label'  => $item['label'],
      'href'   => asset($item['path']),
      'active' => $slug === $active_page,
    ];
  }

  return $children;
}

function build_booking_table_dataset(array $orders): array
{
  $headers = [
    'Booking',
    'Customer',
    [
      'label' => 'Payment',
      'align' => 'right',
    ],
    [
      'label' => 'Status',
      'align' => 'right',
    ],
    [
      'label' => 'Action',
      'align' => 'right',
    ],
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

    $studio_name    = isset($order['studio']) ? (string) $order['studio'] : '-';
    $studio_initial = strtoupper(substr($studio_name !== '' ? $studio_name : 'S', 0, 1));

    $booking_html = '
      <div class="table__media-cell">
        <div class="table__image"></div>
        <div class="table__stack">
          <p class="table__primary">' . e($studio_name) . '</p>
          <p class="table__secondary">' . e((string) ($order['code'] ?? '-')) . '</p>
          <p class="table__tertiary">' . e(trim($created_date . ($created_time !== '' ? ', ' . $created_time : ''))) . '</p>
        </div>
      </div>
    ';

    $customer_html = '
      <div class="table__media-cell">
        <div class="table__avatar">' . e($studio_initial) . '</div>
        <div class="table__stack">
          <p class="table__primary">' . e((string) ($order['customer_name'] ?? '-')) . '</p>
          <p class="table__secondary">' . e($customer_phone !== '' ? $customer_phone : '-') . '</p>
          <p class="table__tertiary">Session: ' . e($session_brief) . '</p>
        </div>
      </div>
    ';

    ob_start();
    component('badge', [
      'label' => $payment_label,
      'mode'  => $payment_mode,
    ]);
    $payment_badge = (string) ob_get_clean();

    ob_start();
    component('badge', [
      'label' => $status_label,
      'mode'  => $status_mode,
    ]);
    $status_badge = (string) ob_get_clean();

    $payment_html = '
      <div class="table__badge-cell">
        ' . $payment_badge . '
      </div>
    ';

    $status_html = '
      <div class="table__badge-cell">
        ' . $status_badge . '
      </div>
    ';

    ob_start();
    component('button', [
      'label'   => 'Manage',
      'variant' => 'neutral',
      'size'    => 'sm',
      'href'    => isset($order['manage_url']) ? (string) $order['manage_url'] : '#',
    ]);
    $manage_button = (string) ob_get_clean();

    ob_start();
    component('dropdown', [
      'trigger_label'   => 'More',
      'trigger_variant' => 'ghost',
      'trigger_size'    => 'sm',
      'align'           => 'right',
      'items'           => [
        [
          'label' => 'View',
          'href'  => isset($order['manage_url']) ? (string) $order['manage_url'] : '#',
        ],
        [
          'label' => 'Duplicate',
          'href'  => '#',
        ],
        [
          'type' => 'divider',
        ],
        [
          'label' => 'Cancel booking',
          'href'  => '#',
          'kind'  => 'danger',
        ],
      ],
    ]);
    $row_dropdown = (string) ob_get_clean();

    $action_html = '
      <div class="table__actions">
        ' . $manage_button . '
        ' . $row_dropdown . '
      </div>
    ';

    $rows[] = [
      'cells' => [
        ['html' => $booking_html],
        ['html' => $customer_html],
        ['html' => $payment_html, 'align' => 'right'],
        ['html' => $status_html, 'align' => 'right'],
        ['html' => $action_html, 'align' => 'right'],
      ],
    ];
  }

  return [
    'headers' => $headers,
    'rows'    => $rows,
    'total'   => count($orders),
  ];
}
