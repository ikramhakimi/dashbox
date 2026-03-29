<?php

$id            = isset($id) && $id !== '' ? (string) $id : 'search-' . uniqid();
$name          = isset($name) && $name !== '' ? (string) $name : $id;
$label         = isset($label) ? (string) $label : 'Search';
$value         = isset($value) ? (string) $value : '';
$placeholder   = isset($placeholder) ? (string) $placeholder : 'Search';
$help_text     = isset($help_text) ? (string) $help_text : '';
$error_text    = isset($error_text) ? (string) $error_text : '';
$disabled      = !empty($disabled);
?>
<div class="<?= e($component_class) ?>">
  <div class="search__icon" aria-hidden="true">
    <?php component('icon', ['icon_name' => 'activity', 'icon_size' => 16]); ?>
  </div>
  <?php
  component('input', [
    'id'          => $id,
    'name'        => $name,
    'label'       => $label,
    'type'        => 'search',
    'value'       => $value,
    'placeholder' => $placeholder,
    'help_text'   => $help_text,
    'error_text'  => $error_text,
    'disabled'    => $disabled,
    'class'       => 'search__input',
  ]);
  ?>
</div>
