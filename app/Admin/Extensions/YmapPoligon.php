<?php

namespace App\Admin\Extensions;

use Encore\Admin\Form\Field;

class YmapPoligon extends Field
{
    protected $view = 'admin.ymap-poligon';

    protected static $css = [
        '/packages/css/poligon.css',
    ];

    protected static $js = [
        'https://api-maps.yandex.ru/2.1/?lang=ru_RU&amp;apikey=7e0cf4f9-21de-40f6-963c-f26d5ac27768',
        '/packages/js/poligon.js',
        '/packages/js/jquery.simple-color.min.js',

    ];

    public function render()
    {
        $this->script;
        return parent::render();
    }
}
