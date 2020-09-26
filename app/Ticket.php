<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ticket extends Model
{
    use SoftDeletes;
    protected $table = 'public.ticket';
    protected $primaryKey = 'pt_id';
    const CREATED_AT = 'pt_created_at';
    const UPDATED_AT = 'pt_update_at';
    const DELETED_AT = 'pt_delete_at';
    protected $dates = ['deleted_at'];
    protected $guarded = [
        'pt_id'
    ];
}
