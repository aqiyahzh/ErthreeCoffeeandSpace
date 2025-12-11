<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Category;

$categories = Category::with('menus')->get();
if(!$categories->count()){
    echo "No categories found.\n";
    exit(0);
}
foreach($categories as $cat){
    echo "Category: {$cat->id} - {$cat->name} (menus: {$cat->menus->count()})\n";
    foreach($cat->menus as $m){
        echo "  - [{$m->id}] {$m->name} | {$m->price}\n";
    }
}
