<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $table = 'contact';

    protected $fillable = [
        'title',
        'description',
        'weekday_hours',
        'weekend_hours',
        'instagram',
        'whatsapp',
        'email',
        'map_url',
    ];
}
