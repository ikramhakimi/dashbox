<?php

$id         = isset($id) && $id !== '' ? (string) $id : 'checkbox-' . uniqid();
$name       = isset($name) && $name !== '' ? (string) $name : $id;
$label      = isset($label) ? (string) $label : 'Checkbox';
$value      = isset($value) ? (string) $value : '1';
$help_text  = isset($help_text) ? (string) $help_text : '';
$error_text = isset($error_text) ? (string) $error_text : '';
$checked    = !empty($checked);
$disabled   = !empty($disabled);
$required   = !empty($required);
$attributes = isset($attributes) && is_array($attributes) ? $attributes : [];

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

$input_attributes                     = $attributes;
$input_attributes['id']               = $id;
$input_attributes['name']             = $name;
$input_attributes['type']             = 'checkbox';
$input_attributes['class']            = 'checkbox__native';
$input_attributes['value']            = $value;
$input_attributes['checked']          = $checked;
$input_attributes['disabled']         = $disabled;
$input_attributes['required']         = $required;
$input_attributes['aria-invalid']     = $error_text !== '' ? 'true' : null;
$input_attributes['aria-describedby'] = $described_by !== [] ? implode(' ', $described_by) : null;
?>
<div class="<?= e($component_class) ?>">
  <label class="checkbox__label" for="<?= e($id) ?>">
    <input<?= $render_attributes($input_attributes) ?>>
    <span class="checkbox__box" aria-hidden="true">
      <svg class="checkbox__icon" viewBox="0 0 16 16" fill="none">
        <path d="M3.5 8.5L6.5 11.5L12.5 4.5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
      </svg>
    </span>
    <span class="checkbox__text"><?= e($label) ?></span>
  </label>

  <?php if ($help_text !== ''): ?>
    <p id="<?= e($id) ?>-help" class="checkbox__help"><?= e($help_text) ?></p>
  <?php endif; ?>

  <?php if ($error_text !== ''): ?>
    <p id="<?= e($id) ?>-error" class="checkbox__error"><?= e($error_text) ?></p>
  <?php endif; ?>
</div>
