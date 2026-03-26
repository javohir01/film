<?php


namespace App\Http\Filter;


use App\Models\News;
use Illuminate\Http\Request;

class NewFilter
{
    private $request;
    private $news;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->news = new News();
    }

    public function filter()
    {
        if (isset($this->request['name_oz']) && !empty($this->request['name_oz'])) {
            $name = $this->request['name_oz'];
            $this->news = $this->news->whereHas('translations', function ($q) use ($name){
                $q->where('name', 'ilike', '%'.$name.'%');
            });
        }

        if (isset($this->request['description_oz']) && !empty($this->request['description_oz'])) {
            $this->news = $this->news->where('description_oz', 'ilike', '%' . $this->request['description_oz'] . '%');
        }

        if (isset($this->request['category_id']) && !empty($this->request['category_id'])) {
            $this->news = $this->news->where('category_id', $this->request['category_id']);
        }
        if (isset($this->request['translates']) && !empty($this->request['translates']))
        {
            $lang = $this->request['translates'];
            $this->news = $this->news->whereHas('translations', function ($q) use ($lang){
               $q->where('translate', $lang);
            });
        }
        return $this->news->with('translations');
    }

}
