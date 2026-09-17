<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
#[Fillable(['title', 'description', 'image'])]
class Slide extends Model
{
      public $timestamps = false;
}
