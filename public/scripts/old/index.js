


var swiper = new Swiper(".big-slider", {
  pagination: {
    el: ".swiper-pagination",
    type: "fraction",
  },
  navigation: {
    nextEl: ".next-slide",
    prevEl: ".prev-slide",
  },
});

const products = () => {
var productSliders = document.querySelectorAll('.products-slider');
  productSliders.forEach( function(slider, index) {
    let sliderLength = slider.children[0].children.length;
    let result = (sliderLength > 4) ? true : false;
    let prevArrow = document.querySelectorAll('.product-prev');
    let nextArrow = document.querySelectorAll('.product-next');
    let paginationBLock = document.querySelectorAll('.product-pagination');

    function checkArrow() {
      var swiperPrev = prevArrow[index];
      var swiperNext = nextArrow[index];
      let pagination = paginationBLock[index];
      if ( window.innerWidth > 1169 ) {
        swiperPrev.style.display = 'flex';
        swiperNext.style.display = 'flex';
        pagination.style.display = 'none';
      } else {
        swiperPrev.style.display = 'none';
        swiperNext.style.display = 'none';
        pagination.style.display = 'flex';
      }
    }

    var swiper = new Swiper(slider, {
      slidesPerView: 1,
      spaceBetween: 11,
      direction: 'horizontal',
      loop: result,
      observer: true,
      pagination: {
        el: paginationBLock[index],
        type: 'bullets',
        clickable: true,
      },
      navigation: {
        nextEl: nextArrow[index],
        prevEl: prevArrow[index],
      },
      on: {
        init: function() {
          checkArrow();
        },
        resize: function () {
          checkArrow();
        }
      },
      breakpoints: {
        480: {
          slidesPerView: 2,
        },
        700: {
          slidesPerView: 3,
        },
        991: {
          slidesPerView: 4,
        },
        1169: {
          slidesPerView: 5,
        }
      }
    });
  });
};

var SwiperBig = new Swiper(".big-article", {
  slidesPerView: 1,
  spaceBetween: 0,
  direction: 'horizontal',
  observer: true,
  effect: "fade",
  fade: { crossFade: false },
  speed: 300,
});

var SwiperSmall = new Swiper(".small-article", {
  slidesPerView: 3,
  spaceBetween: 19,
  direction: 'horizontal',
  //Если поставить loop: true, то если меньше 3 картинок будет дубилроваться одна или две
  observer: true,
  navigation: {
    nextEl: '.article-next',
    prevEl: '.article-prev',
  },
  breakpoints: {
    480: {
      slidesPerView: 4,
    },
    700: {
      slidesPerView: 5,
    },
    991: {
      slidesPerView: 4,
    },
  }
});

// const changeCount = () => {
//   var count = 1;
//   const minus = document.querySelectorAll('.minus-cart')
//   const plus = document.querySelectorAll('.plus-cart')
//   minus.forEach(function(elem) {
//     elem.addEventListener('click', function(e) {
//       if (count > 1) {
//         count--;
//         e.target.nextElementSibling.value = count;
//       }
//     })
//   })
//   plus.forEach(function(elem) {
//     elem.addEventListener('click', function(e) {
//       count++;
//       e.target.previousElementSibling.value = count;
//     })
//   })
// }

window.addEventListener('load', function () {
  const selects = document.querySelectorAll('.lang');
  selects.forEach(function(elem) {
    const select2 = new TsSelect2(
      elem,
      {
        width: `57px`,
        minimumResultsForSearch: -1,
      }
    );
  });

  document.getElementById('menu').addEventListener('click', function () {
    const menu = document.querySelector('.header-menu');
    menu.classList.add('open');
    // document.body.classList.add('no-scroll')
  })

  document.getElementById('close-menu').addEventListener('click', function () {
    const menu = document.querySelector('.header-menu');
    menu.classList.remove('open');
    // document.body.classList.remove('no-scroll')
  })



  // document.getElementById('catalog').addEventListener('click', function () {
  //   const menu = document.querySelector('.submenu');
  //   menu.classList.toggle('open');
  //   // document.body.classList.toggle('no-scroll')
  // })

  // if(getCookie('menu') == undefined){
  //   addClass('submenu','open');
  // }

  function removeClass(el, className)
  {
    if (el.classList)
      el.classList.remove(className)
    else if (hasClass(el, className))
    {
      var reg = new RegExp('(\\s|^)' + className + '(\\s|$)');
      el.className = el.className.replace(reg, ' ');
    }
  }

  function addClass(el, className)
  {
    if (el.classList)
      el.classList.add(className)
    else if (!hasClass(el, className))
      el.className += " " + className;
  }
  // document.cookie = "menu=open;max-age=2629743";

  function getCookie(name) {
    var matches = document.cookie.match(new RegExp("(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"));
    return matches ? decodeURIComponent(matches[1]) : undefined;
  }

  document.getElementById('close-catalog').addEventListener('click', function () {
    const menu = document.querySelector('.submenu');
    menu.classList.remove('open');
    // document.body.classList.remove('no-scroll')
  })
  products();
  // if (document.querySelectorAll(".count").length) {
  //   changeCount();
  // }


  if (typeof ymaps !== "undefined" && document.getElementById('map')) {
    ymaps.ready(init);

  console.log(ymaps)


    function init() {
      var myMap = new ymaps.Map(document.getElementById('map'), {
        center: [55.821649, 49.087172],
        zoom: 17,
        controls: ["zoomControl"],
      });

      myMap.controls.add("fullscreenControl", {
        float: "left",
      });
      // Создаем геообъект с типом геометрии "Точка".
      myGeoObject = new ymaps.GeoObject();
      myMap.behaviors.disable("scrollZoom");
      myMap.geoObjects.add(
        new ymaps.Placemark(
          [55.821649, 49.087172],
          {
            balloonContent: 'Ул. Декабристов, 113 (вход со стороны ул. Лушникова)'
          },
          {
            // Опции.
            iconLayout: "default#image",
            iconImageHref: './assets/pin.png',
            iconImageSize: [30, 42],
            // Смещение левого верхнего угла иконки относительно
            // её "ножки" (точки привязки).
            iconImageOffset: [-5, -38]
          }
        )
      );
    }
  }

  SwiperSmall.controller.control = SwiperBig;
  SwiperBig.controller.control = SwiperSmall;
})



