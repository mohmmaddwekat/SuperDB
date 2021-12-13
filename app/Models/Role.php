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
    public function abilities()
    {
        return $this->belongsToMany(Ability::class, 'roles_abilities', 'role_id', 'ability_id', 'id', 'id');
    }

}
