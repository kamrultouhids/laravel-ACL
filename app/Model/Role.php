<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;


class Role extends Model
{
    protected $table = 'role';
    protected $primaryKey = 'role_id';

    protected $fillable = [
        'role_id', 'role_name'
    ];


}
