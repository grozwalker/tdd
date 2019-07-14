<?php

function create($class, $attribute = [], $quantity = null)
{
    return factory($class, $quantity)->create($attribute);
}


function make($class, $attribute = [], $quantity = null)
{
    return factory($class, $quantity)->make($attribute);
}