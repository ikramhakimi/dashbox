<?php

$icon_name  = isset($icon_name) ? strtolower(trim((string) $icon_name)) : 'plus';
$icon_size  = isset($icon_size) ? (int) $icon_size : 24;
$icon_style = isset($icon_style) ? strtolower(trim((string) $icon_style)) : 'outline';
$icon_set   = isset($icon_set) ? strtolower(trim((string) $icon_set)) : 'lucide';

$icon_aliases = [
  // Backward compatibility for older heroicon-style names.
  'arrow-up-tray'   => 'upload',
  'currency-dollar' => 'circle-dollar-sign',
  'magnifying-glass'=> 'search',
  'pulse'           => 'activity',
  'tickets'         => 'ticket',
];

$supported_sizes = [16, 20, 24, 32, 64];
$size            = in_array($icon_size, $supported_sizes, true) ? $icon_size : 24;

$supported_sets = ['lucide', 'remix'];
if (!in_array($icon_set, $supported_sets, true)) {
  $icon_set = 'lucide';
}

$resolved_icon = isset($icon_aliases[$icon_name]) ? $icon_aliases[$icon_name] : $icon_name;
$icon_token    = preg_replace('/[^a-z0-9-]+/', '-', $resolved_icon);
$icon_token    = is_string($icon_token) ? trim($icon_token, '-') : '';
$icon_token    = $icon_token !== '' ? $icon_token : 'plus';
$icon_path = '';
$svg_inner = '';
$svg_markup = '';

if ($icon_set === 'remix') {
  $icons_directory = __DIR__ . '/../../node_modules/remixicon/icons';
  $icon_files      = glob($icons_directory . '/*/*.svg');
  $icon_catalog    = [];

  if (is_array($icon_files)) {
    foreach ($icon_files as $icon_file_path) {
      $icon_basename = pathinfo($icon_file_path, PATHINFO_FILENAME);
      if (is_string($icon_basename) && $icon_basename !== '' && !isset($icon_catalog[$icon_basename])) {
        $icon_catalog[$icon_basename] = $icon_file_path;
      }
    }
  }

  if (!isset($icon_catalog[$resolved_icon])) {
    $resolved_icon = isset($icon_catalog['add-line']) ? 'add-line' : (array_key_first($icon_catalog) ?? 'add-line');
  }

  $icon_path = isset($icon_catalog[$resolved_icon]) ? (string) $icon_catalog[$resolved_icon] : '';
} else {
  $icons_directory = __DIR__ . '/../../node_modules/lucide-static/icons';
  $icon_files      = glob($icons_directory . '/*.svg');
  $icon_catalog    = [];

  if (is_array($icon_files)) {
    foreach ($icon_files as $icon_file_path) {
      $icon_basename = pathinfo($icon_file_path, PATHINFO_FILENAME);
      if (is_string($icon_basename) && $icon_basename !== '') {
        $icon_catalog[$icon_basename] = $icon_basename;
      }
    }
  }

  if (!isset($icon_catalog[$resolved_icon])) {
    $resolved_icon = isset($icon_catalog['plus']) ? 'plus' : (array_key_first($icon_catalog) ?? 'plus');
  }

  $icon_path = $icons_directory . '/' . $resolved_icon . '.svg';
}

if (is_file($icon_path)) {
  $svg_markup = (string) file_get_contents($icon_path);

  // Remove comments/license blocks first so <svg> extraction is reliable.
  $svg_markup = preg_replace('/<!--.*?-->/s', '', $svg_markup);
  $svg_markup = is_string($svg_markup) ? $svg_markup : '';

  if (preg_match('/<svg\b[^>]*>(.*?)<\/svg>/is', $svg_markup, $matches) === 1) {
    $svg_inner = (string) ($matches[1] ?? '');
  }
}
?>
<?php if ($icon_set === 'remix'): ?>
  <?php
  $svg_attributes = '';
  if (preg_match('/<svg\b([^>]*)>/is', $svg_markup, $matches) === 1) {
    $svg_attributes = trim((string) ($matches[1] ?? ''));
    $svg_attributes = preg_replace('/\s(width|height|class|aria-hidden)="[^"]*"/i', '', $svg_attributes);
    $svg_attributes = is_string($svg_attributes) ? trim($svg_attributes) : '';
  }
  ?>
  <svg class="<?= e($component_class) ?> icon--<?= e((string) $size) ?> icon--<?= e($icon_token) ?>" aria-hidden="true"<?= $svg_attributes !== '' ? ' ' . $svg_attributes : '' ?>>
    <?= $svg_inner ?>
  </svg>
<?php else: ?>
  <svg
    class="<?= e($component_class) ?> icon--<?= e((string) $size) ?> icon--<?= e($icon_token) ?>"
    viewBox="0 0 24 24"
    fill="none"
    xmlns="http://www.w3.org/2000/svg"
    stroke="currentColor"
    stroke-width="2"
    stroke-linecap="round"
    stroke-linejoin="round"
    aria-hidden="true"
  >
    <?= $svg_inner ?>
  </svg>
<?php endif; ?>
