<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    protected $table = 'public.user_detail';
    protected $primaryKey = 'pud_id';
    const CREATED_AT = 'pud_created_at';
    const UPDATED_AT = 'pud_update_at';

    protected $guarded = [
        'pud_id'
    ];
    public function user()
    {
        return $this->BelongsTo('App\User', 'pud_id_user', 'pu_id');
    }
}
