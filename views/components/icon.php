<?php

$icon_name  = isset($icon_name) ? strtolower(trim((string) $icon_name)) : 'plus';
$icon_size  = isset($icon_size) ? (int) $icon_size : 24;
$icon_style = isset($icon_style) ? strtolower(trim((string) $icon_style)) : 'outline';

$icon_aliases = [
  'activity' => 'signal',
  'pulse'    => 'signal',
  'tickets' => 'ticket',
];

$supported_sizes = [16, 24, 32, 64];
$size            = in_array($icon_size, $supported_sizes, true) ? $icon_size : 24;

$supported_styles = ['outline', 'solid'];
if (!in_array($icon_style, $supported_styles, true)) {
  $icon_style = 'outline';
}

$resolved_icon = isset($icon_aliases[$icon_name]) ? $icon_aliases[$icon_name] : $icon_name;
$icons_directory = __DIR__ . '/../../node_modules/heroicons/24/' . $icon_style;
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
$svg_inner = '';

if (is_file($icon_path)) {
  $svg_markup = (string) file_get_contents($icon_path);

  // Remove comments/license blocks first so <svg> extraction is reliable.
  $svg_markup = preg_replace('/<!--.*?-->/s', '', $svg_markup);
  $svg_markup = is_string($svg_markup) ? $svg_markup : '';

  // Extract only the inner markup of the first <svg>...</svg> block.
  if (preg_match('/<svg\b[^>]*>(.*?)<\/svg>/is', $svg_markup, $matches) === 1) {
    $svg_inner = (string) ($matches[1] ?? '');
  }
}
?>
<svg
  class="<?= e($component_class) ?> icon--<?= e((string) $size) ?>"
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
