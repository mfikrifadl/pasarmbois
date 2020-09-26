<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    protected $table = 'public.user';
    protected $primaryKey = 'pu_id';
    const CREATED_AT = 'pu_created_at';
    const UPDATED_AT = 'pu_update_at';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'pu_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getAuthPassword()
    {
        return $this->pu_password;
    }
    public function role()
    {
        return $this->BelongsTo('App\RoleUser', 'pu_id_role', 'pru_id');
    }
    public function userDetails()
    {
        return $this->hasMany('App\UserDetail', 'pud_id_user', 'pu_id');
    }
    public function invoices()
    {
        return $this->hasMany('App\Invoice');
    }
    public function hasAnyRoles($roles)
    {
        if ($this->role()->where('pru_title', $roles)->first()) {
            return true;
        }
        return false;
    }
    public function hasRole($role)
    {
        if ($this->role()->where('pru_title', $role)->first()) {
            return true;
        }
        return false;
    }
}
