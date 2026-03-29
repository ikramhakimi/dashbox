<?php

$page_title = 'Not Found';

layout('layout-start', [
  'page_title' => $page_title,
]);
?>
<main class="mx-auto flex min-h-screen w-full max-w-3xl items-center justify-center px-6">
  <div class="rounded-2xl border border-gray-200 bg-white p-8 text-center">
    <p class="text-sm font-medium uppercase tracking-wide text-gray-500">404</p>
    <h1 class="mt-2 text-2xl font-semibold text-gray-900">Page not found</h1>
    <p class="mt-2 text-sm text-gray-500">The page you requested could not be located.</p>
    <a href="<?= e(asset('/')) ?>" class="mt-5 inline-flex rounded-lg border border-gray-200 bg-gray-50 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100">
      Back to dashboard
    </a>
  </div>
</main>
<?php layout('layout-end'); ?>
