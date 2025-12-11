<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $cats = [
            ['name'=>'Kopi','slug'=>'kopi','description'=>'Minuman kopi dan varian espresso.'],
            ['name'=>'Makanan Berat','slug'=>'makanan-berat','description'=>'Menu makanan utama yang mengenyangkan.'],
            ['name'=>'Makanan Ringan','slug'=>'makanan-ringan','description'=>'Cemilan dan jajanan ringan.'],
            ['name'=>'Minuman','slug'=>'minuman','description'=>'Minuman non-kopi (teh, jus, minuman dingin).'],
        ];

        foreach ($cats as $c) {
            DB::table('categories')->updateOrInsert(
                ['slug'=>$c['slug']],
                ['name'=>$c['name'],'description'=>$c['description'],'updated_at'=>now(),'created_at'=>now()]
            );
        }
    }
}
