<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    use SoftDeletes;
    protected $table = 'transaction.invoice';
    protected $primaryKey = 'ti_id';
    const CREATED_AT = 'ti_created_at';
    const UPDATED_AT = 'ti_update_at';
    const DELETED_AT = 'ti_delete_at';

    protected $guarded = [
        'ti_id'
    ];

    public function statusInvoice()
    {
        return $this->belongsTo('App\InvoiceStatus');
    }
    public function bank()
    {
        return $this->belongsTo('App\Bank');
    }
    public function city()
    {
        return $this->belongsTo('App\City', 'ti_id_city', 'pc_id');
    }
    public function province()
    {
        return $this->belongsTo('App\Province', 'ti_id_province', 'pp_id');
    }
    public function subdistrict() 
    {
        return $this->belongsTo('App\Subdistrict', 'ti_id_subdistrict', 'ps_id');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function invoiceDetails()
    {
        return $this->hasMany('App\InvoiceDetail', 'tid_id_invoice', 'ti_id');
    }
}
