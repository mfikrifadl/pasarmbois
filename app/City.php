<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $table = 'public.city';
    protected $primaryKey = 'pc_id';
    const CREATED_AT = 'pc_created_at';
    const UPDATED_AT = 'pc_update_at';

    public function invoices()
    {
        return $this->hasMany('App\Invoice', 'ti_id_city', 'pc_id');
    }
    public function invoiceGuest()
    {
        return $this->hasMany('App\InvoiceGuest', 'tig_id_city', 'pc_id');
    }
    public function subdistricts()
    {
        return $this->hasMany('App\Subdistrict', 'ps_id_city', 'pc_id');
    }
    public function province()
    {
        return $this->belongsto('App\Province', 'pc_id_province', 'pp_id');
    }
}
