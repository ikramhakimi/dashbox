<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= e($page_title ?? 'Dashboard') ?></title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="<?= e(asset('assets/build/app.css')) ?>">
</head>
<body class="min-h-screen bg-zinc-100 font-sans text-sm text-gray-900">
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
