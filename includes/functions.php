<?php

declare(strict_types=1);

function e($value): string
{
  return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

function build_component_class(string $component_name, array $states = []): string
{
  $segments = explode('-', $component_name, 2);
  $block    = $segments[0] ?: 'component';
  $modifier = $segments[1] ?? null;

  $classes = [$block];

  if ($modifier !== null && $modifier !== '') {
    $classes[] = $block . '--' . $modifier;
  }

  foreach ($states as $state => $enabled) {
    if ($enabled) {
      $classes[] = $block . '--' . $state;
    }
  }

  return implode(' ', array_unique($classes));
}

function component(string $name, array $data = []): void
{
  $component_path = __DIR__ . '/../views/components/' . $name . '.php';

  if (!is_file($component_path)) {
    throw new RuntimeException('Component not found: ' . $name);
  }

  $states          = isset($data['states']) && is_array($data['states']) ? $data['states'] : [];
  $component_class = build_component_class($name, $states);

  extract($data, EXTR_SKIP);
  require $component_path;
}

function layout(string $name, array $data = []): void
{
  $layout_path = __DIR__ . '/../views/layout/' . $name . '.php';

  if (!is_file($layout_path)) {
    throw new RuntimeException('Layout not found: ' . $name);
  }

  extract($data, EXTR_SKIP);
  require $layout_path;
}
