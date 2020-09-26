<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Help extends Model
{
    use SoftDeletes;
    protected $table = 'public.site_help';
    protected $primaryKey = 'psh_id';
    const CREATED_AT = 'psh_created_at';
    const UPDATED_AT = 'psh_update_at';
    const DELETED_AT = 'psh_delete_at';

    protected $guarded = [
        'psh_id'
    ];
}
