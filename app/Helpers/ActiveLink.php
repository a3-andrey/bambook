<?php

/**
 * @param string $uri
 * @param string $class
 * @return string
 * @return null
 */
function active_link(string $uri,$class = 'active')
{
    $not_first_slash = ltrim($uri, '/');
    if(request()->is($uri)
        || request()->is('/'.$uri)
        || request()->is($not_first_slash)
    ){
        return $class;
    }
    return null;
}
