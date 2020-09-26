<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subdistrict extends Model
{
    protected $table = 'public.subdistrict';
    protected $primaryKey = 'ps_id';
    const CREATED_AT = 'ps_created_at';
    const UPDATED_AT = 'ps_update_at';

    public function invoices()
    {
        return $this->hasMany('App\Invoice', 'ti_id_subdistrict', 'ps_id');
    }
    public function invoiceGuest()
    {
        return $this->hasMany('App\InvoiceGuest', 'tig_id_subdistrict', 'ps_id');
    }
    public function city()
    {
        return $this->belongsTo('App\City', 'ps_id_city', 'pc_id');
    }
}
