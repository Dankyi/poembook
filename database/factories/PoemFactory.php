<?php

namespace Database\Factories;

use App\Models\Poem;
use Illuminate\Database\Eloquent\Factories\Factory;

class PoemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Poem::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(){
//        $title = ['The Exeter Book', 'For the Time Being', 'In the Seven Woods', 'Land of Unlikeness', 'Bloodhound',
//            'Summer of Love', 'Mother Goose', 'Place of Love', 'Songs of Innocence', 'As I see it', 'Basic Heart', 'Child Whispers',
//            'State of Love and Trust', 'The Man with the Blue Guitar', 'The Place of Love', 'The Snow Man', 'Vision in Spring',
//            'The Enormous Room', 'A Boy\'s Will', 'Dachshund', 'A Man in the Divided Sea', 'A Witness Tree', 'Chills and Fever'
//        ];

        $title = ['The Exeter Book', 'For the Time Being', 'In the Seven Woods', 'Land of Unlikeness', 'Bloodhound',
            'Summer of Love', 'Mother Goose', 'Place of Love', 'Songs of Innocence', 'As I see it'
        ];

        return [
            'title' => $title[array_rand($title)], // Generate random title from the title array defined above
            'content' => $this->faker->paragraph(3), // Generate a fake 3 paragraph sentences
            'writer' => $this->faker->name // Generate a fake name
        ];
    }
}
