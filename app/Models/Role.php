<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable =[
        'name',
    ];

        //one to many
        public function users()
        {
            return $this->hasMany(User::class, 'role_id', 'id');
        }
    //many to many
    public function permissions()
    {
        return $this->belongsToMany(Permissions::class, 'roles_permissions', 'role_id', 'permission_id', 'id', 'id');
    }

}
