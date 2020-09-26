<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Province extends Model
{
    use SoftDeletes;
    protected $table = 'public.province';
    protected $primaryKey = 'pp_id';
    const CREATED_AT = 'pp_created_at';
    const UPDATED_AT = 'pp_update_at';
    const DELETED_AT = 'pp_delete_at';

    public function invoices()
    {
        return $this->hasMany('App\Invoice', 'ti_id_province', 'pp_id');
    }
    public function invoiceGuest()
    {
        return $this->hasMany('App\InvoiceGuest', 'tig_id_province', 'pp_id');
    }
    public function cities()
    {
        return $this->hasMany('App\City', 'pc_id_province', 'pp_id');
    }
    public function sites()
    {
        return $this->hasMany('App\Site', 'ps_id_province', 'pp_id');
    }
}
