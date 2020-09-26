<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class About extends Model
{
    use SoftDeletes;
    protected $table = 'public.site_about';
    protected $primaryKey = 'psa_id';
    const CREATED_AT = 'psa_created_at';
    const UPDATED_AT = 'psa_update_at';
    const DELETED_AT = 'psa_delete_at';

    protected $guarded = [
        'psa_id'
    ];
}
