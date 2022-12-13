<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       Setting::create([
            'site_name'=>'Meskine Mohamed',
            'contact_email'=>'med@gmail.com',
            'address'=>'Morocco , Agadir'
        ]);
    }
}
