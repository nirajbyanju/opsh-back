<?php

namespace App\Traits;

trait CastsCamelCaseAttributes
{

    public function getAttribute($key)
    {
        $key = \Illuminate\Support\Str::snake($key); 
        return parent::getAttribute($key);
    }

    public function setAttribute($key, $value)
    {
        $key = \Illuminate\Support\Str::snake($key); 
        return parent::setAttribute($key, $value);
    }

    public function attributesToArray()
    {
        $attributes = parent::attributesToArray();

        $camelCasedAttributes = [];
        foreach ($attributes as $key => $value) {
            $camelCasedAttributes[\Illuminate\Support\Str::camel($key)] = $value;
        }

        return $camelCasedAttributes;
    }
}
