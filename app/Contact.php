<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
    use SoftDeletes;
    protected $table = 'public.contact';
    protected $primaryKey = 'pc_id';
    const CREATED_AT = 'pc_created_at';
    const UPDATED_AT = 'pc_update_at';
    const DELETED_AT = 'pc_delete_at';

    protected $guarded = [
        'pc_id'
    ];
}
