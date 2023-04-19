<?php

namespace App\Services;

use App\Models\Image;
use App\MoySklad\Components\CustomerOrder;
use Evgeek\Moysklad\Filter;
use Illuminate\Support\Facades\Storage;

class MoySklad_1_2_Service
{
    public $ms;

    const ENTITY = 'entity';

    const URL_PRODUCTS = "product";
    const ASSORTMENT_METHOD = "assortment";
    const CATEGORY_METHOD = "productfolder";
    const IMAGES_METHOD = "images";
    const MODIFIERS_METHOD = "variant";

    public function __construct(){
        $this->ms = new \Evgeek\Moysklad\MoySklad(
            [config('moy_sklad.login'), config('moy_sklad.password')],
            \Evgeek\Moysklad\Enums\Format::OBJECT ,
            new \Evgeek\Moysklad\Http\GuzzleSender()
        );
    }

    public function updateConterpatry($id,$data){
      return   $this->ms->endpoint('entity')
            ->method('counterparty')
            ->byId($id)
            ->update($data);
    }

    public function getCounterparty($id){
        $this->ms->endpoint('entity')
            ->method('counterparty')
            ->byId($id)
            ->get();
    }

    public function getCategories(){
      $resp = $this->ms->endpoint(self::ENTITY)
            ->method(self::CATEGORY_METHOD)
            ->send('GET');
      return $resp->rows;
    }

    public function getAssortments(){
        $product = $this->ms->entity()->assortment();
        $product = $product->expand('images');
        $resp = $product->get();
        return $resp->rows;
    }

    public function getProducts(){
        $resp = $this->ms->endpoint(self::ENTITY)
            ->method(self::URL_PRODUCTS)
            ->send('GET');
        return $resp->rows;
    }

    public function getLinkMeta(object $meta){
        $id = explode('/',$meta->href);

        $resp = $this->ms->endpoint(self::ENTITY)
            ->method($meta->type)
            ->byId($id)
            ->send('GET');
    }

    public function getProduct($id){
       if(is_object($id)){
           $url = $id->meta->uuidHref;
           $parts = parse_url($url);
           parse_str($parts['fragment'], $query);
           $first = current($query);
           $id = $first;
       }

        $resp = $this->ms->endpoint(self::ENTITY)
            ->method(self::URL_PRODUCTS)
            ->byId($id)
            ->send('GET');
        return $resp;
    }

    public function getModifiers(){
        $resp = $this->ms->endpoint(self::ENTITY)
            ->method(self::MODIFIERS_METHOD)
            ->send('GET');
        return $resp->rows;
    }

    public function getModifier($id){
        $resp = $this->ms->endpoint(self::ENTITY)
            ->method(self::MODIFIERS_METHOD)
            ->byId($id)
            ->send('GET');
        return $resp;
    }

    /**
     * @param string $imageUrl
     * @return mixed
     */
    public function getImage(string $imageUrl){
        $imagesResp = [];
        //Получаем ссылки на изображения
        $images = $this->getClient($imageUrl);
//        if(!$images){
//            return [];
//        }
        foreach ($images->rows as $image){
            //Проверяем есть ли такое изображение
            $imageM = Image::where('title',$image->title)->where('size',$image->size)->first();
            //Если нет, то создаем
            if($image->miniature->type == "image" && $imageM === null){
                $imageM = new Image();
                $imageM->updated = $image->updated;
                $imageM->title = $image->title;
                $imageM->size = $image->size;
                $imageM->image = $this->donloadImage($image->meta->downloadHref,$image->filename,'moysklad');
                $imageM->save();
            }
            $imagesResp[] = $imageM;
        }

        return $imagesResp;
    }

    protected function donloadImage($url,$name,$prefix=null){
        $folder = 'images';
        if($prefix===null){
            $path = $folder.'/'.$name;
        }else{
            $path = $folder.'/'.$prefix.'/'.$name;
        }

        $ch = curl_init ();
        curl_setopt ($ch, CURLOPT_URL, $url);
        curl_setopt ($ch, CURLOPT_USERAGENT, 'cURL/php');
        curl_setopt ($ch, CURLOPT_USERPWD, config('moy_sklad.login').':'.config('moy_sklad.password'));
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt ($ch, CURLOPT_UNRESTRICTED_AUTH, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_exec($ch);
        $resp_url = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
        curl_close($ch);

        $contents = file_get_contents($resp_url);

        Storage::put($path, $contents);

        return $path;
    }
    /**
     * @param string|null $url
     * @return false|resource
     */
    public function getClient(string $url){

        $ch = curl_init ();
        curl_setopt ($ch, CURLOPT_URL, $url);
        curl_setopt ($ch, CURLOPT_USERAGENT, 'cURL/php');
        curl_setopt ($ch, CURLOPT_USERPWD, config('moy_sklad.login').':'.config('moy_sklad.password'));
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
        $resp =  curl_exec($ch);
        curl_close($ch);

        return  json_decode($resp);

    }

    public function getOrganization(){
        $responece = $this->ms->endpoint('entity')
            ->method('organization')
            ->send('GET');

        return $this->getFirstRecord($responece);
    }
    /**
     * @param Filter $filter
     * @return false|mixed
     * @throws \Evgeek\Moysklad\Exceptions\ApiException
     * @throws \Evgeek\Moysklad\Exceptions\FormatException
     * @throws \Evgeek\Moysklad\Exceptions\InputException
     */
    public function searchCounterparty(Filter $filter){
        $counterparty = $this->ms->endpoint('entity')
            ->method('counterparty')
            ->filter($filter)
            ->limit(1)
            ->send('GET');
        return $this->getFirstRecord($counterparty);
    }

    /**
     * @param array $data
     * @return array|object|string
     * @throws \Evgeek\Moysklad\Exceptions\ApiException
     * @throws \Evgeek\Moysklad\Exceptions\ConfigException
     * @throws \Evgeek\Moysklad\Exceptions\FormatException
     */
    public function createCounterparty(array $data){

        return $this->ms->endpoint('entity')
            ->method('counterparty')
            ->create($data);
    }

    private function getFirstRecord($records){
        if($records && count($records->rows)>0){
            return $records->rows[0];
        }
        return false;
    }

    public function createCustomerOrder(){
        return new CustomerOrder($this->ms);
    }
}
