// if ( $("#map").length > 0) {
//     ymaps.ready(init);
//     var myMap;
//     function init () {
//
//         myMap = new ymaps.Map("map", {
//             center: [57.5262, 38.3061], // Углич
//             zoom: 11
//         }, {
//             balloonMaxWidth: 200,
//         });
//         if(document.getElementById("ymap").value !== '') {
//             var points = document.getElementById("ymap").value.split(';');
//             addPoint(points[0],points[1])
//         }
//         // Обработка события, возникающего при щелчке
//         // левой кнопкой мыши в любой точке карты.
//         // При возникновении такого события откроем балун.
//         myMap.events.add('click', function (e) {
//             if (!myMap.balloon.isOpen()) {
//                 myMap.geoObjects.removeAll()
//                 var coords = e.get('coords');
//                 addPoint(coords[0].toPrecision(6),coords[1].toPrecision(6))
//                 // Добавляем метку на карту
//                 myGeoObject = new ymaps.GeoObject();
//                 myMap.geoObjects.add(
//                     new ymaps.Placemark(
//                         [ coords[0].toPrecision(6) , coords[1].toPrecision(6) ],
//                         {
//                             balloonContent: '',
//                         },
//                         {
//                             // Опции.
//                             iconLayout: "default#image",
//                             iconImageHref: "/packages/img/location.png",
//                             // Размеры метки.
//                             iconImageSize: [27, 27],
//                             iconImageOffset: [-15, -27],
//                         }
//                     )
//                 );
//
//                 // Добавляем координаты в инпут
//                 document.getElementById('ymap').value = coords[0].toPrecision(6)+';'+coords[1].toPrecision(6)
//
//
//             }
//             else {
//                 myMap.balloon.close();
//             }
//         });
//
//         // Обработка события, возникающего при щелчке
//         // правой кнопки мыши в любой точке карты.
//         // При возникновении такого события покажем всплывающую подсказку
//         // в точке щелчка.
//         myMap.events.add('contextmenu', function (e) {
//             myMap.hint.open(e.get('coords'), 'Кто-то щелкнул правой кнопкой');
//         });
//
//         // Скрываем хинт при открытии балуна.
//         myMap.events.add('balloonopen', function (e) {
//             myMap.hint.close();
//         });
//     }
//
//     function addPoint(start, end)
//     {
//         myGeoObject = new ymaps.GeoObject();
//         myMap.geoObjects.add(
//             new ymaps.Placemark(
//                 [ start , end ],
//                 {
//                     balloonContent: '',
//                 },
//                 {
//                     // Опции.
//                     iconLayout: "default#image",
//                     iconImageHref: "/packages/img/location.png",
//                     // Размеры метки.
//                     iconImageSize: [27, 27],
//                     iconImageOffset: [-15, -27],
//                 }
//             )
//         );
//     }
// }
//
//
