<?php
namespace App\Services;

use App\Models\Image;
use App\MoySklad\ImageGenerate;
use Illuminate\Support\Arr;

use Illuminate\Support\Facades\Storage;
use Ixudra\Curl\Facades\Curl;

/**
 * @author A3 a3.andrey@yandex.ru
 * @copyright 8bit
 */
class MoySkladService
{
    use ImageGenerate;
    /**
     * @var string $login
     * @var string $password
     * @var string $url
     */
    public $login,$password,$url;

    const URL_PRODUCTS = "https://online.moysklad.ru/api/remap/1.2/entity/product";
    const URL_ASSORTMENT = "https://online.moysklad.ru/api/remap/1.2/entity/assortment";
    const URL_CATEGORY = "https://online.moysklad.ru/api/remap/1.2/entity/productfolder";
    const URL_MODIFIERS = "https://online.moysklad.ru/api/remap/1.2/entity/variant";



    public function __construct(){
        $this->login = config('moy_sklad.login');
        $this->password = config('moy_sklad.password');
    }

    /**
     * @param string $login
     * @param string $password
     * @return $this
     */
    public function getInstance(string $login, string $password){
        $this->login = $login;
        $this->password = $password;
        return $this;
    }

    /**
     * @param string|null $url
     * @return false|resource
     */
    protected function getClient(string $url){

        $ch = curl_init ();
        curl_setopt ($ch, CURLOPT_URL, $url);
        curl_setopt ($ch, CURLOPT_USERAGENT, 'cURL/php');
        curl_setopt ($ch, CURLOPT_USERPWD, $this->login.':'.$this->password);
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
        $resp =  curl_exec($ch);
        curl_close($ch);

        return $resp;

    }

    /**
     * @param string $imageUrl
     * @return mixed
     */
    public function getImage(string $imageUrl){

        $imagesResp = [];
        //Получаем ссылки на изображения
        $curlHandle = $this->getClient($imageUrl);

        $images = json_decode($curlHandle);

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

    /**
     * @return array
     */
    public function getProducts(){
        $curl = $this->getClient(self::URL_PRODUCTS);
        $resp = json_decode($curl);
        return isset($resp->rows) ? $resp->rows : [];
    }

    /**
     * @return array
     */

    public function getModifiers(){

        $curl = $this->getClient(self::URL_MODIFIERS);
        $resp = json_decode($curl);

        return isset($resp->rows) ? $resp->rows : [];
    }

    /**
     * @return array
     */
    public function getAssortment(){

        $curl = $this->getClient(self::URL_ASSORTMENT);
        $resp = json_decode($curl);

        return isset($resp->rows) ? $resp->rows : [];
    }

    /**
     * @return array
     */
    public function getCategory(){

        $curl = $this->getClient(self::URL_CATEGORY);
        $resp = json_decode($curl);

        return isset($resp->rows) ? $resp->rows : [];
    }


}

