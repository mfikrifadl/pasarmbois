<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TemplateEmail extends Model
{
    use SoftDeletes;
    protected $table = 'public.template_email';
    protected $primaryKey = 'pte_id';
    const CREATED_AT = 'pte_created_at';
    const UPDATED_AT = 'pte_updated_at';
    const DELETED_AT = 'pte_delete_at';
    protected $dates = ['deleted_at'];

    protected $guarded = [
        'pte_id'
    ];
}
