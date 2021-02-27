<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class Account extends Model
{
    use HasFactory;
    protected $table = 'users';
    protected $guarded = [''];

    const STATUS_PUBLIC = 1;
    const STATUS_PRIVATE = 0;

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

    public function getStatus()
    {
        return Arr::get($this->status, $this->active, '[N\A]');
    }
}
