<?php

namespace Database\Factories;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{

    protected $model = Task::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $input = array("todo", "done" );
        $rand_keys = array_rand($input, 1);

        return [
            'title' => $this->faker->name(20),
            'description' => $this->faker->text,
            'status' =>  $input[$rand_keys],
            'priority' => random_int(1, 5),
            'user_id' => User::get()->random()->id,
            'parent_id' => '',
        ];
    }
}
