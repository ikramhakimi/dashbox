<?php

$name       = isset($name) ? trim((string) $name) : '';
$src        = isset($src) ? trim((string) $src) : '';
$alt        = isset($alt) ? trim((string) $alt) : ($name !== '' ? $name : 'Avatar');
$size       = isset($size) ? (string) $size : 'md';
$fallback_text = isset($fallback_text) ? trim((string) $fallback_text) : '';
$tone_class = isset($tone_class) ? trim((string) $tone_class) : '';
$class      = isset($class) ? (string) $class : '';
$attributes = isset($attributes) && is_array($attributes) ? $attributes : [];

$size_class_map = [
  'sm' => 'avatar--sm',
  'md' => '',
  'lg' => 'avatar--lg',
];
$size_class = isset($size_class_map[$size]) ? $size_class_map[$size] : '';

$take_chars = static function (string $text, int $length): string {
  if ($text === '' || $length <= 0) {
    return '';
  }

  if (function_exists('mb_substr')) {
    return (string) mb_substr($text, 0, $length, 'UTF-8');
  }

  $char_count = preg_match_all('/./u', $text, $matches);
  if (is_int($char_count) && $char_count > 0) {
    return implode('', array_slice((array) ($matches[0] ?? []), 0, $length));
  }

  return substr($text, 0, $length);
};

$initials = 'UX';
if ($fallback_text !== '') {
  $initials = strtoupper($take_chars($fallback_text, 2));
} elseif ($name !== '') {
  $words = array_values(array_filter((array) preg_split('/\s+/', $name)));
  $first_word = (string) ($words[0] ?? '');
  $second_word = (string) ($words[1] ?? '');

  if ($first_word !== '' && $second_word !== '') {
    $initials = strtoupper($take_chars($first_word, 1) . $take_chars($second_word, 1));
  } elseif ($first_word !== '') {
    $initials = strtoupper($take_chars($first_word, 2));
  }
}

if ((function_exists('mb_strlen') && mb_strlen($initials, 'UTF-8') === 1) || (!function_exists('mb_strlen') && strlen($initials) === 1)) {
  $initials .= 'X';
}

$seed = strtolower($name !== '' ? $name : ($fallback_text !== '' ? $fallback_text : $initials));
$hash = 0;
$seed_length = strlen($seed);
for ($index = 0; $index < $seed_length; $index++) {
  $hash = (($hash << 5) - $hash) + ord($seed[$index]);
  $hash &= 0x7FFFFFFF;
}

$tone_classes = [
  'avatar__initials--tone-sky',
  'avatar__initials--tone-emerald',
  'avatar__initials--tone-amber',
  'avatar__initials--tone-rose',
  'avatar__initials--tone-violet',
  'avatar__initials--tone-cyan',
  'avatar__initials--tone-orange',
  'avatar__initials--tone-lime',
];
$initials_tone_class = $tone_class !== '' ? $tone_class : $tone_classes[$hash % count($tone_classes)];

$render_attributes = static function (array $attrs): string {
  $compiled = [];

  foreach ($attrs as $key => $value) {
    if (!is_string($key) || $key === '') {
      continue;
    }

    if (is_bool($value)) {
      if ($value) {
        $compiled[] = $key;
      }
      continue;
    }

    if ($value === null) {
      continue;
    }

    $compiled[] = $key . '="' . e((string) $value) . '"';
  }

  return $compiled === [] ? '' : ' ' . implode(' ', $compiled);
};

$root_classes = trim($component_class . ' ' . $size_class . ' ' . $class);
$root_attrs = $attributes;
$root_attrs['class'] = trim($root_classes . ' ' . (string) ($attributes['class'] ?? ''));
?>
<span<?= $render_attributes($root_attrs) ?>>
  <?php if ($src !== ''): ?>
    <img src="<?= e($src) ?>" alt="<?= e($alt) ?>" class="avatar__image" loading="lazy">
  <?php else: ?>
    <span class="avatar__initials <?= e($initials_tone_class) ?>" aria-label="<?= e($alt) ?>"><?= e($initials) ?></span>
  <?php endif; ?>
</span>
