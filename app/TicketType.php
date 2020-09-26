<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Model;

class TicketType extends Model
{
    use SoftDeletes;
    protected $table = 'public.ticket_type';
    protected $primaryKey = 'ptt_id';
    const CREATED_AT = 'ptt_created_at';
    const UPDATED_AT = 'ptt_update_at';
    const DELETED_AT = 'ptt_delete_at';
    protected $dates = ['deleted_at'];
    protected $guarded = [
        'ptt_id'
    ];
}
