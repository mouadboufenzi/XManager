<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Article::factory(25)->create();
        \App\Models\Fournisseur::factory(25)->create();
        \App\Models\Client::factory(25)->create();
        \App\Models\Depot::factory(25)->create();
        \App\Models\AgentCommercial::factory(5)->create();
        \App\Models\Famille::factory(2)->create();
        \App\Models\Categorie::factory(3)->create();
    }
}
