$(document).ready(function () {
  $('.paila_slider').slick({
    autoplay: true,
    autoplaySpeed: 3000,
    arrows: false,
    infinite: true,
    speed: 500,
    fade: true,
    cssEase: 'linear'
  })
})
$(document).on("scroll", () => {
  const top = $(window).scrollTop()
  $("header").removeClass('dark');
  if (top > 90) {
    $("header").addClass('dark');
  }
})