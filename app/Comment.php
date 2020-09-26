<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use SoftDeletes;
    protected $table = 'product.comment';
    protected $primaryKey = 'pc_id';
    const CREATED_AT = 'pc_created_at';
    const UPDATED_AT = 'pc_update_at';
    const DELETED_AT = 'pc_delete_at';

    protected $guarded = [
        'pc_id'
    ];
    public function product()
    {
        return $this->belongsto('App\Product', 'pc_id_product', 'pp_id');
    }
    public function store()
    {
        return $this->belongsto('App\Store', 'pc_id_shop', 'ps_id');
    }
    public function user()
    {
        return $this->belongsto('App\User', 'pc_id_user', 'pu_id');
    }
    public function userDetail()
    {
        return $this->belongsto('App\UserDetail', 'pc_id_user', 'pud_id_user');
    }
}
