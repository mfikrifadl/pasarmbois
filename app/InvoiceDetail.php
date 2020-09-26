<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvoiceDetail extends Model
{
    protected $table = 'transaction.invoice_detail';
    protected $primaryKey = 'tid_id';

    protected $guarded = [
        'ti_id'
    ];
    public function invoice()
    {
        return $this->belongsTo('App\Invoice', 'tid_id_invoice', 'ti_id');
    }
    public function product()
    {
        return $this->belongsTo('App\Product', 'tid_id_product', 'pp_id');
    }
}
