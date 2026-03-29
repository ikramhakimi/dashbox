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
