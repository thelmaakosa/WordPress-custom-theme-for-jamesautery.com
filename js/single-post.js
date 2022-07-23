jQuery(document).ready(function ($) {
  $('.post .gallery-item a').swipebox({
    useCSS: true,
    useSVG: true,
    initialIndexOnArray: 0,
    hideCloseButtonOnMobile: false,
    removeBarsOnMobile: true,
    hideBarsDelay: 3000,
    videoMaxWidth: 1140,
    loopAtEnd: true
  });
});