<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Faq extends Model
{
    use SoftDeletes;
    protected $table = 'public.site_faq';
    protected $primaryKey = 'psf_id';
    const CREATED_AT = 'psf_created_at';
    const UPDATED_AT = 'psf_update_at';
    const DELETED_AT = 'psf_delete_at';

    protected $guarded = [
        'psf_id'
    ];
}
