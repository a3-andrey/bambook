<?php

function textarea_br($message)
{
    return empty($message) ? null : nl2br($message);
}
