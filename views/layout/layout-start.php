<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= e($page_title ?? 'Dashboard') ?></title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" rel="stylesheet">
  <!-- <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap" rel="stylesheet"> -->
  <!-- <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&display=swap" rel="stylesheet"> -->
   <!-- <link href="https://fonts.googleapis.com/css2?family=Geist+Mono:wght@100..900&display=swap" rel="stylesheet"> -->
   <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:ital,wght@0,100..800;1,100..800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="<?= e(asset('assets/build/app.css')) ?>">
</head>
<?php
$ui_elements_pages = [
  'alerts',
  'avatars',
  'badges',
  'breadcrumbs',
  'buttons',
  'cards',
  'dropdowns',
  'empty-states',
  'icons',
  'inputs',
  'modals',
  'page-headers',
  'paginations',
  'tables',
  'tabs',
  'toasts',
  'typography',
];

$page_current = isset($page_current) ? (string) $page_current : '';
$body_class   = 'app-body';

if (in_array($page_current, $ui_elements_pages, true)) {
  $body_class .= ' page-ui-elements';
}
?>
<body class="<?= e($body_class) ?>">
  <?php
  $top_banner_text = isset($top_banner_text) ? trim((string) $top_banner_text) : '';
  $top_banner_description = isset($top_banner_description) ? trim((string) $top_banner_description) : '';
  ?>
  <?php if ($top_banner_text !== ''): ?>
    <?php
    component('alert', [
      'variant'     => 'warning',
      'title'       => $top_banner_text,
      'description' => $top_banner_description,
      'dismissible' => true,
      'inline'      => true,
      'attributes'  => [
        'class' => 'rounded-none',
      ],
    ]);
    ?>
  <?php endif; ?>
