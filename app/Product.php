<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $table = 'product.product';
    protected $primaryKey = 'pp_id';
    const CREATED_AT = 'pp_created_at';
    const UPDATED_AT = 'pp_update_at';
    const DELETED_AT = 'pp_delete_at';
    protected $guarded = [
        'pp_id'
    ];

    public function category()
    {
        return $this->belongsTo('App\Category', 'pp_id_category', 'pc_id');
    }
    public function invoiceDetails()
    {
        return $this->hasMany('App\InvoiceDetail', 'tid_id_product', 'pp_id');
    }
    public function invoiceDetailGuest()
    {
        return $this->hasMany('App\InvoiceDetailGuest', 'tidg_id_product', 'pp_id');
    }
    public function measurement()
    {
        return $this->belongsTo('App\Measurement', 'pp_id_measurement', 'pm_id');
    }
    public function store()
    {
        return $this->belongsTo('App\Store');
    }
    public function images()
    {
        return $this->hasMany('App\ImgProduct', 'pip_token', 'pp_token', 'pip_token_backup', 'pp_token_backup');
    }
    public function reviews()
    {
        return $this->hasMany('App\Review', 'pr_id_product', 'pp_id');
    }
}
