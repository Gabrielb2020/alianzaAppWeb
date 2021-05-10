<?php

namespace App\Casts;

use App\Models\Employee;
use Illuminate\Contracts\Database\Eloquent\Castable;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Support\Carbon;
use InvalidArgumentException;

class BirthData implements Castable
{

    public function __construct(
        public Carbon $date,
        public string $city,
        public string $country
    ) {
    }

    public function toJson(): string
    {
        return json_encode([
            'date' => $this->date->toString(),
            'city' => $this->city,
            'country' => $this->country,
        ]);
    }

    public static function fromJson(string $json): BirthData
    {
        $birthData = (array) json_decode($json, false);

        validator($birthData, [
            'date' => 'string|required',
            'city' => 'string|required',
            'country' => 'string|required',
        ])->validate();

        return new BirthData(
            date: now()->parse($birthData['date']),
            city: $birthData['city'],
            country: $birthData['country']
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
                return BirthData::fromJson($value);
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
                if (!($value instanceof BirthData))
                    throw new InvalidArgumentException('The given value must be an instance of BirthData');

                return $value->toJson();
            }
        };
    }
}

