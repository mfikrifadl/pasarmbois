<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Measurement extends Model
{
    use SoftDeletes;
    protected $table = 'product.measurement';
    protected $primaryKey = 'pm_id';
    const CREATED_AT = 'pm_created_at';
    const UPDATED_AT = 'pm_update_at';
    const DELETED_AT = 'pm_delete_at';

    public function products()
    {
        return $this->hasMany('App\Product');
    }
}
