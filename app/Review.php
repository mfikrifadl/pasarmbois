<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Review extends Model
{
    use SoftDeletes;
    protected $table = 'product.review';
    protected $primaryKey = 'pr_id';
    const CREATED_AT = 'pr_created_at';
    const UPDATED_AT = 'pr_update_at';
    const DELETED_AT = 'pr_delete_at';
    protected $dates = ['deleted_at'];
    protected $guarded = [
        'pr_id'
    ];
    public function user()
    {
        return $this->belongsTo('App\User', 'pr_id_user', 'pu_id');
    }
    public function userDetail()
    {
        return $this->belongsTo('App\UserDetail', 'pr_id_user', 'pud_id_user');
    }
    public function product()
    {
        return $this->belongsTo('App\Product', 'pr_id_product', 'pp_id');
    }
    public function invoice()
    {
        return $this->belongsTo('App\Invoice', 'pr_code_order', 'ti_code_order');
    }
}
