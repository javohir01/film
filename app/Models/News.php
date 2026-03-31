<?php

namespace App\Models;

use App\Traits\GlobalSearch;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;
    use GlobalSearch;
    protected $guarded = [];


    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function category()
    {
        $lang = request('translates', 'oz');
        return $this->belongsTo(PersonCategory::class)->select('name_'.$lang.' as name','id');
    }


    public function getContentAttribute($value)
    {
        $appUrl = config('app.url').'/';
         $img = preg_replace_callback('/(<img\s+[^>]*src=")\/?(uploads\/[^"]+)(")/i', function ($matches) use ($appUrl) {
             // $matches[1] – rasmning nisbiy yoʻli: "uploads/images/example.jpg"
             return '<img src="' . $appUrl . $matches[2] . '"';
         }, $value);
         return $img;
    }

    public function translations()
    {
        return $this->hasMany(NewTranslations::class, 'news_id');
    }

}
