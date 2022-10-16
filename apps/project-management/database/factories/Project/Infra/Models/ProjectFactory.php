<?php

namespace Database\Factories\Project\Infra\Models;

use App\Types\ProjectStatus;
use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Factories\Factory;
use Project\Infra\Models\Project;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    protected $model = Project::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title'       => $this->faker->name() . 'のお仕事',
            'description' => $this->faker->realText(100),
            'status'   => $this->faker->randomElement(
                (collect(ProjectStatus::cases())->map(function ($value, $key) {
                    return $value->value;
                }))->toArray()
            ),
            'created_at'  => CarbonImmutable::now(),
        ];
    }
}
