<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Value extends Model
{
    use SoftDeletes;
    protected $table = 'public.site_value';
    protected $primaryKey = 'psv_id';
    const CREATED_AT = 'psv_created_at';
    const UPDATED_AT = 'psv_update_at';
    const DELETED_AT = 'psv_delete_at';
    protected $dates = ['deleted_at'];

    protected $guarded = [
        'psv_id'
    ];
}
