<?php

$trigger_label     = isset($trigger_label) ? (string) $trigger_label : 'Actions';
$trigger_variant   = isset($trigger_variant) ? (string) $trigger_variant : 'neutral';
$trigger_size      = isset($trigger_size) ? (string) $trigger_size : 'md';
$trigger_icon_name = isset($trigger_icon_name) ? (string) $trigger_icon_name : '';
$trigger_tag       = isset($trigger_tag) ? (string) $trigger_tag : 'button';
$trigger_href      = isset($trigger_href) ? (string) $trigger_href : '#';
$prevent_navigation = isset($prevent_navigation) ? (bool) $prevent_navigation : true;
$icon_only         = !empty($icon_only);
$align             = isset($align) ? (string) $align : 'right';
$items             = isset($items) && is_array($items) ? $items : [];
$open              = !empty($open);
$dropdown_id       = isset($dropdown_id) && $dropdown_id !== '' ? (string) $dropdown_id : 'dropdown-' . uniqid();
$panel_id          = $dropdown_id . '-panel';
$attributes        = isset($attributes) && is_array($attributes) ? $attributes : [];

if ($items === []) {
  $items = [
    [
      'label' => 'View',
      'href'  => '#',
    ],
    [
      'label' => 'Edit',
      'href'  => '#',
    ],
    [
      'type' => 'divider',
    ],
    [
      'label' => 'Delete',
      'href'  => '#',
      'kind'  => 'danger',
    ],
  ];
}

$root_classes = [$component_class];
$root_classes[] = $align === 'left' ? 'dropdown--left' : 'dropdown--right';
if ($open) {
  $root_classes[] = 'dropdown--open';
}

$allowed_trigger_variants = ['primary', 'neutral', 'ghost', 'danger'];
if (!in_array($trigger_variant, $allowed_trigger_variants, true)) {
  $trigger_variant = 'neutral';
}

$allowed_trigger_sizes = ['sm', 'md', 'default', 'lg'];
if (!in_array($trigger_size, $allowed_trigger_sizes, true)) {
  $trigger_size = 'md';
}

$allowed_trigger_tags = ['button', 'a'];
if (!in_array($trigger_tag, $allowed_trigger_tags, true)) {
  $trigger_tag = 'button';
}

$is_link_trigger = $trigger_tag === 'a';

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

$root_attributes = $attributes;
$root_attributes['class'] = trim(implode(' ', $root_classes) . ' ' . (($attributes['class'] ?? '')));
$root_attributes['data-dropdown'] = 'true';
$root_attributes['id'] = $dropdown_id;

$render_trigger_icon = static function (string $icon_name): string {
  if ($icon_name === '') {
    return '';
  }

  ob_start();
  component('icon', [
    'icon_name' => $icon_name,
    'icon_size' => 16,
  ]);
  return (string) ob_get_clean();
};

$trigger_classes = [
  'dropdown__trigger',
];

if ($is_link_trigger) {
  $trigger_classes[] = 'dropdown__trigger--link';
} else {
  $trigger_classes[] = 'button';
  $trigger_classes[] = 'button--' . $trigger_variant;

  if ($trigger_size === 'sm') {
    $trigger_classes[] = 'button--sm';
  } elseif ($trigger_size === 'lg') {
    $trigger_classes[] = 'button--lg';
  }

  if ($icon_only) {
    $trigger_classes[] = 'button--icon-only';
  }
}

$trigger_attributes = [
  'class'          => implode(' ', $trigger_classes),
  'data-dropdown-trigger' => true,
  'aria-haspopup'  => 'menu',
  'aria-expanded'  => $open ? 'true' : 'false',
  'aria-controls'  => $panel_id,
  'aria-label'     => $icon_only ? $trigger_label : 'Open dropdown menu',
];

if ($trigger_tag === 'button') {
  $trigger_attributes['type'] = 'button';
} else {
  $trigger_attributes['href'] = $trigger_href;
  $trigger_attributes['data-dropdown-prevent-nav'] = $prevent_navigation ? 'true' : 'false';
}
?>
<div<?= $render_attributes($root_attributes) ?>>
  <<?= e($trigger_tag) ?><?= $render_attributes($trigger_attributes) ?>>
    <?php if ($trigger_icon_name !== ''): ?>
      <span class="<?= e($is_link_trigger ? 'dropdown__trigger-icon' : 'button__icon') ?>" aria-hidden="true"><?= $render_trigger_icon($trigger_icon_name) ?></span>
    <?php endif; ?>

    <?php if (!$icon_only): ?>
      <span class="<?= e($is_link_trigger ? 'dropdown__trigger-label' : 'button__label') ?>"><?= e($trigger_label) ?></span>
      <svg class="dropdown__caret" viewBox="0 0 20 20" fill="none" aria-hidden="true">
        <path d="M5 7L10 12L15 7" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
      </svg>
    <?php endif; ?>
  </<?= e($trigger_tag) ?>>

  <div id="<?= e($panel_id) ?>" class="dropdown__panel<?= !$open ? ' hidden' : '' ?>" role="menu" data-dropdown-panel>
    <?php foreach ($items as $item): ?>
      <?php
      $item_type = isset($item['type']) ? (string) $item['type'] : 'item';
      if ($item_type === 'divider') {
        echo '<div class="dropdown__divider" role="separator"></div>';
        continue;
      }
      if ($item_type === 'label') {
        $item_label = isset($item['label']) ? (string) $item['label'] : 'Section';
        echo '<p class="dropdown__label">' . e($item_label) . '</p>';
        continue;
      }

      $item_label = isset($item['label']) ? (string) $item['label'] : 'Item';
      $item_href  = isset($item['href']) ? (string) $item['href'] : '#';
      $item_kind  = isset($item['kind']) ? (string) $item['kind'] : 'default';
      $item_icon  = isset($item['icon_name']) ? (string) $item['icon_name'] : '';
      $disabled   = !empty($item['disabled']);

      $item_classes = ['dropdown__item'];
      if ($item_kind === 'danger') {
        $item_classes[] = 'dropdown__item--danger';
      }
      if ($disabled) {
        $item_classes[] = 'dropdown__item--disabled';
      }
      ?>
      <a
        href="<?= e($disabled ? '#' : $item_href) ?>"
        class="<?= e(implode(' ', $item_classes)) ?>"
        role="menuitem"
        <?= $disabled ? 'aria-disabled="true" tabindex="-1"' : '' ?>
      >
        <?php if ($item_icon !== ''): ?>
          <span class="dropdown__item-icon" aria-hidden="true"><?= $render_trigger_icon($item_icon) ?></span>
        <?php endif; ?>
        <span><?= e($item_label) ?></span>
      </a>
    <?php endforeach; ?>
  </div>
</div>
