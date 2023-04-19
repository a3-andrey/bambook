<div class="form-group {!! !$errors->has($label) ?: 'has-error' !!}">

    <label for="{{$id}}" class="col-sm-2 control-label">{{$label}}</label>

    <div class="col-sm-6">

        @include('admin::form.error')
        <p class="header">Кликните для метки на карте</p>
        <div style="width: 100%; height: 400px;" id="map"></div>
        <input style="display: none" value="{{ old($column, implode(";", $value) ) }}"  class="form-control ymap"
               id="ymap" name="{{$name}}" placeholder="{{ trans('admin::lang.input') }} {{$label}}" {!! $attributes !!} >
    </div>
</div>
<script>
    if ( $("#map").length > 0) {
        ymaps.ready(init);
        var myMap;
        function init () {

            myMap = new ymaps.Map("map", {
                center: [{{ config('shop.y_map','55.751574,37.573856') }}],
                zoom: 11,
                controls: ['smallMapDefaultSet']
            }, {
                balloonMaxWidth: 200,
                searchControlProvider: 'yandex#search'
            });
            if(document.getElementById("ymap").value !== '') {
                var points = document.getElementById("ymap").value.split(';');
                addPoint(points[0],points[1])
            }
            // Обработка события, возникающего при щелчке
            // левой кнопкой мыши в любой точке карты.
            // При возникновении такого события откроем балун.
            myMap.events.add('click', function (e) {
                if (!myMap.balloon.isOpen()) {
                    myMap.geoObjects.removeAll()
                    var coords = e.get('coords');
                    addPoint(coords[0].toPrecision(6),coords[1].toPrecision(6))
                    // Добавляем метку на карту
                    myGeoObject = new ymaps.GeoObject();
                    myMap.geoObjects.add(
                        new ymaps.Placemark(
                            [ coords[0].toPrecision(6) , coords[1].toPrecision(6) ],
                            {
                                balloonContent: '',
                            },
                            {
                                // Опции.
                                iconLayout: "default#image",
                                iconImageHref: "/packages/img/location.png",
                                // Размеры метки.
                                iconImageSize: [27, 27],
                                iconImageOffset: [-15, -27],
                            }
                        )
                    );

                    // Добавляем координаты в инпут
                    document.getElementById('ymap').value = coords[0].toPrecision(6)+';'+coords[1].toPrecision(6)


                }
                else {
                    myMap.balloon.close();
                }
            });

            // Обработка события, возникающего при щелчке
            // правой кнопки мыши в любой точке карты.
            // При возникновении такого события покажем всплывающую подсказку
            // в точке щелчка.
            myMap.events.add('contextmenu', function (e) {
                myMap.hint.open(e.get('coords'), 'Кто-то щелкнул правой кнопкой');
            });

            // Скрываем хинт при открытии балуна.
            myMap.events.add('balloonopen', function (e) {
                myMap.hint.close();
            });
        }

        function addPoint(start, end)
        {
            myGeoObject = new ymaps.GeoObject();
            myMap.geoObjects.add(
                new ymaps.Placemark(
                    [ start , end ],
                    {
                        balloonContent: '',
                    },
                    {
                        // Опции.
                        iconLayout: "default#image",
                        iconImageHref: "/packages/img/location.png",
                        // Размеры метки.
                        iconImageSize: [27, 27],
                        iconImageOffset: [-15, -27],
                    }
                )
            );
        }
    }



</script>
