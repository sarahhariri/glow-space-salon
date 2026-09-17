<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['user_id', 'type', 'amount', 'sender_name', 'recipient_name', 'recipient_email', 'message', 'code', 'status'])]
class GiftCard extends Model
{
    
    protected function casts(): array
    {
        return [
            'amount' => 'decimal:2',
        ];
    }
}
