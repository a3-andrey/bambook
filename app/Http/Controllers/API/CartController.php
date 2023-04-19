<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Models\Product;
use Cart;


class CartController
{


    public function add()
    {

        $product = Product::find(\request('product'));



        return response()->json([
            'product_id' => $product->id,
            'status' => 'success',
            'message' => 'Успешно добавлено'
        ]);

    }

    public function update(){

        Cart::update(\request('product'), [
            'quantity' => [
                'relative' => false,
                'value' =>  \request('qtu'),
            ]
        ]);

        return $this->getTotal();
    }



    public function destroy(){

        $product = Product::find(\request('product'));

        Cart::remove($product->id);

        return $this->total();
    }

    public function total(){
        return response()->json($this->getTotal());
    }

    private function getTotal(){
        return [
            'count' => Cart::getTotalQuantity(),
            'total' => Cart::getTotal()
        ];
    }
}



//public function changeCartplus($id){
//
//    $Products = Product::get()->where('id', '=', $id);
//
//    foreach($Products as $item){
//        $Product = $item;
//    }
//    Cart::update($Product->id, array(
//        'quantity' => +1
//    ));
//}
//public function changeCartminus($id){
//
//    $Products = Product::get()->where('id', '=', $id);
//
//    foreach($Products as $item){
//        $Product = $item;
//    }
//    Cart::update($Product->id, array(
//        'quantity' => -1
//    ));
//
//}
