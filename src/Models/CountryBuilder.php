<?php

namespace Lwwcas\LaravelCountries\Models;

use Illuminate\Support\Str;
use Lwwcas\LaravelCountries\Models\CountryRegion;

class CountryBuilder
{
    public static function create(Array $countries, String $region_slug, String $lang) :Void
    {


        return;
    }

    public static function createRegion(Array $regions, String $lang): Void
    {
        foreach ($regions as $region) {
            CountryRegion::create([
                $lang => [
                    'slug' => Str::slug($region, '-'),
                    'name' => $region,
                ],
            ]);
        }

        return;
    }
}
