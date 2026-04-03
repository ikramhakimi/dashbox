<?php
$docs_component_slugs = [
  'alerts',
  'avatars',
  'badges',
  'breadcrumbs',
  'buttons',
  'cards',
  'drawers',
  'dropdowns',
  'empty-states',
  'icons',
  'inputs',
  'lists',
  'modals',
  'package-features',
  'page-headers',
  'paginations',
  'ratings',
  'tables',
  'tabs',
  'toasts',
  'typography',
  'uploads',
];

$docs_pattern_slugs = [
  'crm-pipeline',
  'forms',
  'nuggets',
];

$page_current_value = isset($page_current) ? (string) $page_current : '';
$active_component   = in_array($page_current_value, $docs_component_slugs, true) ? $page_current_value : '';
$active_pattern     = in_array($page_current_value, $docs_pattern_slugs, true) ? $page_current_value : '';

$menu_items = isset($menu_items) && is_array($menu_items)
  ? $menu_items
  : build_main_menu_items($active_component, $active_pattern);

layout('layout-start', [
  'page_title'            => $page_title ?? 'Dashboard',
  'page_current'          => $page_current ?? '',
  'top_banner_text'       => $top_banner_text ?? '',
  'top_banner_description'=> $top_banner_description ?? '',
]);
?>
<div class="flex min-h-screen">
  <?php component('sidebar', ['menu_items' => $menu_items]); ?>

  <main class="app-content flex-1 p-3">
