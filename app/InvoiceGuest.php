<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InvoiceGuest extends Model
{
    use SoftDeletes;
    protected $table = 'transaction.invoice_guest';
    protected $primaryKey = 'tig_id';
    const CREATED_AT = 'tig_created_at';
    const UPDATED_AT = 'tig_update_at';
    const DELETED_AT = 'tig_delete_at';
    protected $guarded = [
        'tig_id'
    ];
    public function bank()
    {
        return $this->belongsTo('App\Bank');
    }
    public function guest()
    {
        return $this->belongsTo('App\Guest', 'tig_id_guest', 'pg_id');
    }
    public function invoiceStatus()
    {
        return $this->belongTo('App\InvoiceStatus', 'tig_id_status', 'tis_id');
    }
    public function city()
    {
        return $this->belongsTo('App\City', 'tig_id_city', 'pc_id');
    }
    public function province()
    {
        return $this->belongsTo('App\Province', 'tig_id_province', 'pp_id');
    }
    public function subdistrict() 
    {
        return $this->belongsTo('App\Subdistrict', 'tig_id_subdistrict', 'ps_id');
    }
    public function invoiceDetails()
    {
        return $this->hasMany('App\InvoiceDetailGuest', 'tidg_id_invoice', 'tig_id');
    }
}
