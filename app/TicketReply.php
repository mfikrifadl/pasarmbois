<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TicketReply extends Model
{
    protected $table = 'public.ticket_reply';
    protected $primaryKey = 'ptr_id';
    const CREATED_AT = 'ptr_created_at';
    const UPDATED_AT = 'ptr_update_at';
    protected $guarded = [
        'ptr_id'
    ];
}
