<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    protected $table = 'product.store';
    protected $primaryKey = 'ps_id';
    const CREATED_AT = 'ps_created_at';
    const UPDATED_AT = 'ps_update_at';

    public function products()
    {
        return $this->hasMany('App\Product');
    }
    protected $guarded = [
        'ps_id'
    ];
}
