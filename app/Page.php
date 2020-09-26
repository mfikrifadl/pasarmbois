<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model
{
    use SoftDeletes;
    protected $table = 'public.page';
    protected $primaryKey = 'pp_id';
    const CREATED_AT = 'pp_created_at';
    const UPDATED_AT = 'pp_update_at';
    const DELETED_AT = 'pp_delete_at';

    protected $guarded = [
        'pp_id'
    ];
}
