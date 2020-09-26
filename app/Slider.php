<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Slider extends Model
{
    use SoftDeletes;
    protected $table = 'public.slider_site';
    protected $primaryKey = 'pss_id';
    const CREATED_AT = 'pss_created_at';
    const UPDATED_AT = 'pss_update_at';
    const DELETED_AT = 'pss_delete_at';

    protected $guarded = [
        'pss_id'
    ];
}
