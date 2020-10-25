<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImgProduct extends Model
{
    protected $table = 'product.img_product';
    protected $primaryKey = 'pip_id';
    const CREATED_AT = 'pip_created_at';
    const UPDATED_AT = 'pip_updated_at';
    protected $guarded = [
        'pip_id'
    ];
}
