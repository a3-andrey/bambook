<?php
namespace App\Services;
use App\Models\Page;
use Illuminate\Support\Facades\Route;

class PageService
{
    public $route_name;
    public $seo_title;
    public $seo_description;
    public $seo_keywords;
    public $page;

    public function __construct()
    {
        $this->route_name = Route::currentRouteName();

        $this->page = Page::where('slug',$this->route_name)->first();

        $this->seo_title =  $this->page ? $this->page->seo_title : config('site.title','Site Title');

        $this->seo_description =  $this->page ? $this->page->seo_description : config('site.description','Site Description');

        $this->seo_keywords =  $this->page ? $this->page->seo_keywords : config('site.keywords','Site keywords');

    }

    public function getID($id){
       return Page::find($id);
    }

    public function setRouteName($route_name){
        return $this->page;
    }

}
