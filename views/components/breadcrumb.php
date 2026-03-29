<?php

$items      = isset($items) && is_array($items) ? $items : [];
$separator  = isset($separator) ? (string) $separator : 'slash';
$compact    = !empty($compact);
$attributes = isset($attributes) && is_array($attributes) ? $attributes : [];

if ($items === []) {
  $items = [
    [
      'label' => 'Home',
      'href'  => asset('/'),
    ],
  ];
}

$separator = in_array($separator, ['slash', 'chevron'], true) ? $separator : 'slash';
$root_class = trim($component_class . ($compact ? ' breadcrumb--compact' : ''));

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

$render_icon = static function (string $icon_name): string {
  ob_start();
  component('icon', [
    'icon_name' => $icon_name,
    'icon_size' => 16,
  ]);
  return (string) ob_get_clean();
};

$nav_attributes                 = $attributes;
$nav_attributes['class']        = trim($root_class . ' ' . (($attributes['class'] ?? '')));
$nav_attributes['aria-label']   = isset($attributes['aria-label']) ? (string) $attributes['aria-label'] : 'Breadcrumb';
?>
<nav<?= $render_attributes($nav_attributes) ?>>
  <ol class="breadcrumb__list">
    <?php foreach ($items as $index => $item): ?>
      <?php
      $item_label = isset($item['label']) ? (string) $item['label'] : 'Untitled';
      $item_href  = isset($item['href']) ? (string) $item['href'] : '';
      $item_icon  = isset($item['icon_name']) ? (string) $item['icon_name'] : '';
      $is_last    = $index === array_key_last($items);
      $is_current = !empty($item['current']) || $is_last;
      ?>
      <li class="breadcrumb__item">
        <?php if (!$is_current && $item_href !== ''): ?>
          <a href="<?= e($item_href) ?>" class="breadcrumb__link">
            <?php if ($item_icon !== ''): ?>
              <span class="breadcrumb__icon" aria-hidden="true"><?= $render_icon($item_icon) ?></span>
            <?php endif; ?>
            <span><?= e($item_label) ?></span>
          </a>
        <?php else: ?>
          <span class="breadcrumb__current" aria-current="page">
            <?php if ($item_icon !== ''): ?>
              <span class="breadcrumb__icon" aria-hidden="true"><?= $render_icon($item_icon) ?></span>
            <?php endif; ?>
            <span><?= e($item_label) ?></span>
          </span>
        <?php endif; ?>
      </li>

      <?php if (!$is_last): ?>
        <li class="breadcrumb__separator" aria-hidden="true">
          <?php if ($separator === 'chevron'): ?>
            <svg viewBox="0 0 16 16" fill="none">
              <path d="M6 3.5L10.5 8L6 12.5" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"></path>
            </svg>
          <?php else: ?>
            /
          <?php endif; ?>
        </li>
      <?php endif; ?>
    <?php endforeach; ?>
  </ol>
</nav>
