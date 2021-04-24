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

$(document).ready(function() {
  // Activate swatches_color
  var swatches_color = $(".swatches-color");
  $(swatches_color).each( function(){
    var swatches_color_items = $(".swatches-color-item");
    swatches_color_items.each( function(){
      $(this).click( function(){
        $('.swatches-color-item-selected-decorator').fadeOut('fast')
        $(this).find('.swatches-color-item-selected-decorator').fadeIn('fast');

        // TODO re-calculate price based on selection
      });
    });
  });

  // Activate swatches_size
  var swatches_size = $(".swatches-size");
  $(swatches_size).each( function(){
    var swatches_size_items = $(".swatches-size-item");
    swatches_size_items.each( function(){
      $(this).click( function(){
        $('.swatches-size-item-selected-decorator').fadeOut('fast')
        $(this).find('.swatches-size-item-selected-decorator').fadeIn('fast');

        // TODO re-calculate price based on selection
      });
    });
  });
});