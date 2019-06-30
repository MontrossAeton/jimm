<?php

function count_pending($model)
{
    return count($model::where('status', 'Pending')->get());
}

function current_user()
{
    return auth()->user();
}