<?php

$badge_label = isset($label) ? (string) $label : (isset($trend_value) ? (string) $trend_value : 'Badge');
$badge_mode  = isset($mode) ? (string) $mode : (isset($trend_mode) ? (string) $trend_mode : 'neutral');
$class       = isset($class) ? (string) $class : '';

$badge_classes = [
  'positive' => 'badge--positive',
  'negative' => 'badge--negative',
  'neutral'  => 'badge--neutral',
  'warning'  => 'badge--warning',
  'info'     => 'badge--info',
  'accent'   => 'badge--accent',
];

$mode_class = isset($badge_classes[$badge_mode]) ? $badge_classes[$badge_mode] : $badge_classes['neutral'];
?>
<span class="<?= e(trim($component_class . ' ' . $mode_class . ' ' . $class)) ?>">
  <?= e($badge_label) ?>
</span>
