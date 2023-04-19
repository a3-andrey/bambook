<div class="form-group {!! !$errors->has($label) ?: 'has-error' !!}">

    <label for="{{$id}}" class="col-sm-2 control-label">{{$label}}</label>

    <div class="col-sm-6">
        @include('admin::form.error')
        <table border="0" cellspacing="3" cellpadding="3">
            <tr>
                <td width="800px">
                    <div id="map" style="width:800px; height:600px"></div>
                    <div id="geometry"/></div>
                    </td>
                    <td width="250px" valign="top">
                        <div id="formpolygon">
                            <strong>Форма ввода параметров многоугольника</strong><br />
                            <br />Цвет заливки: <input type="text" id="color_polygon" value="#0000ff" /><br />
                            <br />Уровень прозрачности заливки:<br /><input type="text" id="fillopacity_polygon" value="1">
                            <br />Толщина линии обводки: <input type="text" name="width_line" id="width_line" size="2" value="5" /><br />
                            <br />Цвет линии обводки:<br /><input type="text" id="color_line" value="#cc3333">
                            <br />Уровень прозрачности обводки:<br /><input type="text" id="opacity_line" value="1">
                            <p><input type="button" value="Добавить" id="addPolygon"/>
                                <input type="button" value="Удалить" id="dellPolygon"/>
                            </p>
                            <p><input type="button" value="Завершить редактирование" id="stopEditPolygon"/></p>
                        </div>
                    </td>
                    </tr>
    </table>


        <input  value="{{ old($column, $value ) }}"  class="form-control ymap"
                name="{{$name}}" placeholder="{{ trans('admin::lang.input') }} {{$label}}" {!! $attributes !!} >

    </div>
</div>
<script>

    // Как только будет загружен API и готов DOM, выполняем инициализацию
    ymaps.ready(init);

    var polygon;

    function init () {

    $('#color_polygon').simpleColor();

    $('#color_line').simpleColor();

    var myMap = new ymaps.Map("map", {
    center: [56.317655,43.994362],
    zoom: 15
    });

    //Добавляем элементы управления
    myMap.controls
    .add('zoomControl');

    @if(!empty(old($column, $value )))

        var color_polygon = $('#color_polygon').attr('value');
        var fillopacity_polygon = $('#fillopacity_polygon').attr('value');

        var width_line = $('#width_line').attr('value');
        var color_line = $('#color_line').attr('value');
        var opacity_line = $('#opacity_line').attr('value');

        polygon = new ymaps.Polygon({!! old($column, $value ) !!},

            {},
            {

                fillColor: color_polygon,

                strokeColor: color_line,

                opacity: fillopacity_polygon,

                strokeOpacity: opacity_line,

                strokeWidth: width_line
            });

        myMap.geoObjects.add(polygon);
        polygon.editor.startDrawing();

        $('#addPolygon').attr('disabled', true);
    @endif
    // Обработка нажатия на кнопку Добавить
    $('#addPolygon').click(
    function () {

    $('#stopEditPolygon').attr('disabled', false);


    var color_polygon = $('#color_polygon').attr('value');
    var fillopacity_polygon = $('#fillopacity_polygon').attr('value');

    var width_line = $('#width_line').attr('value');
    var color_line = $('#color_line').attr('value');
    var opacity_line = $('#opacity_line').attr('value');

    polygon = new ymaps.Polygon([[]],

    {},
    {

    fillColor: color_polygon,

    strokeColor: color_line,

    opacity: fillopacity_polygon,

    strokeOpacity: opacity_line,

    strokeWidth: width_line
    });

    myMap.geoObjects.add(polygon);
    polygon.editor.startDrawing();

    $('#addPolygon').attr('disabled', true);

    });

    // Обработка нажатия на кнопку Завершить редактирование
    $('#stopEditPolygon').click(
    function () {

    polygon.editor.stopEditing();
    printGeometry(polygon.geometry.getCoordinates());
    $('#stopEditPolygon').attr('disabled', true);

    });


    // Обработка нажатия на кнопку Удалить
    $('#dellPolygon').click(
    function () {

    myMap.geoObjects.remove(polygon);
    $('#geometry').html('');
    $('#addPolygon').attr('disabled', false);
    });

    }



    // Выводит массив координат геообъекта в <div id="geometry">
        function printGeometry (coords) {
        var coordinate = stringify(coords)
        $('#geometry').html('Координаты: ' + coordinate );
        $('[name="{{$name}}"]').val(coordinate);


        function stringify (coords) {
        var res = '';
        if ($.isArray(coords)) {
        res = '[ ';
        for (var i = 0, l = coords.length; i < l; i++) {
        if (i > 0) {
        res += ', ';
        }
        res += stringify(coords[i]);
        }
        res += ' ]';
        } else if (typeof coords == 'number') {
        res = coords.toPrecision(6);
        } else if (coords.toString) {
        res = coords.toString();
        }

        return res;
        }
        }


 </script>
