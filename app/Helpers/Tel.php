<?php

function tel(string $phone=null)
{
    $tel =  preg_replace("/[^,.0-9]/", '', $phone);
    return "tel:{$tel}";
}
