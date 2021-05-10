var galleryTop = new Swiper('.swiper-slider', {
  slidesPerView: 1,
  navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
  },
  effect: 'fade',
  fadeEffect: {
    crossFade: true
  },
  loop: true,
  autoplay: {
    delay: 5000,
  },
  loopedSlides: 2,
});

var puzzleFacts = new Swiper('.puzzle-facts-swiper', {
  slidesPerView: 1,
  pagination: {
    el: '.swiper-pagination',
    type: 'bullets',
    clickable: true,
  },
  loop: true,
  autoplay: {
    delay: 5000,
  },
  loopedSlides: 2,
});

function selectItems (el, swatch_type, form_selector) {

  // Cosmetic: show decorators
  var decorator_selector = ".swatches-" + swatch_type + "-item-selected-decorator";
  $(decorator_selector).fadeOut('fast')
  $(el).find(decorator_selector).fadeIn('fast');

  // Data: On click, update value on form selector
  var data_value = $(el).data("value");
  var data_prop = "data-" + swatch_type;
  $(form_selector).attr(data_prop, data_value);
}

function swatchItemOnClick(el, swatch_type, form_selector) {

  // Select items
  selectItems(el, swatch_type, form_selector)

  // Force price re-calculation
  update_woocommerce_price()
}

$(document).ready(function() {
  // Store form selector, which stores all state
  var form_selector = "#cart_form";

  // Bind event functionality for swatches (colors/sizes)
  var swatch_types = ['color', 'size'];
  for (const swatch_type of swatch_types) {
    // Bind events for swatches items (clickable squares)
    var swatch_selector = ".swatches-" + swatch_type;
    var items_selector = swatch_selector + "-item";

    $(items_selector).each( function(index) {
      // Bind click event
      $(this).on("click", () => swatchItemOnClick(this, swatch_type, form_selector));

      // Select first items as default
      if (index === 0) selectItems(this, swatch_type, form_selector);

    });
  }

  // After the loop is done, run price calculation.
  update_woocommerce_price()
});

function update_woocommerce_price() {

  // This shows the price
  var target = $(".swatches-price-number").first();
  // This holds the data
  var form_selector = "#cart_form";

  var color = $(form_selector).attr("data-color");
  var size  = $(form_selector).attr("data-size");
  var price_data = JSON.parse($(form_selector).attr("data-prices"));

  var price_item = price_data.find(item => (item.color === color) && (item.size === size));

  if (price_item) {
    target.html("$" + price_item.price);
  }
}