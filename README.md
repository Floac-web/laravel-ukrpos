## Встановлення
```
composer require floac/laravel-ukrpost
```

## Реалізовано
Доступний функціонал:
- [Адресний класифікатор](#address-classifier)
    - [regions](#get-regions) - Отримання переліку областей.
    - [districts](#get-districts) - Отримання переліку районів.
    - [cities](#get-cities) - Отримання переліку населених пунктів.
    - [streets](#get-streets) - Отримання переліку вулиць.
    - [houses](#get-houses) - Отримання переліку будинків вулиць.
    - [post offices](#get-post-offices) - Отримання інформації про поштове відділення.
    - [post offices open hours](#get-post-offices-open-hours) - Отримання інформації про графік роботи поштового відділення.
    - [post offices by geolocation](#get-post-offices-by-geolocation) - Отримання інформації про найближчі поштові відділення.
    - [city by postcode](#get-city-by-postcode) - Отримання інформації про населений пункт за індексом.
    - [address by postcode](#get-address-by-postcode) - Отримання адресної інформації за індексом.

### Address classifier

#### Get regions
Отримання переліку областей

```
Floac\Ukrpost\Facades\Dictionary::regions(string $region_ua = null);
```

#### Get districts
Отримання переліку районів
```
Floac\Ukrpost\Facades\Dictionary::districts(string $district_ua = null, int $region_id = null);
```

#### Get cities
Отримання переліку населених пунктів
```
Floac\Ukrpost\Facades\Dictionary::cities(string $city_ua = null, int $district_id = null, int $region_id = null);
```
#### Get streets
Отримання переліку вулиць
```
Floac\Ukrpost\Facades\Dictionary::streets(string $street_ua = null, int $city_id = null, int $district_id = null, int $region_id = null);
```
#### Get houses
Отримання переліку будинків вулиць
```
Floac\Ukrpost\Facades\Dictionary::houses(int $street_id, string $housenumber = null);
```
#### Get post offices
Отримання інформації про поштове відділення
```
Floac\Ukrpost\Facades\Dictionary::postOffices(string $zip_code = null, int $street_id = null, int $city_id = null, int $district_id = null, int $region_id = null);
```
#### Get post offices open hours
Отримання інформації про графік робОти поштового відділення
```
Floac\Ukrpost\Facades\Dictionary::postOfficesOpenHours(string $zip_code, int $post_office_id = null);
```
#### Get post offices by geolocation
Отримання інформації про найближчі поштові відділення
```
Floac\Ukrpost\Facades\Dictionary::postOfficesByGeolocation(float $lat, float $long, int $maxdistance = 1);
```
#### Get city by postcode
Отримання інформації про населений пункт за індексом
```
Floac\Ukrpost\Facades\Dictionary::citiesByPostcode(string $postcode);
```
#### Get address by postcode
Отримання адресної інформації за індексом
```
Floac\Ukrpost\Facades\Dictionary::addressesByPostcode(string $postcode);
```

