<?php

$variant     = isset($variant) ? (string) $variant : 'info';
$title       = isset($title) ? (string) $title : '';
$description = isset($description) ? (string) $description : '';
$show_icon   = isset($show_icon) ? (bool) $show_icon : true;
$dismissible = !empty($dismissible);
$attributes  = isset($attributes) && is_array($attributes) ? $attributes : [];

$supported_variants = ['info', 'success', 'warning', 'danger'];
if (!in_array($variant, $supported_variants, true)) {
  $variant = 'info';
}

$icon_paths = [
  'info'    => 'M8 5.5V5.6M8 7.5V11M8 14A6 6 0 108 2a6 6 0 000 12z',
  'success' => 'M4 8.5L6.8 11.2L12 5.8',
  'warning' => 'M8 4.5V8.5M8 11.2V11.3M7 2.8L1.9 11.5A1.2 1.2 0 003 13.3h10a1.2 1.2 0 001-1.8L9 2.8a1.2 1.2 0 00-2 0z',
  'danger'  => 'M5 5l6 6M11 5l-6 6M8 14A6 6 0 108 2a6 6 0 000 12z',
];

$root_classes = [
  $component_class,
  'toast--' . $variant,
];
if (!$show_icon) {
  $root_classes[] = 'toast--no-icon';
}
if ($dismissible) {
  $root_classes[] = 'toast--dismissible';
}

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

$root_attributes               = $attributes;
$root_attributes['class']      = trim(implode(' ', $root_classes) . ' ' . (($attributes['class'] ?? '')));
$root_attributes['role']       = isset($attributes['role']) ? (string) $attributes['role'] : 'status';
$root_attributes['data-toast'] = 'true';
?>
<div<?= $render_attributes($root_attributes) ?>>
  <?php if ($show_icon): ?>
    <span class="toast__icon" aria-hidden="true">
      <svg viewBox="0 0 16 16" fill="none">
        <path d="<?= e($icon_paths[$variant]) ?>" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"></path>
      </svg>
    </span>
  <?php endif; ?>

  <div class="toast__content">
    <?php if ($title !== ''): ?>
      <p class="toast__title"><?= e($title) ?></p>
    <?php endif; ?>
    <?php if ($description !== ''): ?>
      <p class="toast__description"><?= e($description) ?></p>
    <?php endif; ?>
  </div>

  <?php if ($dismissible): ?>
    <button
      type="button"
      class="toast__dismiss"
      aria-label="Dismiss toast"
      onclick="this.closest('[data-toast]').remove();"
    >
      <svg viewBox="0 0 16 16" fill="none" aria-hidden="true">
        <path d="M5 5L11 11M11 5L5 11" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"></path>
      </svg>
    </button>
  <?php endif; ?>
</div>
