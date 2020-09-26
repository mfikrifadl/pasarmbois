<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    protected $table = 'public.guest';
    protected $primaryKey = 'pg_id';
    const CREATED_AT = 'pg_created_at';
    const UPDATED_AT = 'pg_update_at';
    protected $guarded = [
        'pg_id'
    ];
    public function invoiceGuests()
    {
        return $this->hasMany('App\InvoiceGuest');
    }
}
