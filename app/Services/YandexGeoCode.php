<?php


namespace App\Services;


class YandexGeoCode
{
    /**
     * @param string $addr
     * @return false|string[]|null
     * Принимает адрес строка для геокодирования
     */
    public function get(string $addr){
        $params = array(
            'geocode' => $addr, // адрес
            'format'  => 'json',      // формат ответа
            'apikey'     => '7e0cf4f9-21de-40f6-963c-f26d5ac27768',     // ваш api key
        );

        $response = file_get_contents('http://geocode-maps.yandex.ru/1.x/?'.http_build_query($params, '', '&') );
        $response = json_decode($response);
        if (count($response->response->GeoObjectCollection->featureMember) > 0)
        {
            return explode(' ',$response->response->GeoObjectCollection->featureMember[0]->GeoObject->Point->pos);
        }
        else
        {
            return null;
        }
    }
}
