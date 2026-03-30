<?php

$id          = isset($id) && $id !== '' ? (string) $id : 'search-' . uniqid();
$name        = isset($name) && $name !== '' ? (string) $name : $id;
$label       = isset($label) ? (string) $label : 'Search';
$value       = isset($value) ? (string) $value : '';
$placeholder = isset($placeholder) ? (string) $placeholder : 'Search';
$icon_name   = isset($icon_name) && $icon_name !== '' ? (string) $icon_name : 'magnifying-glass';
$help_text   = isset($help_text) ? (string) $help_text : '';
$error_text  = isset($error_text) ? (string) $error_text : '';
$disabled    = !empty($disabled);

component('input-group', [
  'id'          => $id,
  'name'        => $name,
  'label'       => $label,
  'type'        => 'search',
  'value'       => $value,
  'placeholder' => $placeholder,
  'icon_name'   => $icon_name,
  'icon_side'   => 'left',
  'help_text'   => $help_text,
  'error_text'  => $error_text,
  'disabled'    => $disabled,
  'class'       => $component_class,
]);
