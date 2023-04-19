<?php

/**
 * Laravel-admin - admin builder based on Laravel.
 * @author z-song <https://github.com/z-song>
 *
 * Bootstraper for Admin.
 *
 * Here you can remove builtin form field:
 * Encore\Admin\Form::forget(['map', 'editor']);
 *
 * Or extend custom form field:
 * Encore\Admin\Form::extend('php', PHPEditor::class);
 *
 * Or require js and css assets:
 * Admin::css('/packages/prettydocs/css/styles.css');
 * Admin::js('/packages/prettydocs/js/main.js');
 *
 */
use App\Admin\Extensions\Ymap;
use Encore\Admin\Form;
use App\Admin\Extensions\YmapPoligon;
use App\Admin\Extensions\Form\CKEditor;
Use Encore\Admin\Admin;


Encore\Admin\Form::forget(['map', 'editor']);
Form::extend('ckeditor', CKEditor::class);
Form::extend('ymap', Ymap::class);
Form::extend('ymapPoligon', YmapPoligon::class);
Admin::css('/vendor/laravel-admin/css/style.css');

Admin::navbar(function (\Encore\Admin\Widgets\Navbar $navbar) {

    $navbar->right('<li>
  
<a href="/admin/refresh-cash" class="btn btn-warning btn-sm " title="Сбросить кэш"><i class="fa fa-refresh"></i><span class="hidden-xs">&nbsp;Сбросить кэш</span></a>
   
</li>');


});
