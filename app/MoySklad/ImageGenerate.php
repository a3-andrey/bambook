<?php

namespace App\MoySklad;

use Illuminate\Support\Facades\Storage;

trait ImageGenerate
{
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
        curl_setopt ($ch, CURLOPT_USERPWD, $this->login.':'.$this->password);
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

}
