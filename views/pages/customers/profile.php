<?php

$page_title   = 'Customer Profile Form';
$page_current = 'customers-profile';

$menu_items = build_main_menu_items();

$capture = static function (string $component_name, array $props): string {
  ob_start();
  component($component_name, $props);
  return (string) ob_get_clean();
};

$occupation_options = [
  ['label' => 'Select Occupation', 'value' => '', 'disabled' => true],
  ['label' => 'Corporate / Office', 'value' => 'corporate_office'],
  ['label' => 'Executive', 'value' => 'executive'],
  ['label' => 'Manager', 'value' => 'manager'],
  ['label' => 'Senior Manager', 'value' => 'senior_manager'],
  ['label' => 'Director / C-Level', 'value' => 'director_c_level'],
  ['label' => 'Administrative Staff', 'value' => 'administrative_staff'],
  ['label' => 'HR Personnel', 'value' => 'hr_personnel'],
  ['label' => 'Finance / Accountant', 'value' => 'finance_accountant'],
  ['label' => 'Marketing / Sales', 'value' => 'marketing_sales'],
  ['label' => 'Software Developer / Engineer', 'value' => 'software_engineer'],
  ['label' => 'IT Support / Technician', 'value' => 'it_support_technician'],
  ['label' => 'Data Analyst / Scientist', 'value' => 'data_analyst_scientist'],
  ['label' => 'UI/UX Designer', 'value' => 'ui_ux_designer'],
  ['label' => 'Digital Marketer', 'value' => 'digital_marketer'],
  ['label' => 'Content Creator / Influencer', 'value' => 'content_creator_influencer'],
  ['label' => 'Doctor', 'value' => 'doctor'],
  ['label' => 'Nurse', 'value' => 'nurse'],
  ['label' => 'Pharmacist', 'value' => 'pharmacist'],
  ['label' => 'Medical Assistant', 'value' => 'medical_assistant'],
  ['label' => 'Dentist', 'value' => 'dentist'],
  ['label' => 'Teacher', 'value' => 'teacher'],
  ['label' => 'Lecturer / Professor', 'value' => 'lecturer_professor'],
  ['label' => 'Tutor', 'value' => 'tutor'],
  ['label' => 'Engineer (Civil / Mechanical / Electrical)', 'value' => 'engineer_civil_mechanical_electrical'],
  ['label' => 'Technician', 'value' => 'technician'],
  ['label' => 'Architect', 'value' => 'architect'],
  ['label' => 'Quantity Surveyor', 'value' => 'quantity_surveyor'],
  ['label' => 'Business Owner', 'value' => 'business_owner'],
  ['label' => 'Entrepreneur', 'value' => 'entrepreneur'],
  ['label' => 'Freelancer', 'value' => 'freelancer'],
  ['label' => 'Trader / Retailer', 'value' => 'trader_retailer'],
  ['label' => 'E-commerce Seller', 'value' => 'ecommerce_seller'],
  ['label' => 'Chef / Cook', 'value' => 'chef_cook'],
  ['label' => 'Waiter / Waitress', 'value' => 'waiter_waitress'],
  ['label' => 'Barista', 'value' => 'barista'],
  ['label' => 'Hotel Staff', 'value' => 'hotel_staff'],
  ['label' => 'Customer Service', 'value' => 'customer_service'],
  ['label' => 'Driver (Grab / Lalamove / Logistic)', 'value' => 'driver_grab_lalamove_logistic'],
  ['label' => 'Dispatcher', 'value' => 'dispatcher'],
  ['label' => 'Warehouse Staff', 'value' => 'warehouse_staff'],
  ['label' => 'Government Officer', 'value' => 'government_officer'],
  ['label' => 'Enforcement Officer (Police / Army)', 'value' => 'enforcement_officer'],
  ['label' => 'Clerk (Public Sector)', 'value' => 'clerk_public_sector'],
  ['label' => 'Photographer / Videographer', 'value' => 'photographer_videographer'],
  ['label' => 'Designer (Graphic / Multimedia)', 'value' => 'designer_graphic_multimedia'],
  ['label' => 'Artist / Musician', 'value' => 'artist_musician'],
  ['label' => 'Student', 'value' => 'student'],
  ['label' => 'Housewife / Homemaker', 'value' => 'housewife_homemaker'],
  ['label' => 'Retired', 'value' => 'retired'],
  ['label' => 'Unemployed', 'value' => 'unemployed'],
];

$interest_groups = [
  'Life Events & Milestones' => [
    'Wedding / Engagement',
    'Pre-Wedding',
    'Newly Married',
    'Pregnancy / Maternity',
    'Newborn / Baby',
    'Kids / Family',
    'Graduation',
    'Birthday Celebration',
    'Anniversary',
  ],
  'Personal & Lifestyle' => [
    'Fitness / Gym',
    'Beauty / Skincare',
    'Fashion / Outfit',
    'Travel / Vacation',
    'Food & Cafe Hunting',
    'Luxury Lifestyle',
    'Minimalist Lifestyle',
  ],
  'Photography-Related' => [
    'Photography Enthusiast',
    'Self Photoshoot',
    'Studio Photoshoot',
    'Outdoor Photoshoot',
    'Personal Branding',
    'Portfolio Building',
    'Content Creation',
  ],
  'Business & Professional' => [
    'Entrepreneurship',
    'Small Business / SME',
    'E-commerce',
    'Marketing & Branding',
    'Social Media Growth',
    'Personal Branding',
  ],
  'Creative & Content' => [
    'TikTok Content',
    'Instagram Content',
    'YouTube Creator',
    'Influencer Lifestyle',
    'Graphic Design',
    'Video Production',
  ],
  'Family-Oriented' => [
    'Parenting',
    'Family Activities',
    'Kids Education',
    'Home & Living',
  ],
  'Shopping & Spending Behavior' => [
    'Budget Shopper',
    'Premium / Luxury Buyer',
    'Promo Hunter',
    'Online Shopping (Shopee / Lazada)',
  ],
  'Malaysia-Specific / Cultural' => [
    'Ramadan / Raya Preparation',
    'Open House / Festive Events',
    'Wedding Kenduri',
    'Islamic Lifestyle',
    'Halal Lifestyle',
  ],
  'Entertainment & Hobbies' => [
    'Gaming',
    'Movies / Netflix',
    'Music',
    'Outdoor Activities',
    'Sports',
  ],
  'Intent-Based' => [
    'Looking for Photographer',
    'Comparing Packages',
    'Asked for Pricing',
    'Clicked WhatsApp Link',
    'Visited Booking Page',
    'Abandoned Booking',
  ],
];

