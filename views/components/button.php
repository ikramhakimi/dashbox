<?php

$label      = isset($label) ? (string) $label : 'Button';
$type       = isset($type) ? (string) $type : 'button';
$href       = isset($href) ? (string) $href : '';
$variant    = isset($variant) ? (string) $variant : 'neutral';
$size       = isset($size) ? (string) $size : 'md';
$class      = isset($class) ? (string) $class : '';
$id         = isset($id) ? (string) $id : '';
$name       = isset($name) ? (string) $name : '';
$target     = isset($target) ? (string) $target : '';
$rel        = isset($rel) ? (string) $rel : '';
$aria_label = isset($aria_label) ? (string) $aria_label : '';
$icon_name  = isset($icon_name) ? (string) $icon_name : '';
$icon_size  = isset($icon_size) ? (int) $icon_size : 16;
$icon_only  = !empty($icon_only);
$icon_position = isset($icon_position) ? (string) $icon_position : 'left';
$disabled   = !empty($disabled);
$attributes = isset($attributes) && is_array($attributes) ? $attributes : [];

$variant_classes = [
  'primary' => 'button--primary',
  'neutral' => '',
  'danger'  => 'button--danger',
];

$size_classes = [
  'default' => '',
  'md'      => '',
  'sm'      => 'button--sm',
  'lg'      => 'button--lg',
];

$variant_class = isset($variant_classes[$variant]) ? $variant_classes[$variant] : '';
$size_class    = isset($size_classes[$size]) ? $size_classes[$size] : $size_classes['md'];
$icon_only_class = $icon_only ? 'button--icon-only' : '';
$class_name    = trim($component_class . ' ' . $variant_class . ' ' . $size_class . ' ' . $icon_only_class . ' ' . $class);
$is_link       = $href !== '';
$has_icon      = $icon_name !== '';

if ($icon_position !== 'right') {
  $icon_position = 'left';
}

$render_icon = static function () use ($has_icon, $icon_name, $icon_size): string {
  if (!$has_icon) {
    return '';
  }

  ob_start();
  ?>
  <span class="button__icon" aria-hidden="true">
    <?php
    component('icon', [
      'icon_name' => $icon_name,
      'icon_size' => $icon_size,
    ]);
    ?>
  </span>
  <?php
  return (string) ob_get_clean();
};

$button_content = '';
if ($icon_only) {
  $button_content = $render_icon();
} elseif ($has_icon && $icon_position === 'right') {
  $button_content = '<span class="button__label">' . e($label) . '</span>' . $render_icon();
} elseif ($has_icon) {
  $button_content = $render_icon() . '<span class="button__label">' . e($label) . '</span>';
} else {
  $button_content = '<span class="button__label">' . e($label) . '</span>';
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

if ($is_link) {
  $link_attributes            = $attributes;
  $link_attributes['href']    = $disabled ? '#' : $href;
  $link_attributes['class']   = $class_name;

  if ($id !== '') {
    $link_attributes['id'] = $id;
  }

  if ($target !== '') {
    $link_attributes['target'] = $target;
  }

  if ($rel !== '') {
    $link_attributes['rel'] = $rel;
  } elseif ($target === '_blank') {
    $link_attributes['rel'] = 'noopener noreferrer';
  }

  if ($disabled) {
    $link_attributes['aria-disabled'] = 'true';
    $link_attributes['tabindex']      = '-1';
  }

  if ($icon_only) {
    $link_attributes['aria-label'] = $aria_label !== '' ? $aria_label : $label;
  }
  ?>
  <a<?= $render_attributes($link_attributes) ?>><?= $button_content ?></a>
  <?php
  return;
}

$button_attributes          = $attributes;
$button_attributes['type']  = $type;
$button_attributes['class'] = $class_name;

if ($id !== '') {
  $button_attributes['id'] = $id;
}

if ($name !== '') {
  $button_attributes['name'] = $name;
}

if ($disabled) {
  $button_attributes['disabled'] = true;
}

if ($icon_only) {
  $button_attributes['aria-label'] = $aria_label !== '' ? $aria_label : $label;
}
?>
<button<?= $render_attributes($button_attributes) ?>><?= $button_content ?></button>
