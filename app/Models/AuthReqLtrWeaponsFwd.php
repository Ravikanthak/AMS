<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuthReqLtrWeaponsFwd extends Model
{
    use HasFactory;

    protected $fillable = ['req_fwd_to_status', 'comment_approve'];
}
