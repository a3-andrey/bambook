<?php

function youtubeLink($link)
{
    parse_str($link, $output);
    if(count($output) >0){
        return '//img.youtube.com/vi/'.array_shift($output).'/mqdefault.jpg';
    }
    return null;
}

