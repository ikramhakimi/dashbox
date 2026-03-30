<?php

$id           = isset($id) && $id !== '' ? (string) $id : 'input-group-' . uniqid();
$name         = isset($name) && $name !== '' ? (string) $name : $id;
$label        = isset($label) ? (string) $label : '';
$type         = isset($type) && $type !== '' ? (string) $type : 'text';
$value        = isset($value) ? (string) $value : '';
$placeholder  = isset($placeholder) ? (string) $placeholder : '';
$icon_name    = isset($icon_name) && $icon_name !== '' ? (string) $icon_name : 'magnifying-glass';
$icon_size    = isset($icon_size) ? (int) $icon_size : 16;
$icon_side    = isset($icon_side) && $icon_side !== '' ? (string) $icon_side : 'left';
$help_text    = isset($help_text) ? (string) $help_text : '';
$error_text   = isset($error_text) ? (string) $error_text : '';
$autocomplete = isset($autocomplete) ? (string) $autocomplete : '';
$inputmode    = isset($inputmode) ? (string) $inputmode : '';
$class        = isset($class) ? (string) $class : '';
$required     = !empty($required);
$disabled     = !empty($disabled);
$readonly     = !empty($readonly);
$attributes   = isset($attributes) && is_array($attributes) ? $attributes : [];

$allowed_icon_sides = ['left', 'right'];
if (!in_array($icon_side, $allowed_icon_sides, true)) {
  $icon_side = 'left';
}

$root_classes = [
  'input-group',
  $component_class,
  'input-group--icon-' . $icon_side,
];

if ($class !== '') {
  $root_classes[] = $class;
}

$described_by = [];
if ($help_text !== '') {
  $described_by[] = $id . '-help';
}
if ($error_text !== '') {
  $described_by[] = $id . '-error';
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

$input_control_class = 'input__control' . ($error_text !== '' ? ' input__control--invalid' : '');
if (isset($attributes['class']) && is_string($attributes['class']) && trim($attributes['class']) !== '') {
  $input_control_class .= ' ' . trim($attributes['class']);
}

$input_attributes                     = $attributes;
$input_attributes['id']               = $id;
$input_attributes['name']             = $name;
$input_attributes['type']             = $type;
$input_attributes['class']            = $input_control_class;
$input_attributes['value']            = $value;
$input_attributes['placeholder']      = $placeholder;
$input_attributes['required']         = $required;
$input_attributes['disabled']         = $disabled;
$input_attributes['readonly']         = $readonly;
$input_attributes['aria-invalid']     = $error_text !== '' ? 'true' : null;
$input_attributes['aria-describedby'] = $described_by !== [] ? implode(' ', $described_by) : null;

if ($autocomplete !== '') {
  $input_attributes['autocomplete'] = $autocomplete;
}

if ($inputmode !== '') {
  $input_attributes['inputmode'] = $inputmode;
}
?>
<div class="<?= e(trim(implode(' ', $root_classes))) ?>">
  <?php if ($label !== ''): ?>
    <label class="input-group__label" for="<?= e($id) ?>">
      <?= e($label) ?>
      <?php if ($required): ?>
        <span class="input-group__required" aria-hidden="true">*</span>
      <?php endif; ?>
    </label>
  <?php endif; ?>

  <div class="input-group__field">
    <span class="input-group__icon" aria-hidden="true">
      <?php
      component('icon', [
        'icon_name' => $icon_name,
        'icon_size' => $icon_size,
      ]);
      ?>
    </span>
    <input<?= $render_attributes($input_attributes) ?>>
  </div>

  <?php if ($help_text !== ''): ?>
    <p id="<?= e($id) ?>-help" class="input-group__help"><?= e($help_text) ?></p>
  <?php endif; ?>

  <?php if ($error_text !== ''): ?>
    <p id="<?= e($id) ?>-error" class="input-group__error"><?= e($error_text) ?></p>
  <?php endif; ?>
</div>
