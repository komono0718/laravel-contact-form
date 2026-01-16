<?php

namespace Database\Factories;

use App\Models\Contact;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContactFactory extends Factory
{
    protected $model = Contact::class;

    public function definition()
    {
        return [
            'last_name'   => $this->faker->lastName,
            'first_name'  => $this->faker->firstName,
            'gender'      => $this->faker->numberBetween(1, 3),
            'email'       => $this->faker->unique()->safeEmail,
            'tel'         => $this->faker->numerify('090########'),
            'address'     => $this->faker->address,
            'building'    => $this->faker->optional()->secondaryAddress,
            'category_id' => Category::inRandomOrder()->first()->id,
            'detail'      => $this->faker->realText(50),
        ];
    }
}