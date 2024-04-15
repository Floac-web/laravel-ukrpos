<?php

namespace Floac\Ukrpost\AddressClassifier;

class Dictionary
{
    public function __construct(
        public Api $api,
        public Router $router
    ) 
    {
    }

   // Отримання переліку областей.
    public function regions(string $region_name = null): array
    {
        $query = compact('region_name');

        return $this->api->fetch($this->router->regions($query));
    }

    // Отримання переліку районів.
    public function districts(string $district_ua = null, int $region_id = null): array
    {
        $query = compact('district_ua', 'region_id');
 
        return $this->api->fetch($this->router->districts($query));
    }

    //  Отримання переліку населених пунктів.
    public function cities(string $city_ua = null, int $district_id = null, int $region_id = null): array
    {
        $query = compact('city_ua', 'district_id', 'region_id');
        
        return $this->api->fetch($this->router->cities($query));
    }

    // Отримання переліку вулиць населених пунктів міст.
    public function streets(string $street_ua = null, int $city_id = null, int $district_id = null, int $region_id = null): array
    {
        $query = compact('street_ua', 'city_id', 'district_id', 'region_id');
        
        return $this->api->fetch($this->router->streets($query));
    }

    // Отримання переліку будинків вулиць.
    public function houses(int $street_id = null, string $housenumber = null): array
    {
        $query = compact('street_id', 'housenumber');

        return $this->api->fetch($this->router->houses($query));
    }

    // Отримання інформації про поштове відділення
    public function postOffices(string $zip_code = null, int $street_id = null, int $city_id = null, int $district_id = null, int $region_id = null): array
    {
        $query = [
            'pi' => $zip_code,
            'poStreetId' => $street_id,
            'poCityId' => $city_id,
            'poDistrictId' => $district_id,
            'poRegionId' => $region_id,
        ];

        return $this->api->fetch($this->router->postOffices($query));
    }

    // Отримання інформації про графік роботи поштового відділення.
    public function postOfficesOpenHours(string $zip_code = null, int $post_office_id = null): array
    {
        $query = [
            'pc' => $zip_code,
            'id' => $post_office_id
        ];

        return $this->api->fetch($this->router->postOfficesOpenHours($query));
    }

    // Отримання інформації про найближчі поштові відділення.
    public function postOfficesByGeolocation(float $lat, float $long, int $maxdistance = 1): array
    {
        $query = compact('lat', 'long', 'maxdistance');

        return $this->api->fetch($this->router->postOfficesByGeolocation($query));
    }

    // Отримання інформації про населений пункт за індексом.
    public function citiesByPostcode(string $postcode): array
    {
        $query = compact('postcode');

        return $this->api->fetch($this->router->citiesByPostcode($query));
    }

    // Отримання адресної інформації за індексом.
    public function addressesByPostcode(string $postcode): array
    {
        $query = compact('postcode');

        return $this->api->fetch($this->router->addressesByPostcode($query));
    }
}