ob_start();
?>
<form class="form" action="#" method="post" aria-label="Customer profile enrichment form">
  <section class="form-section">
    <div class="form-section__grid">
      <?= $capture('input', [
        'id'          => 'customer-name',
        'name'        => 'name',
        'label'       => 'Name',
        'placeholder' => 'e.g. Nur Aina',
      ]) ?>

      <?= $capture('datetime-input', [
        'id'    => 'customer-birthdate',
        'name'  => 'birthdate',
        'label' => 'Birthdate',
        'mode'  => 'date',
      ]) ?>

      <?= $capture('select', [
        'id'      => 'customer-gender',
        'name'    => 'gender',
        'label'   => 'Gender',
        'value'   => '',
        'options' => [
          ['label' => 'Select Gender', 'value' => '', 'disabled' => true],
          ['label' => 'Male', 'value' => 'male'],
          ['label' => 'Female', 'value' => 'female'],
          ['label' => 'Prefer not to say', 'value' => 'prefer_not_to_say'],
        ],
      ]) ?>

      <?= $capture('select', [
        'id'      => 'customer-marital',
        'name'    => 'marital_status',
        'label'   => 'Marital Status',
        'value'   => '',
        'options' => [
          ['label' => 'Select Marital Status', 'value' => '', 'disabled' => true],
          ['label' => 'Single', 'value' => 'single'],
          ['label' => 'Married', 'value' => 'married'],
          ['label' => 'Divorced', 'value' => 'divorced'],
          ['label' => 'Widowed', 'value' => 'widowed'],
        ],
      ]) ?>

      <?= $capture('select', [
        'id'      => 'customer-state',
        'name'    => 'location_state',
        'label'   => 'Location State',
        'value'   => '',
        'options' => [
          ['label' => 'Select State', 'value' => '', 'disabled' => true],
          ['label' => 'Kuala Lumpur', 'value' => 'kuala_lumpur'],
          ['label' => 'Selangor', 'value' => 'selangor'],
          ['label' => 'Johor', 'value' => 'johor'],
          ['label' => 'Penang', 'value' => 'penang'],
          ['label' => 'Sabah', 'value' => 'sabah'],
          ['label' => 'Sarawak', 'value' => 'sarawak'],
        ],
      ]) ?>

      <?= $capture('input', [
        'id'          => 'customer-children-count',
        'name'        => 'children_count',
        'type'        => 'number',
        'label'       => 'Children Count',
        'placeholder' => 'e.g. 2',
      ]) ?>

      <div class="form-section__full">
        <?= $capture('select', [
          'id'       => 'customer-occupation',
          'name'     => 'occupation',
          'label'    => 'Occupation',
          'value'    => '',
          'options'  => $occupation_options,
          'help_text'=> 'Select the closest role to help personalize communication and offers.',
        ]) ?>
      </div>
    </div>
  </section>

  <section class="form-section form-section--last">
    <div class="form-section__grid">
      <div class="form-section__full">
        <p class="type-body">Interests</p>
        <p class="mt-1 text-muted">Pick all relevant interests to support campaign and package targeting.</p>
      </div>
      <?php foreach ($interest_groups as $group_title => $interest_items): ?>
        <div class="form-section__full rounded-md border border-gray-200 p-4">
          <p class="type-caption type-semibold"><?= e($group_title) ?></p>
          <div class="mt-3 grid gap-3 md:grid-cols-2">
            <?php foreach ($interest_items as $interest_index => $interest_item): ?>
              <?php
              $interest_key = strtolower((string) preg_replace('/[^a-z0-9]+/', '_', $interest_item));
              component('checkbox', [
                'id'    => 'interest-' . $interest_key . '-' . (string) $interest_index,
                'name'  => 'interests[]',
                'label' => $interest_item,
                'value' => $interest_key,
              ]);
              ?>
            <?php endforeach; ?>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </section>

  <div class="form-actions">
    <?= $capture('button', [
      'label'   => 'Save Profile',
      'variant' => 'primary',
      'type'    => 'submit',
    ]) ?>
    <?= $capture('button', [
      'label' => 'Reset',
      'type'  => 'reset',
    ]) ?>
  </div>
</form>
<?php
$profile_form_content = (string) ob_get_clean();

layout('app-start', [
  'page_title'   => $page_title,
  'page_current' => $page_current,
]);
?>
    <section class="card" aria-label="Customer profile form card">
      <div class="card__head">
        <?php component('page-header', [
          'title'       => 'Customer Profile Form',
          'description' => 'Collect missing demographic and interest data after each completed session.',
        ]); ?>
      </div>

      <article class="card__body" aria-label="Customer profile form">
        <?= $profile_form_content ?>
      </article>
    </section>
<?php layout('app-end'); ?>
