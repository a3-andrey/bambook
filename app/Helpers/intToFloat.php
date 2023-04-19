<?php

function intToFloat($int){
    $val = substr($int, 0, -2).'.'.substr($int, strlen($int)-2);
    return (float)$val;
}
