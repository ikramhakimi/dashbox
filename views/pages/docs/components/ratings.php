<?php

$page_title   = 'Ratings';
$page_current = 'ratings';

$menu_items = build_main_menu_items($page_current);

$capture = static function (string $component_name, array $props): string {
  ob_start();
  component($component_name, $props);
  return (string) ob_get_clean();
};

layout('app-start', [
  'page_title'   => $page_title,
  'page_current' => $page_current,
]);
?>
    <section class="card">
      <header class="card__head">
        <h1 class="mt-2 type-h1">Ratings</h1>
        <p class="mt-2 max-w-3xl type-body">
          Star-based rating input component for feedback forms and review workflows.
        </p>
      </header>

      <section class="card__list" aria-label="Rating component showcase">
        <ul class="list">
          <li class="list__item">
            <section class="w-full max-w-4xl py-4">
        <article class="space-y-4 py-7 first:pt-0 last:pb-0">
          <div class="grid gap-4 md:grid-cols-2">
            <div class="rounded-lg border border-gray-100 bg-white p-4">
              <?= $capture('rating', [
                'id'        => 'rating-default',
                'name'      => 'rating_default',
                'label'     => 'Session Rating',
                'value'     => 0,
                'help_text' => 'Select a score from 1 to 5 stars.',
              ]) ?>
            </div>

            <div class="rounded-lg border border-gray-100 bg-white p-4">
              <?= $capture('rating', [
                'id'        => 'rating-preselected',
                'name'      => 'rating_preselected',
                'label'     => 'Preselected Value',
                'value'     => 4,
                'help_text' => 'Useful when editing existing feedback.',
              ]) ?>
            </div>
          </div>
        </article>
            </section>
          </li>
          <li class="list__item">
            <section class="w-full max-w-4xl py-4">
        <article class="space-y-4 py-7 first:pt-0 last:pb-0">
          <div class="grid gap-4 md:grid-cols-2">
            <div class="rounded-lg border border-gray-100 bg-white p-4">
              <?= $capture('rating', [
                'id'         => 'rating-required-error',
                'name'       => 'rating_required_error',
                'label'      => 'Required Rating',
                'required'   => true,
                'value'      => 0,
                'error_text' => 'A quick star rating helps us improve your next experience.',
              ]) ?>
            </div>

            <div class="rounded-lg border border-gray-100 bg-white p-4">
              <?= $capture('rating', [
                'id'       => 'rating-disabled',
                'name'     => 'rating_disabled',
                'label'    => 'Disabled',
                'value'    => 3,
                'disabled' => true,
                'help_text'=> 'Disabled while form is processing.',
              ]) ?>
            </div>
          </div>
        </article>
            </section>
          </li>
          <li class="list__item">
            <section class="w-full max-w-4xl py-4">
        <article class="space-y-4 py-7 first:pt-0 last:pb-0">
          <div class="grid gap-4 md:grid-cols-3">
            <div class="rounded-lg border border-gray-100 bg-white p-4">
              <div class="card__body space-y-2">
                <p class="type-caption">Last Session</p>
                <?= $capture('rating', [
                  'id'       => 'rating-readonly-session',
                  'name'     => 'rating_readonly_session',
                  'value'    => 5,
                  'readonly' => true,
                ]) ?>
                <p class="type-meta">5.0 from customer feedback</p>
              </div>
            </div>

            <div class="rounded-lg border border-gray-100 bg-white p-4">
              <div class="card__body space-y-2">
                <p class="type-caption">Average Score</p>
                <?= $capture('rating', [
                  'id'       => 'rating-readonly-average',
                  'name'     => 'rating_readonly_average',
                  'value'    => 4,
                  'readonly' => true,
                ]) ?>
                <p class="type-meta">4.7 across 318 reviews</p>
              </div>
            </div>

            <div class="rounded-lg border border-gray-100 bg-white p-4">
              <div class="card__body space-y-2">
                <p class="type-caption">Needs Attention</p>
                <?= $capture('rating', [
                  'id'       => 'rating-readonly-low',
                  'name'     => 'rating_readonly_low',
                  'value'    => 2,
                  'readonly' => true,
                ]) ?>
                <p class="type-meta">2.8 from recent feedback</p>
              </div>
            </div>
          </div>
        </article>
            </section>
          </li>
        </ul>
      </section>
    </section>
<?php layout('app-end'); ?>
