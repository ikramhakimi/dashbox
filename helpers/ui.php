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
    'badges'      => 'Badges',
    'buttons'     => 'Buttons',
    'breadcrumbs' => 'Breadcrumbs',
    'cards'       => 'Cards',
    'inputs'      => 'Inputs',
    'modals'      => 'Modals',
    'tabs'        => 'Tabs',
    'toasts'      => 'Toasts',
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
    'forms' => 'Form',
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
