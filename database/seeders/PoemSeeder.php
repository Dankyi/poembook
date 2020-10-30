<?php

namespace Database\Seeders;

use App\Models\Poem;
use Illuminate\Database\Seeder;

class PoemSeeder extends Seeder
{
    public function run(){
        Poem::factory()->count(10)->create();
    }
}
