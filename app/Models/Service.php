<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['name', 'category', 'description', 'price', 'duration', 'image', 'is_active'])]
class Service extends Model
{
    protected function casts(): array{
    return [
        'price' =>'decimal:2',
        'is_active' => 'boolean',
    ];
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
    public function teamMembers()
    {
        return $this->belongsToMany(TeamMember::class);
    }
}
