<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    protected $table = 'transaction.bank';
    protected $primaryKey = 'tb_id';
    const CREATED_AT = 'tb_created_at';
    const UPDATED_AT = 'tb_update_at';

    public function invoices()
    {
        return $this->hasMany('App\Invoice');
    }
    public function invoiceGuest()
    {
        return $this->hasMany('App\InvoiceGuest');
    }
}
