<?php

namespace Floac\Ukrpost\AddressClassifier;

class Router
{
    public string $uri;

    public function __construct()
    {
        $this->uri = config('ukrpost.address_classifier');
    }

    private function url(string $endpoint, array $query = []): string
    {
        $query = array_merge($query, ['lang' => 'uk']);

        return $this->uri . '/' . $endpoint . '?' . http_build_query($query);
    }

    public function regions(array $query): string
    {
        return $this->url('get_regions_by_region_ua', $query);
    }

    public function districts(array $query): string
    {
        return $this->url('get_districts_by_region_id_and_district_ua', $query);
    }

    public function cities(array $query): string
    {
        return $this->url('get_city_by_region_id_and_district_id_and_city_ua', $query);
    }

    public function streets(array $query): string
    {
        return $this->url('get_street_by_region_id_and_district_id_and_city_id_and_street_ua', $query);
    }

    public function houses(array $query): string
    {
        return $this->url('get_addr_house_by_street_id', $query);
    }

    public function postOffices(array $query): string
    {
        return $this->url('get_postoffices_by_postindex', $query);
    }

    public function postOfficesOpenHours(array $query): string
    {
        return $this->url('get_postoffices_openhours_by_postindex', $query);
    }

    public function postOfficesByGeolocation(array $query): string
    {
        return $this->url('get_postoffices_by_geolocation', $query);
    }

    public function citiesByPostcode(array $query): string
    {
        return $this->url('get_city_details_by_postcode', $query);
    }

    public function addressesByPostcode(array $query): string
    {
        return $this->url('get_address_by_postcode', $query);
    }
}
