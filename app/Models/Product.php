<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'img_1',
        'img_2',
        'img_3'
    ];

    protected $hidden   = [
        'pivot'
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
}
