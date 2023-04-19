<?php

function price_format_number($number,$decimal=0){
    return number_format($number, $decimal, ',', ' ');
}


