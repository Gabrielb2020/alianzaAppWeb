<?php

namespace Database\Factories;

use App\Casts\Address;
use App\Casts\BirthData;
use App\Casts\IdentityCard;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class EmployeeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Employee::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'telephone' => $this->faker->phoneNumber,
            'birth_data' => new BirthData(
                date: Carbon::parse($this->faker->date()),
                city: $this->faker->city,
                country: $this->faker->country
            ),
            'address' => new Address(
                line_1: $this->faker->address,
                line_2: $this->faker->secondaryAddress,
                house_number: $this->faker->PhoneNumber,
                postal_code: $this->faker->postcode,
                city: $this->faker->city,
                country: $this->faker->country
            ),
            'identity_card' => new IdentityCard(
                type: $this->faker->countryCode,
                number: $this->faker->numberBetween(1000000, 9999999)
            )
        ];
    }
}
