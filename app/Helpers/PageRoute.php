<?php

function page_route($id)
{
    return route(\App\Models\Page::find($id)->slug);
}
