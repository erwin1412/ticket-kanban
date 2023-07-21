<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;

    protected $fillable = [
        'banner'
    ];

    protected function banner(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => asset('/storage/banners/' . $value),
        );
    }
}
