<?php
require __DIR__ . '/../vendor/autoload.php';

// Bootstrap the framework
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Category;
use App\Models\Menu;

// List categories
$categories = Category::all();
if($categories->count() == 0){
    echo "No categories found.\n";
    exit(1);
}

echo "Existing categories:\n";
foreach($categories as $cat){
    echo "- ID: {$cat->id} | Name: {$cat->name}\n";
}

// Helper to find category by name (case-insensitive contains)
function findCategory($needle){
    $c = Category::where('name','like','%'.$needle.'%')->first();
    return $c;
}

// Prepare items to insert: title, price, description, category name search term
$toInsert = [
    ['name' => 'Snack Keripik Keju', 'price' => '18k', 'description' => 'Keripik renyah dengan taburan keju gurih.', 'category' => 'Snack'],
    ['name' => 'Maincourse Ayam Bumbu', 'price' => '45k', 'description' => 'Ayam dengan bumbu khas, disajikan hangat.', 'category' => 'Maincourse'],
    ['name' => 'Signature Erthree Blend', 'price' => '32k', 'description' => 'Minuman signature kami dengan campuran rasa khas.', 'category' => 'Signature'],
];

foreach($toInsert as $item){
    $cat = findCategory($item['category']);
    if(!$cat){
        echo "Category matching '{$item['category']}' not found. Skipping '{$item['name']}'.\n";
        continue;
    }

    // Check if similar menu exists
    $exists = Menu::where('name', $item['name'])->first();
    if($exists){
        echo "Menu '{$item['name']}' already exists (ID: {$exists->id}).\n";
        continue;
    }

    $menu = new Menu();
    $menu->name = $item['name'];
    $menu->description = $item['description'];
    $menu->price = $item['price'];
    $menu->category_id = $cat->id;
    // leave image null
    $menu->save();
    echo "Inserted menu '{$menu->name}' into category '{$cat->name}' (ID: {$cat->id}).\n";
}

echo "Done.\n";
