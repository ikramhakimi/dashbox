<?php

$id            = isset($id) && $id !== '' ? (string) $id : 'input-' . uniqid();
$name          = isset($name) && $name !== '' ? (string) $name : $id;
$label         = isset($label) ? (string) $label : '';
$type          = isset($type) && $type !== '' ? (string) $type : 'text';
$size          = isset($size) && $size !== '' ? (string) $size : 'md';
$value         = isset($value) ? (string) $value : '';
$placeholder   = isset($placeholder) ? (string) $placeholder : '';
$help_text     = isset($help_text) ? (string) $help_text : '';
$error_text    = isset($error_text) ? (string) $error_text : '';
$autocomplete  = isset($autocomplete) ? (string) $autocomplete : '';
$inputmode     = isset($inputmode) ? (string) $inputmode : '';
$class         = isset($class) ? (string) $class : '';
$required      = !empty($required);
$disabled      = !empty($disabled);
$readonly      = !empty($readonly);
$attributes    = isset($attributes) && is_array($attributes) ? $attributes : [];

$size_classes = [
  'default' => '',
  'md'      => '',
  'lg'      => 'input--lg',
];

$size_class = isset($size_classes[$size]) ? $size_classes[$size] : $size_classes['md'];
$root_class = trim($component_class . ' ' . $size_class . ' ' . $class);

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

$input_attributes                   = $attributes;
$input_attributes['id']             = $id;
$input_attributes['name']           = $name;
$input_attributes['type']           = $type;
$input_attributes['class']          = $input_control_class;
$input_attributes['value']          = $value;
$input_attributes['placeholder']    = $placeholder;
$input_attributes['required']       = $required;
$input_attributes['disabled']       = $disabled;
$input_attributes['readonly']       = $readonly;
$input_attributes['aria-invalid']   = $error_text !== '' ? 'true' : null;
$input_attributes['aria-describedby'] = $described_by !== [] ? implode(' ', $described_by) : null;

if ($autocomplete !== '') {
  $input_attributes['autocomplete'] = $autocomplete;
}

if ($inputmode !== '') {
  $input_attributes['inputmode'] = $inputmode;
}
?>
<div class="<?= e($root_class) ?>">
  <?php if ($label !== ''): ?>
    <label class="input__label" for="<?= e($id) ?>">
      <?= e($label) ?>
      <?php if ($required): ?>
        <span class="input__required" aria-hidden="true">*</span>
      <?php endif; ?>
    </label>
  <?php endif; ?>

  <input<?= $render_attributes($input_attributes) ?>>

  <?php if ($help_text !== ''): ?>
    <p id="<?= e($id) ?>-help" class="input__help"><?= e($help_text) ?></p>
  <?php endif; ?>

  <?php if ($error_text !== ''): ?>
    <p id="<?= e($id) ?>-error" class="input__error"><?= e($error_text) ?></p>
  <?php endif; ?>
</div>
