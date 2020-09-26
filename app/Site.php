<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    protected $table = 'public.site';
    protected $primaryKey = 'ps_id';
    const CREATED_AT = 'ps_created_at';
    const UPDATED_AT = 'ps_update_at';
    protected $guarded = [
        'ps_id'
    ];
    public function city()
    {
        return $this->belongsto('App\City', 'ps_id_city', 'pc_id');
    }
    public function province()
    {
        return $this->belongsto('App\Province', 'ps_id_province', 'pp_id');
    }
    public function subdistrict()
    {
        return $this->belongsto('App\Subdistrict', 'ps_id_subdistrict', 'ps_id');
    }
}
