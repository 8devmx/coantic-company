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

  $('.sectors_slider').slick({
    autoplay: true,
    autoplaySpeed: 3000,
    arrows: false,
    infinite: true,
    slidesToShow: 6,
    SlidesToScroll: 1,
    responsive: [
      {
        breakpoint: 480,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
        }
      },
      {
        breakpoint: 992,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 1
        }
      }
    ]
  })
  $('.services_slider').slick({
    autoplay: true,
    autoplaySpeed: 3000,
    arrows: false,
    infinite: true,
    slidesToShow: 2,
    SlidesToScroll: 1,
    slide: "div",
    responsive: [
      {
        breakpoint: 480,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
        }
      },
      {
        breakpoint: 992,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 1
        }
      }
    ]
  })

})
$(document).on("scroll", () => {
  const top = $(window).scrollTop()
  $("header").removeClass('dark');
  if (top > 90) {
    $("header").addClass('dark');
  }
})

AOS.init({
  once: true,
  offset: 200,
  delay: 20,
  duration: 300
})
