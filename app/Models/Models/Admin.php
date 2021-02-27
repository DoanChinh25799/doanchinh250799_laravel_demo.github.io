<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Arr;

class Admin  extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $table = 'users';
    protected $guarded = ['*'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

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
