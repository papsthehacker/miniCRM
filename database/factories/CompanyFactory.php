<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

class CompanyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Company::class;

    /**
     * Define the model's default state.
     *
     * @return array
     * @throws \Exception
     */
    public function definition()
    {
        return [
            'name'=>$this->faker->company,
            'logo'=>'https://picsum.photos/id/'.random_int(100,200).'/200/300',
            'email'=>$this->faker->companyEmail,
            'website'=>$this->faker->url

        ];
    }
}
