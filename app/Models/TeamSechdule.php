<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['team_member_id',
        'day_of_week',
        'start_time',
        'end_time',
        'is_working',])]
class TeamSechdule extends Model
{
    
    protected function casts(): array
    {
        return [
            'is_working' => 'boolean',
        ];
    }

    public function teamMember()
    {
        return $this->belongsTo(TeamMember::class);
    }
}
