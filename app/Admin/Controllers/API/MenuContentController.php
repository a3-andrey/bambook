<?php

namespace App\Admin\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\MenuItem;

class MenuContentController extends Controller
{
    public $parent = 0;

   public function update(MenuItem $menuItem)
   {
       $arrTree = json_decode(request('_order'),true);

       function tree($arr,$children = 0)
       {
           foreach($arr as $key=>$arrItem){
               $menuItem = MenuItem::find($arrItem['id']);
               $menuItem->sort = $key;
               $menuItem->parent_id = $children;
               $menuItem->save();
               if (array_key_exists('children', $arrItem)) {
                   tree($arrItem['children'],$arrItem['id']);
               }
           }
       }
       tree($arrTree);
       return json_decode(request('_order'),true);
   }

   public function delete(MenuItem $menuItem){
       return $menuItem->delete();
   }
}
