<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GetInTouch extends Model
{
    protected $table = 'get_in_touch_quoc_anh_nguyen';
    
    protected $fillable = [
        'name',
        'email',
        'country',
        'companyname',
        'choose_support',
        'project_details',
    ];
}