<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InvoiceStatus extends Model
{
    use SoftDeletes;
    protected $table = 'transaction.invoice_status';
    protected $primaryKey = 'tis_id';
    const CREATED_AT = 'tis_created_at';
    const UPDATED_AT = 'tis_update_at';
    const DELETED_AT = 'tis_delete_at';
    protected $guarded = [
        'tis_id'
    ];
    public function invoiceGuests()
    {
        return $this->hasMany('App\InvoiceGuest','tig_id_status', 'tis_id');
    }
}
