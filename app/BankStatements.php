<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BankStatements extends Model
{
    use SoftDeletes;
    protected $table = 'transaction.bank_statements';
    protected $primaryKey = 'tbs_id';
    const CREATED_AT = 'tbs_created_at';
    const UPDATED_AT = 'tbs_update_at';
    const DELETED_AT = 'tbs_delete_at';

    protected $guarded = [
        'tbs_id'
    ];
}
