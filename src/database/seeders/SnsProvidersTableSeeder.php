<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SnsProvidersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      $providers = [
        ['provider_name' => 'Twitter'],
        ['provider_name' => 'Spotify'],
        ['provider_name' => 'Apple Music'],
        ['provider_name' => 'Instagram'],
      ];

      DB::table('sns_providers')->insert($providers);
    }
}
