<?php


namespace App\Repositories;

use App\Models\CategoryTranslations;
use App\Models\PersonCategory;

class PersonCategoryRepository extends BaseRepository
{
    public function __construct()
    {
        $this->model = new PersonCategory();
    }

    public function index($request)
    {
        $lang = $request['translates']??'oz';
        $name = $request['name'];
        if (isset($request->name) && !empty($request->name)) {
            $this->model = $this->model->whereHas('translates',function ($q) use ($name){
              $q->where('name', 'ilike','%'.$name.'%');
            });
        }

        $this->model = $this->model->whereHas('translates', function ($q) use ($lang){
            $q->where('translates', $lang);
        });

        return $this->model->with(['translates' => function($q) use ($lang){
            $q->where('translates', $lang);
        }])->orderBy('created_at', 'desc')->paginate($this->limit);
    }

    public function findById($id, $request)
    {
        $lang = $request->translates;
        return $this->model->with(['translates' => function($q) use ($lang){
            $q->where('translates', $lang);
        }])->findOrFail($id);
    }

    public function create($data)
    {
        $model = $this->model->create([
            'type' => $data['menu'],
            'status' => $data['status'],
            'order' => $data['order']
        ]);

        CategoryTranslations::create([
            'name' => $data['name'],
            'translates' => $data['translates'],
            'category_id' => $model->id
        ]);

        if ($model) {
            return $model;
        }
        return  false;
    }

    public function update($data, $id)
    {
        $model = $this->model->whereId($id)->first();
        $status = $data['status'] == 1?true:false;
        $model->update([
            'type' => $data['menu'],
            'status' => $status,
            'order' => $data['order']
        ]);

        $model->translates()->updateOrCreate([
           'translates' => $data['translates']
        ],[
            'name' => $data['name'],
            'category_id' => $model->id
        ]);
        return $model;

    }

    public function delete($id)
    {
        $model = $this->model->whereId($id);
        if ($model->delete()) {
            return true;
        }
        return false;
    }
}
