<?php

namespace Floac\Ukrpost\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static array regions(string $region_name = null)
 * @method static array districts(string $district_ua = null, int $region_id = null)
 * @method static array cities(string $city_ua = null, int $district_id = null, int $region_id = null)
 * @method static array streets(string $street_ua = null, int $city_id = null, int $district_id = null, int $region_id = null)
 * @method static array houses(int $street_id, string $housenumber = null)
 * @method static array postOffices(string $zip_code = null, int $street_id = null, int $city_id = null, int $district_id = null, int $region_id = null)
 * @method static array postOfficesOpenHours(string $zip_code, int $post_office_id = null)
 * @method static array postOfficesByGeolocation(float $lat, float $lng, int $maxdistance = 1)
 * @method static array citiesByPostcode(string $postcode)
 * @method static array getAddressesByPostcode(string $postcode)
 */
class Dictionary extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'ukrpost-dictionary';
    }
}
