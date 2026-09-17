<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['salon_name',
        'email',
        'phone',
        'address',
        'instagram',
        'facebook',
        'whatsapp',])]
class Setting extends Model
{
    //
}
