<?php

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\Castable;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Support\Carbon;
use InvalidArgumentException;

class IdentityCard implements Castable
{

    public function __construct(
        public string $type,
        public string $number
    ) {
    }

    public function toJson(): string
    {
        return json_encode($this);
    }

    public static function fromJson(string $json): IdentityCard
    {
        $identityCard = (array) json_decode($json, false);

        validator($identityCard, [
            'type' => 'string|required',
            'number' => 'string|required',
        ])->validate();

        return new IdentityCard(
            type: $identityCard['type'],
            number: $identityCard['number']
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
                return IdentityCard::fromJson($value);
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
                if (!($value instanceof IdentityCard))
                    throw new InvalidArgumentException('The given value must be an instance of IdentityCard');

                return $value->toJson();
            }
        };
    }
}
