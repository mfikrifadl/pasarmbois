<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QrCodeM extends Model
{
    use SoftDeletes;
    protected $table = 'product.qrcode';
    protected $primaryKey = 'pq_id';
    const CREATED_AT = 'pq_created_at';
    const UPDATED_AT = 'pq_update_at';
    const DELETED_AT = 'pq_delete_at';
    protected $guarded = [
        'pq_id'
    ];
    public function city()
    {
        return $this->belongsto('App\City', 'pq_id_city', 'pc_id');
    }
    public function province()
    {
        return $this->belongsto('App\Province', 'pq_id_province', 'pp_id');
    }
    public function subdistrict()
    {
        return $this->belongsto('App\Subdistrict', 'pq_id_subdistrict', 'ps_id');
    }
    public function product()
    {
        return $this->belongsto('App\Product', 'pq_id_product', 'pp_id');
    }
}
