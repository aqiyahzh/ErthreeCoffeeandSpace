<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

try{
    $cols = DB::select('SHOW COLUMNS FROM staff');
    foreach($cols as $c){
        echo $c->Field . " | " . $c->Type . " | " . $c->Null . " | " . $c->Default . PHP_EOL;
    }
}catch(Exception $e){
    echo "Error: " . $e->getMessage() . PHP_EOL;
}
