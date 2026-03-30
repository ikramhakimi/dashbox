<?php

$page_title   = 'Create User';
$page_current = 'users-create';

$menu_items = [
  [
    'label' => 'Overview',
    'href'  => asset('/'),
  ],
  [
    'label'    => 'UI Elements',
    'children' => ui_elements_sidebar_children(),
  ],
  [
    'label'    => 'UI Patterns',
    'children' => ui_patterns_sidebar_children(),
  ],
  [
    'label' => 'Settings',
    'href'  => '#',
  ],
];

$capture = static function (string $component_name, array $props): string {
  ob_start();
  component($component_name, $props);
  return (string) ob_get_clean();
};

ob_start();
?>
<form action="#" method="post">
  <section class="form-section">
    <div class="form-section__grid">
      <?= $capture('input', [
        'id'          => 'user-first-name',
        'name'        => 'first_name',
        'label'       => '*First Name',
        'placeholder' => 'e.g. Nur',
        'required'    => true,
      ]) ?>

      <?= $capture('input', [
        'id'          => 'user-last-name',
        'name'        => 'last_name',
        'label'       => '*Last Name',
        'placeholder' => 'e.g. Aina',
        'required'    => true,
      ]) ?>

      <?= $capture('input', [
        'id'          => 'user-display-name',
        'name'        => 'display_name',
        'label'       => '*Display Name',
        'placeholder' => 'e.g. Nur Aina',
        'required'    => true,
      ]) ?>

      <?= $capture('select', [
        'id'      => 'user-role',
        'name'    => 'role',
        'label'   => '*Role',
        'value'   => '',
        'required' => true,
        'options' => [
          ['label' => 'Select Role', 'value' => '', 'disabled' => true],
          ['label' => 'Admin', 'value' => 'admin'],
          ['label' => 'Moderator', 'value' => 'moderator'],
          ['label' => 'Staff', 'value' => 'staff'],
        ],
      ]) ?>
    </div>
  </section>

  <section class="form-section">
    <div class="form-section__grid">
      <?= $capture('input', [
        'id'          => 'user-phone',
        'name'        => 'phone_number',
        'type'        => 'tel',
        'label'       => '*Phone',
        'placeholder' => '012-3456789',
        'required'    => true,
      ]) ?>

      <?= $capture('input', [
        'id'          => 'user-email',
        'name'        => 'email',
        'type'        => 'email',
        'label'       => '*Email',
        'placeholder' => 'user@company.com',
        'required'    => true,
      ]) ?>
    </div>
  </section>

  <section class="form-section form-section--last">
    <div class="form-section__grid">
      <?= $capture('select', [
        'id'      => 'user-gender',
        'name'    => 'gender',
        'label'   => 'Gender',
        'value'   => '',
        'options' => [
          ['label' => 'Select Gender', 'value' => '', 'disabled' => true],
          ['label' => 'Male', 'value' => 'male'],
          ['label' => 'Female', 'value' => 'female'],
        ],
      ]) ?>

      <?= $capture('select', [
        'id'      => 'user-race',
        'name'    => 'race',
        'label'   => 'Race',
        'value'   => '',
        'options' => [
          ['label' => 'Select Race', 'value' => '', 'disabled' => true],
          ['label' => 'Malay', 'value' => 'malay'],
          ['label' => 'Chinese', 'value' => 'chinese'],
          ['label' => 'Indian', 'value' => 'indian'],
        ],
      ]) ?>

      <div class="form-section__full">
        <?= $capture('datetime-input', [
          'id'    => 'user-birthdate',
          'name'  => 'birthdate',
          'label' => 'Birthdate',
          'mode'  => 'date',
        ]) ?>
      </div>
    </div>
  </section>

  <div class="form-actions">
    <?= $capture('button', [
      'label'   => 'Create User',
      'variant' => 'primary',
      'type'    => 'submit',
    ]) ?>
    <?= $capture('button', [
      'label'   => 'Reset',
      'type'    => 'reset',
    ]) ?>
  </div>
</form>
<?php
$create_user_form_content = (string) ob_get_clean();

layout('layout-start', [
  'page_title'   => $page_title,
  'page_current' => $page_current,
]);
?>
<div class="flex min-h-screen">
  <?php component('sidebar', ['menu_items' => $menu_items]); ?>

  <main class="content flex-1 p-4 lg:p-10">
    <section class="mx-auto max-w-7xl space-y-6">
      <?php
      component('page-header', [
        'title'       => 'Create User',
        'description' => 'Template form for onboarding new users into the dashboard system.',
      ]);
      ?>

      <article class="card" aria-label="Create user form">
        <?= $create_user_form_content ?>
      </article>
    </section>
  </main>
</div>
<?php layout('layout-end'); ?>
