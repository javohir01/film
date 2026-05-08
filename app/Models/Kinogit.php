<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kinogit extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function translates()
    {
        return $this->hasMany(KinogitTranslatins::class, 'kinogit_id');
    }



}