// document.querySelectorAll('.js-select-page').forEach(function(btn){
//     pageFirst(btn);
//
//     btn.addEventListener('click', function(){
//       page(this);
//     })
// })
//
// document.querySelectorAll('.js-innerSelect-page').forEach(function(btn){
//   innerPageFirst(btn);
//
//   btn.addEventListener('click', function(){
//     innerPage(this);
//   })
// })

// function pageFirst(input){
//     id = input.id;
//     data = document.querySelector('#' + id).dataset.selectPage;
//     dataWar = document.querySelector('#' + id).dataset.selectWarning;
//     className = false;
//
//     if(input.checked){
//         display = "block";
//         className = true;
//     } else{
//         display = "none";
//     }
//
//     document.querySelector('.order__page[data-page='+data+']').style.display = display;
//     if(dataWar != ''){
//       document.querySelector('.js-order__page-warning[data-warning='+dataWar+']').style.display = display;
//     }
//     if(className){
//       document.querySelector('.order__page[data-page='+data+']').classList.add('active');
//     }
// }

function page(input){
    id = input.id;
    data = document.querySelector('#' + id).dataset.selectPage;
    dataWar = document.querySelector('#' + id).dataset.selectWarning;

    document.querySelector('.order__page.outer.active').style.display = 'none';
    document.querySelector('.order__page.outer.active').classList.remove('active');
    document.querySelector('.js-order__page-warning').style.display = 'none';

    document.querySelector('.order__page[data-page='+data+']').style.display = 'block';
    document.querySelector('.order__page[data-page='+data+']').classList.add('active');
    if(dataWar != ''){
      document.querySelector('.js-order__page-warning[data-warning='+dataWar+']').style.display = 'block';
    }
}

function innerPageFirst(input){
  id = input.id;
  data = document.querySelector('#' + id).dataset.innerSelectPage;

  if(input.checked){
      display = "block";
  } else{
      display = "none";
  }

  document.querySelector('.order__page[data-inner-page='+data+']').style.display = display;
  document.querySelector('.order__page[data-inner-page='+data+']').classList.add('active');
}

function innerPage(input){
  id = input.id;
  data = document.querySelector('#' + id).dataset.innerSelectPage;

  document.querySelector('.order__page.inner.active').style.display = 'none';
  document.querySelector('.order__page.inner.active').classList.remove('active');

  document.querySelector('.order__page[data-inner-page='+data+']').style.display = 'block';
  document.querySelector('.order__page[data-inner-page='+data+']').classList.add('active');
}
//Profile menu
document.querySelectorAll('.js-select-menu-page').forEach(function(el){
  setupPages(el);

  el.addEventListener('click', function(e){
    e.preventDefault();
    selectPage(this);
  })
})

function setupPages(page){
  let data = page.dataset.selectMenuPage;

  if(page.classList.contains('_active')){
    document.querySelector('.profile__content-page[data-menu-page=' +data+']').classList.add('_active');
  }
}

function selectPage(page){
  let data = page.dataset.selectMenuPage;

  document.querySelector('.profile__menu-item._active').classList.remove('_active');
  document.querySelector('.profile__content-page._active').classList.remove('_active');

  page.classList.add('_active');
  document.querySelector('.profile__content-page[data-menu-page=' +data+']').classList.add('_active');
}

// document.querySelectorAll('.table__item-titles').forEach(function(el){
//   el.addEventListener('click', function (){
//     el.parentNode.classList.toggle('_active');
//     el.nextElementSibling.classList.toggle('_active');
//   })
// })

$('.table__item-titles').each(function(){
  $(this).click(function () {
    $(this).parent().toggleClass('_active');
    $(this).next().slideToggle();
  });
})

//Делаем маску для телефона
if($('input[type=tel]').length > 0){
  $('input[type=tel]').inputmask('+ 7 (999) 999 99 99');
  $("input[type=tel]").inputmask({ "clearIncomplete": true });
}
if($('#email').length > 0){
  $('#email').inputmask({
    mask: "*{1,20}[.*{1,20}][.*{1,20}][.*{1,20}]@*{1,20}[.*{2,6}][.*{1,2}]",
    greedy: false,
    onBeforePaste: function (pastedValue, opts) {
      pastedValue = pastedValue.toLowerCase();
      return pastedValue.replace("mailto:", "");
    },
    definitions: {
      '*': {
        validator: "[0-9A-Za-z!#$%&'*+/=?^_`{|}~\-]",
        casing: "lower"
      }
    }
  });
}



