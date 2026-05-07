<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewTranslations extends Model
{
    use HasFactory;
    protected $fillable = ['name','description','content','news_id','translate'];
    public $timestamps = false;


    public function news()
    {
        return $this->hasMany(News::class, 'id');
    }
}
