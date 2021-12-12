<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permissions extends Model
{
    use HasFactory;

    public $timestamps = false;


    protected $fillable =
    [
        'code',
        'explain'
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'roles_permissions');
    }
}
