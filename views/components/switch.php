<?php

$id         = isset($id) && $id !== '' ? (string) $id : 'switch-' . uniqid();
$name       = isset($name) && $name !== '' ? (string) $name : $id;
$label      = isset($label) ? (string) $label : 'Switch';
$value      = isset($value) ? (string) $value : '1';
$checked    = !empty($checked);
$disabled   = !empty($disabled);
$help_text  = isset($help_text) ? (string) $help_text : '';
$attributes = isset($attributes) && is_array($attributes) ? $attributes : [];

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

$input_attributes            = $attributes;
$input_attributes['id']      = $id;
$input_attributes['name']    = $name;
$input_attributes['type']    = 'checkbox';
$input_attributes['class']   = 'switch__control';
$input_attributes['role']    = 'switch';
$input_attributes['value']   = $value;
$input_attributes['checked'] = $checked;
$input_attributes['disabled']= $disabled;
?>
<div class="<?= e($component_class) ?>">
  <label class="switch__label" for="<?= e($id) ?>">
    <span class="switch__track">
      <input<?= $render_attributes($input_attributes) ?>>
      <span class="switch__thumb" aria-hidden="true"></span>
    </span>
    <span class="switch__text"><?= e($label) ?></span>
  </label>
  <?php if ($help_text !== ''): ?>
    <p class="switch__help"><?= e($help_text) ?></p>
  <?php endif; ?>
</div>
