const set_active_stars = (star_elements, active_value) => {
  const normalized_value = Number(active_value) || 0;

  star_elements.forEach((star_element) => {
    const star_value = Number(star_element.getAttribute('data-rating-value') || '0');
    star_element.classList.toggle('rating__star--active', star_value <= normalized_value);
  });
};

const get_checked_value = (input_elements) => {
  const checked_input = input_elements.find((input_element) => input_element.checked);
  if (!checked_input) {
    return 0;
  }

  return Number(checked_input.value || '0') || 0;
};

const init_single_rating = (rating_element) => {
  const stars_container = rating_element.querySelector('[data-rating-stars]');
  if (!(stars_container instanceof HTMLElement)) {
    return;
  }

  const star_elements = Array.from(stars_container.querySelectorAll('[data-rating-star]'));
  const input_elements = Array.from(stars_container.querySelectorAll('[data-rating-input]'));

  if (star_elements.length === 0 || input_elements.length === 0) {
    return;
  }

  const is_disabled = input_elements.every((input_element) => input_element.disabled);
  if (is_disabled) {
    return;
  }

  const sync_checked_state = () => {
    set_active_stars(star_elements, get_checked_value(input_elements));
  };

  sync_checked_state();

  star_elements.forEach((star_element) => {
    star_element.addEventListener('mouseenter', () => {
      const preview_value = Number(star_element.getAttribute('data-rating-value') || '0');
      set_active_stars(star_elements, preview_value);
    });

    star_element.addEventListener('click', () => {
      const next_value = Number(star_element.getAttribute('data-rating-value') || '0');
      const next_input = input_elements.find((input_element) => Number(input_element.value || '0') === next_value);
      if (next_input instanceof HTMLInputElement && !next_input.disabled) {
        next_input.checked = true;
      }
      sync_checked_state();
    });
  });

  stars_container.addEventListener('mouseleave', () => {
    sync_checked_state();
  });

  stars_container.addEventListener('focusout', () => {
    window.setTimeout(sync_checked_state, 0);
  });

  input_elements.forEach((input_element) => {
    input_element.addEventListener('change', sync_checked_state);
    input_element.addEventListener('focus', () => {
      const focus_value = Number(input_element.value || '0');
      set_active_stars(star_elements, focus_value);
    });
  });
};

export const initRating = () => {
  document.querySelectorAll('[data-rating]').forEach((rating_element) => {
    if (!(rating_element instanceof HTMLElement)) {
      return;
    }

    init_single_rating(rating_element);
  });
};

