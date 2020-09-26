<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ViewedProduct extends Model
{
    protected $table = 'product.viewed_product';
    protected $primaryKey = 'pvp_id';
    const CREATED_AT = 'pvp_created_at';
    const UPDATED_AT = 'pvp_update_at';

    protected $guarded = [
        'pvp_id'
    ];
    public function product()
    {
        return $this->belongsTo('App\Product', 'pvp_id_product', 'pp_id');
    }
}
