<?php

namespace Database\Factories;

use App\Models\Poem;
use Illuminate\Database\Eloquent\Factories\Factory;

class PoemFactory extends Factory
{
    protected $model = Poem::class;

    public function definition(){
        $title = ['The Exeter Book', 'For the Time Being', 'In the Seven Woods', 'Land of Unlikeness', 'Bloodhound',
            'Summer of Love', 'Mother Goose', 'Place of Love', 'Songs of Innocence', 'As I see it'
        ];

        return [
            'title' => $title[array_rand($title)],
            'content' => $this->faker->paragraph(3),
            'writer' => $this->faker->name
        ];
    }
}
