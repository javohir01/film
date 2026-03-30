<?php


namespace App\Repositories;


use App\Http\Filter\NewFilter;
use App\Models\News;
use App\Models\TelegramUser;
use App\Traits\ImageUploads;
use App\Traits\TelegramMessage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Telegram\Bot\Api;
use Telegram\Bot\Exceptions\TelegramResponseException;
use Telegram\Bot\FileUpload\InputFile;
use Telegram\Bot\Keyboard\Keyboard;
use Telegram\Bot\Laravel\Facades\Telegram;
use App\Services\TelegramServices;

class NewsRepository extends BaseRepository
{
    use ImageUploads;
    use TelegramMessage;
    protected $telegram;
    public function __construct(TelegramServices $telegramServices)
    {
        $this->model = new News();
        $this->telegram = $telegramServices;
    }

    public function index($request)
    {
        $filter = new NewFilter($request);
        $filter = $filter->filter();
        return $filter->with('category')->orderBy('id', 'desc')->paginate($this->limit)->appends($request->query());
    }

    public function findById($id, $translates)
    {
        $model = $this->model->whereId($id)->first();
        $model->load(['translations' => function($q) use ($translates) {
            $q->where('translate', $translates);
        }]);
        return $model;
    }

    public function create($data)
    {
        $model = $this->model->create([
            'slug' => Str::slug($data['name']),
            'category_id' => $data['category_id'],
            'status' => $data['status'],
            'image' => $this->uploads($data['images'], 'news'),
            'telegram_status' => $data['telegram_status'] ?? false
        ]);

        $model->translations()->create([
            'name' => $data['name'],
            'description' => $data['description'],
            'content' => contentByDomDocment($data['content'], 'news'),
            'translate' => $data['translates'],
        ]);

        try {
            if ($model->telegram_status) {
                $url = explode('/', $model->images);
                $last = array_pop($url);
                $image_path = storage_path('app/public/news/'.$last);
                $caption = <<<TEXT
                🎬: $model->name_oz
                🆕: $model->descripton_oz

                👉 @kinoArtUzBot
                TEXT;
                $keyboard = Keyboard::make()->inline()->row([
                    Keyboard::inlineButton([
                        'text' => '🔗 Batafsil',
                        'url' => "https://film-front-javohirs-projects-cf013492.vercel.app/news/{$model->id}"
                    ])
                ]);
                $users = TelegramUser::all();
                foreach ($users as $user) {
                    $this->sendPhoto($user->telegram_id,$image_path,$caption,$keyboard);
                }

            }
        }catch (\Exception $exception) {
            Log::info('news: ', [$exception->getMessage()]);
        }

        if ($model) {
            return $model;
        }

        return false;
    }

    public function update($data, $id)
    {
        dd($data);
        $model = $this->model->find($id);
        if (isset($data['images'])){
            deleteImages($model->images, 'news');
            $image = $this->uploads($data['images'], 'news');
        }else {
            $image = $model->image;
        }
        $model->update([
            'slug' => $data['name'],
            'status' => $data['status'],
            'image' => $image,
            'category_id' => $data['category_id']
        ]);

        $model->updateOrCreate([
            'name' => $data['name'],
            'description' => $data['description'],
            'content' => contentByDomDocment($data['content'], 'news'),
            'translates' => $data['translates']
        ]);

        if ($model) {
            return $model;
        }
        return false;
    }

    public function delete($id)
    {
        $model = $this->model->find($id);
        $path = explode('storage/news/', $model->image);
        @unlink('storage/news/' . $path[1]);
        $model->delete();
        return true;
    }


}
