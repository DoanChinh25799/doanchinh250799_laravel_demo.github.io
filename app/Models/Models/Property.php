<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class Property extends Model
{
    use HasFactory;
    protected $table = 'properties';
    protected $guarded = [''];

    public function products(){
        return $this->belongsToMany(Product::class);
    }
}
