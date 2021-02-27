<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $guarded = [''];

    const STATUS_PUBLIC = 1;
    const STATUS_PRIVATE = 0;

    const HOT_ON = 1;
    const HOT_OFF = 0;

    protected $status = [
        1 => [
            'name' => 'Public',
            'class' => 'badge-primary'
        ],
        0 => [
            'name' => 'Private',
            'class' => 'badge-warning'
        ]
    ];

    protected $hot = [
        1 => [
            'name' => 'Nổi bật',
            'class' => 'badge-success'
        ],
        0 => [
            'name' => 'Không nổi bật',
            'class' => 'badge-secondary'
        ]
    ];

    public function getStatus()
    {
        return Arr::get($this->status, $this->p_active, '[N\A]');
    }

    public function getHot()
    {
        return Arr::get($this->hot, $this->p_hot, '[N\A]');
    }

    public function getcategory(){
        return $this->belongsTo(Category::class, 'p_category_id');
    }

    public function properties(){
        return $this->belongsToMany(Property::class,'proproes','id','id',);
    }
}
