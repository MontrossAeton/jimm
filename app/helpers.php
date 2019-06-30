<?php

function count_pending($haha)
{
    $model = app("App\Model\{$haha}");
    dd($model);
    return count('\App\\'.$haha::where('status', 'Pending')->get());
}