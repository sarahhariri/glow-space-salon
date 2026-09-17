<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable([  'user_id',
        'service_id',
        'team_member_id',
        'appointment_date',
        'appointment_time',
        'customer_name',
        'customer_email',
        'customer_phone',
        'notes',
        'status',])]
class Appointment extends Model
{
        protected function casts(): array
    {
        return [
            'appointment_date' => 'date',
        ];
    }


    public function service()
{
    return $this->belongsTo(Service::class);
}

public function teamMember()
{
    return $this->belongsTo(TeamMember::class);
}

public function user()
{
    return $this->belongsTo(User::class);
}
}
