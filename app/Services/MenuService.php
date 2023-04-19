<?php
namespace App\Services;
use App\Models\Menu;

class MenuService
{
    public $menu;

    public static $strReplaceSymbols = [
        '/',
        '...'
    ];

    public function get($slug = null)
    {
       $this->menu =  Menu::where('slug',$slug)->firstOr(function () {
            return abort(403,'Меню не найдено');
        });
        return $this->menu->menus;
    }

    public  function all(){
        return Menu::all();
    }

    public static function currentLInk($link)
    {
        if($link !== '/'){
            $link = str_replace(self::$strReplaceSymbols,'',$link);
        }

        return request()->is("{$link}*") ? 'active' : null;
    }

}
