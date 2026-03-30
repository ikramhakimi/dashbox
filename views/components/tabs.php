<?php

$items      = isset($items) && is_array($items) ? $items : [];
$size       = isset($size) && $size !== '' ? (string) $size : 'md';
$attributes = isset($attributes) && is_array($attributes) ? $attributes : [];

if ($items === []) {
  $items = [
    [
      'label'  => 'Overview',
      'href'   => '#',
      'active' => true,
    ],
    [
      'label' => 'Details',
      'href'  => '#',
    ],
  ];
}

$root_classes = [$component_class];
if ($size === 'lg') {
  $root_classes[] = 'tabs--lg';
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

$render_icon = static function (string $icon_name): string {
  ob_start();
  component('icon', [
    'icon_name' => $icon_name,
    'icon_size' => 16,
  ]);
  return (string) ob_get_clean();
};

$root_attributes              = $attributes;
$root_attributes['class']     = trim(implode(' ', $root_classes) . ' ' . (($attributes['class'] ?? '')));
$root_attributes['aria-label']= isset($attributes['aria-label']) ? (string) $attributes['aria-label'] : 'Tabs';
?>
<nav<?= $render_attributes($root_attributes) ?>>
  <ul class="tabs__list" role="tablist">
    <?php foreach ($items as $item): ?>
      <?php
      $item_label    = isset($item['label']) ? (string) $item['label'] : 'Tab';
      $item_href     = isset($item['href']) ? (string) $item['href'] : '#';
      $item_icon     = isset($item['icon_name']) ? (string) $item['icon_name'] : '';
      $item_active   = !empty($item['active']);
      $item_disabled = !empty($item['disabled']);

      $tab_classes = ['tabs__tab'];
      if ($item_active) {
        $tab_classes[] = 'tabs__tab--active';
      }
      if ($item_disabled) {
        $tab_classes[] = 'tabs__tab--disabled';
      }
      ?>
      <li class="tabs__item" role="presentation">
        <a
          href="<?= e($item_disabled ? '#' : $item_href) ?>"
          class="<?= e(implode(' ', $tab_classes)) ?>"
          role="tab"
          aria-selected="<?= $item_active ? 'true' : 'false' ?>"
          tabindex="<?= $item_active ? '0' : '-1' ?>"
          <?= $item_disabled ? 'aria-disabled="true"' : '' ?>
        >
          <?php if ($item_icon !== ''): ?>
            <span class="tabs__icon" aria-hidden="true"><?= $render_icon($item_icon) ?></span>
          <?php endif; ?>
          <span><?= e($item_label) ?></span>
        </a>
      </li>
    <?php endforeach; ?>
  </ul>
</nav>
