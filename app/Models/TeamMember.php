<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
#[Fillable(['name', 'specialization', 'bio', 'image', 'is_active', 'instagram'])]
class TeamMember extends Model
{
    function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
    public function schedules()
    {
        return $this->hasMany(TeamSechdule::class);
    }
    public function services()
    {
        return $this->belongsToMany(Service::class);
    }
}
