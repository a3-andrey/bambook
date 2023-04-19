<?php

function url_generator($url)
{
    $uri = str_replace('/','',$url);

   return config('app.url').'/'.$uri;
}
