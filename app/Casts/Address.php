<?php

namespace App\Casts;

use App\Models\Employee;
use Illuminate\Contracts\Database\Eloquent\Castable;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use InvalidArgumentException;

class Address implements Castable
{

    public function __construct(
        public string $line_1,
        public string $postal_code,
        public string $city,
        public string $house_number,
        public string $country,
        public ?string $line_2 = null,
    ) {
    }

    public function toJson(): string
    {
        return json_encode($this);
    }

    public static function fromJson(string $json): Address
    {
        $address = (array) json_decode($json, false);

        validator($address, [
            'line_1' => 'string|required',
            'line_2' => 'string',
            'city' => 'string|required',
            'house_number' => 'string|required',
            'postal_code' => 'string|required',
            'country' => 'string|required',
        ])->validate();

        return new Address(
            line_1: $address['line_1'],
            line_2: $address['line_2'],
            house_number: $address['house_number'],
            postal_code: $address['postal_code'],
            city: $address['city'],
            country: $address['country']
        );
    }


    public static function castUsing(array $arguments)
    {
        return new class implements CastsAttributes
        {
            /**
             * Cast the given value.
             *
             * @param  \Illuminate\Database\Eloquent\Model  $model
             * @param  string  $key
             * @param  mixed  $value
             * @param  array  $attributes
             * @return mixed
             */
            public function get($model, $key, $value, $attributes)
            {
                return Address::fromJson($value);
            }

            /**
             * Prepare the given value for storage.
             *
             * @param  \Illuminate\Database\Eloquent\Model  $model
             * @param  string  $key
             * @param  mixed  $value
             * @param  array  $attributes
             * @return mixed
             */
            public function set($model, $key, $value, $attributes)
            {
                if (!($value instanceof Address))
                    throw new InvalidArgumentException('The given value must be an instance of Address');

                return $value->toJson();
            }
        };
    }
}
