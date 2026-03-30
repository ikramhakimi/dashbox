<?php

$id            = isset($id) && $id !== '' ? (string) $id : 'select-' . uniqid();
$name          = isset($name) && $name !== '' ? (string) $name : $id;
$label         = isset($label) ? (string) $label : '';
$size          = isset($size) && $size !== '' ? (string) $size : 'md';
$options       = isset($options) && is_array($options) ? $options : [];
$value         = isset($value) ? (string) $value : '';
$help_text     = isset($help_text) ? (string) $help_text : '';
$error_text    = isset($error_text) ? (string) $error_text : '';
$class         = isset($class) ? (string) $class : '';
$required      = !empty($required);
$disabled      = !empty($disabled);
$multiple      = !empty($multiple);
$attributes    = isset($attributes) && is_array($attributes) ? $attributes : [];

$size_classes = [
  'default' => '',
  'md'      => '',
  'lg'      => 'select--lg',
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

$select_control_class = 'select__control' . ($error_text !== '' ? ' select__control--invalid' : '');
if (isset($attributes['class']) && is_string($attributes['class']) && trim($attributes['class']) !== '') {
  $select_control_class .= ' ' . trim($attributes['class']);
}

$select_attributes                     = $attributes;
$select_attributes['id']               = $id;
$select_attributes['name']             = $name;
$select_attributes['class']            = $select_control_class;
$select_attributes['required']         = $required;
$select_attributes['disabled']         = $disabled;
$select_attributes['multiple']         = $multiple;
$select_attributes['aria-invalid']     = $error_text !== '' ? 'true' : null;
$select_attributes['aria-describedby'] = $described_by !== [] ? implode(' ', $described_by) : null;
?>
<div class="<?= e($root_class) ?>">
  <?php if ($label !== ''): ?>
    <label class="select__label" for="<?= e($id) ?>">
      <?= e($label) ?>
      <?php if ($required): ?>
        <span class="select__required" aria-hidden="true">*</span>
      <?php endif; ?>
    </label>
  <?php endif; ?>

  <div class="select__wrapper">
    <select<?= $render_attributes($select_attributes) ?>>
      <?php foreach ($options as $option): ?>
        <?php
        $option_label    = isset($option['label']) ? (string) $option['label'] : '';
        $option_value    = isset($option['value']) ? (string) $option['value'] : $option_label;
        $option_disabled = !empty($option['disabled']);
        $is_selected     = $option_value === $value;
        ?>
        <option value="<?= e($option_value) ?>" <?= $is_selected ? 'selected' : '' ?> <?= $option_disabled ? 'disabled' : '' ?>>
          <?= e($option_label) ?>
        </option>
      <?php endforeach; ?>
    </select>
    <?php if (!$multiple): ?>
      <span class="select__icon" aria-hidden="true">
        <svg viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M5 7L10 12L15 7" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
        </svg>
      </span>
    <?php endif; ?>
  </div>

  <?php if ($help_text !== ''): ?>
    <p id="<?= e($id) ?>-help" class="select__help"><?= e($help_text) ?></p>
  <?php endif; ?>

  <?php if ($error_text !== ''): ?>
    <p id="<?= e($id) ?>-error" class="select__error"><?= e($error_text) ?></p>
  <?php endif; ?>
</div>
