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

function selectItem (el, swatch_type, form_selector) {

  // Generic selectors
  var any_swatch_item_selector = ".swatches-" + swatch_type + "-item";
  var any_decorator_selector   = ".swatches-" + swatch_type + "-item-selected-decorator";

  // Cosmetic: Add item-selected class to only this currently clicked item.
  $(any_swatch_item_selector).removeClass("item-selected");
  $(el).addClass("item-selected");

  // Cosmetic: divide decorators b/w selected and others
  var all_decorators_but_current = $(any_swatch_item_selector)
      .not(".item-selected")
      .find(any_decorator_selector);
  var current_decorator = $(el).find(any_decorator_selector);

  // Cosmetic: Hide others, show current.
  all_decorators_but_current.fadeOut('fast');
  current_decorator.fadeTo('medium', 100);

  // Data: On click, update value on form selector
  var data_value = $(el).data("value");
  var data_prop = "data-" + swatch_type;
  $(form_selector).attr(data_prop, data_value);
  $("#form_" + swatch_type).val(data_value);

}

function swatchItemOnClick(el, swatch_type, form_selector) {

  // Select items
  selectItem(el, swatch_type, form_selector)

  // Force price re-calculation
  update_woocommerce_price()
}

function showHoverStyle(el, swatch_type) {

  if ($(el).hasClass("item-selected")) return;

  var decorator_selector = ".swatches-" + swatch_type + "-item-selected-decorator";
  $(el).find(decorator_selector).fadeTo('fast', 0.5);
}

function hideHoverStyle(el, swatch_type) {

  if ($(el).hasClass("item-selected")) return;

  var decorator_selector = ".swatches-" + swatch_type + "-item-selected-decorator";
  $(el).find(decorator_selector).fadeTo('fast', 0);
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

      // Bind hover events
      $(this).on("mouseenter", () => showHoverStyle(this, swatch_type));
      $(this).on("mouseleave", () => hideHoverStyle(this, swatch_type));

      // Select first items as default
      if (index === 0) selectItem(this, swatch_type, form_selector);

    });
  }

  // After the loop is done, run price calculation.
  update_woocommerce_price()

  // Enable submission
  $("#submit_form").first().on("click", (e) => {
    e.preventDefault();
    $("#cart_form").submit();
  });

});

function update_woocommerce_price() {

  // This shows the price
  var target_price     = $(".swatches-price-number").first();
  var target_variation = $("#form_variation_id").first();
  // This holds the data
  var form_selector = "#cart_form";

  var color = $(form_selector).attr("data-color");
  var size  = $(form_selector).attr("data-size");
  var price_data = JSON.parse($(form_selector).attr("data-prices"));

  // Old selector for when color changes price
  // var price_item = price_data.find(item => (item.color === color) && (item.size === size));
  var price_item = price_data.find(item => item.size === size);

  if (price_item) {
    target_price.html("$" + price_item.price);
    target_variation.val(price_item.variation_id);
  }
}