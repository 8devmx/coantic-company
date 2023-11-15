$(document).ready(function () {
  $('.slide').slick({
    autoplay: true,
    autoplaySpeed: 3000,
    arrows: false,
    infinite: true,
    slidesToShow: 4,
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
          slidesToShow: 2,
          slidesToScroll: 1
        }
      }
    ]
  })
})