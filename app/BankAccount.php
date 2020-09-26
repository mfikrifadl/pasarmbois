<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BankAccount extends Model
{
    use SoftDeletes;
    protected $table = 'transaction.bank_account';
    protected $primaryKey = 'tba_id';
    const CREATED_AT = 'tba_created_at';
    const UPDATED_AT = 'tba_update_at';
    const DELETED_AT = 'tba_delete_at';

    protected $guarded = [
        'tba_id'
    ];
}
