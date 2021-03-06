<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    protected $fillable = ['user_id', 'role', 'target_type', 'target_id'];

    public function target()
    {
        return $this->morphTo();
    }
}
