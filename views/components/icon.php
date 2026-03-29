<?php

$icon_name = isset($icon_name) ? (string) $icon_name : 'plus';
$icon_size = isset($icon_size) ? (int) $icon_size : 24;

$icon_map = [
  'plus'    => 'plus',
  'users'   => 'users',
  'pulse'   => 'activity',
  'activity'=> 'activity',
  'tickets' => 'ticket',
  'ticket'  => 'ticket',
  'star'    => 'star',
];

$supported_sizes = [16, 24, 32, 64];
$size            = in_array($icon_size, $supported_sizes, true) ? $icon_size : 24;
$icon_file       = isset($icon_map[$icon_name]) ? $icon_map[$icon_name] : 'plus';

$icon_path = __DIR__ . '/../../assets/icons/lucide/' . $icon_file . '.svg';
$svg_inner = '';

if (is_file($icon_path)) {
  $svg_markup = (string) file_get_contents($icon_path);
  $svg_markup = preg_replace('/^\s*<svg[^>]*>\s*/', '', $svg_markup);
  $svg_markup = preg_replace('/\s*<\/svg>\s*$/', '', (string) $svg_markup);
  $svg_inner  = (string) $svg_markup;
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
