jQuery(document).ready(function ($) {
  $('#project-carousel').slick({
    dots: false,
    infinite: false,
    speed: 500,
    draggable: true,
    cssEase: 'linear',
    prevArrow: '.carousel-control-prev',
    nextArrow: '.carousel-control-next',
  });

  // Currently, slick.js has a bug which creates an extra slide which is blank. This line removes the last card.
  // In addition, this causes issues with an extra slide being created. The recommended solution online is to
  // Change the slider to infinite: false.
  $('#project-carousel .slick-slide:not(.slick-cloned)').last().remove();



  var totalItems = $('#project-carousel .slick-slide:not(.slick-cloned)').length;
  var currentIndex = $('#project-carousel').slick('slickCurrentSlide') + 1;

  $('.carousel-control-prev').hide();
  $('.carousel-control-prev .carousel-tracker .current').html(currentIndex - 1 < 1 ? totalItems : currentIndex - 1);
  $('.carousel-control-next .carousel-tracker .current').html(currentIndex + 1 > totalItems ? '1' : currentIndex + 1);
  $('.carousel-tracker .total').html(totalItems);

  $('#project-carousel').on('afterChange', function (slick, currentSlide) {
    var current = currentSlide.currentSlide + 1;
    $('.carousel-control-prev .carousel-tracker .current').html(current - 1 < 1 ? totalItems : current - 1);
    $('.carousel-control-next .carousel-tracker .current').html(current + 1 > totalItems ? '1' : current + 1);

    if (current - 1 < 1) {
      $('.carousel-control-prev').hide();
    } else {
      $('.carousel-control-prev').show();
    }

    if (current + 1 > totalItems) {
      $('.carousel-control-next').hide();
    } else {
      $('.carousel-control-next').show();
    }

  });

});
