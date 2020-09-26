<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvoiceDetailGuest extends Model
{
    protected $table = 'transaction.invoice_detail_guest';
    protected $primaryKey = 'tidg_id';

    protected $guarded = [
        'tig_id'
    ];
    public function invoice()
    {
        return $this->belongsTo('App\InvoiceGuest', 'tidg_id_invoice', 'tig_id');
    }
    public function product()
    {
        return $this->belongsTo('App\Product', 'tidg_id_product', 'pp_id');
    }
    public function codeOrder()
    {
        return $this->hasMany('App\InvoiceGuest', 'tig_code_order', 'tidg_code_order');
    }
}
