<?php

namespace Database\Seeders;

use App\Models\Poem;
use Illuminate\Database\Seeder;

class PoemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        Poem::factory()->count(10)->create();
    }
}
