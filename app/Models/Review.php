<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['user_id', 'name', 'rating', 'comment', 'is_approved'])]
class Review extends Model
{
    protected function casts(): array
    {
        return [
            'rating' => 'integer',
            'is_approved' => 'boolean',
        ];
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
