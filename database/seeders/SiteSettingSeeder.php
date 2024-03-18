<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SiteSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SiteSetting::create([
            'name' => 'adress',
            'data' => 'Baku Azerbaijan no90'
        ]);

        SiteSetting::create([
            'name' => 'phone',
            'data' => '+994509823907'
        ]);

        SiteSetting::create([
            'name' => 'email',
            'data' => 'staghi@bk.ru'
        ]);


        SiteSetting::create([
            'name' => 'map',
            'data' => null
        ]);


    }
}
