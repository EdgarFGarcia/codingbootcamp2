<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Item;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Item::create([
            'name'          => "Sinigang",
            "category_id"   => 1
        ]);

        Item::create([
            'name'          => "Tapsilog",
            "category_id"   => 1
        ]);

        Item::create([
            'name'          => "Siomai",
            "category_id"   => 1
        ]);

        Item::create([
            'name'          => "Pajamas",
            "category_id"   => 2
        ]);

        Item::create([
            'name'          => "Sando",
            "category_id"   => 2
        ]);

        Item::create([
            'name'          => "Shorts",
            "category_id"   => 2
        ]);
    }
}
