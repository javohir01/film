<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AphorismTranslations extends Model
{
    use HasFactory;
    protected $fillable = ['aphorism_id', 'full_name', 'description', 'calendar','translates','created_at','updated_at'];
    protected $casts = ['calendar' => 'array', 'translates' => 'string'];
}
