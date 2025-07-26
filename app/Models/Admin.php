<?php

namespace App\Models;

use Encore\Admin\Auth\Database\Administrator;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class Admin extends Administrator
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'admins';

    protected $fillable = [
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // 追加：Laravel-Adminにemailでログインさせるために必須
    public function getAuthIdentifierName()
    {
        return 'email';
    }
}
