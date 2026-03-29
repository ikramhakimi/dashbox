<?php

$trend_value = isset($trend_value) ? (string) $trend_value : '0%';
$trend_mode  = isset($trend_mode) ? (string) $trend_mode : 'neutral';

$badge_classes = [
  'positive' => 'badge--positive',
  'negative' => 'badge--negative',
  'neutral'  => 'badge--neutral',
];

$mode_class = isset($badge_classes[$trend_mode]) ? $badge_classes[$trend_mode] : $badge_classes['neutral'];
?>
<span class="<?= e(trim($component_class . ' ' . $mode_class)) ?>">
  <?= e($trend_value) ?>
</span>
