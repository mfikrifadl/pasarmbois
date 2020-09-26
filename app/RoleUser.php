<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoleUser extends Model
{
    protected $table = 'public.role_user';
    protected $primaryKey = 'pru_id';
    const CREATED_AT = 'pru_created_at';
    const UPDATED_AT = 'pru_update_at';
    protected $guarded = [
        'pru_id'
    ];

    public function users()
    {
        return $this->hasMany('App\User');
    }
}
