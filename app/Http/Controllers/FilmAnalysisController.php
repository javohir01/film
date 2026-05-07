<?php

namespace App\Http\Controllers;

use App\Models\FilmAnalysis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class FilmAnalysisController extends Controller
{
    public function index(Request $request)
    {
        $lang = $request->header('lang', 'oz');
        $params = $request->all();
        $per_page = $result['per_page']??6;
        if (isset($params['category_id']) && !empty($params['category_id'])) {
            $items = FilmAnalysis::where('category_id', $params['category_id'])
                ->with(['translates' => function ($q) use ($lang){
                    $q->where('translates', $lang);
                }])
                ->orderBy('created_at', 'desc')
                ->paginate($per_page);
        }else {
            $items = FilmAnalysis::where('status', 1)
                ->with(['translates' => function ($q) use ($lang){
                    $q->where('translates', $lang);
                }])
                ->orderBy('created_at', 'desc')
                ->paginate($per_page);
        }
        if ($items) {
            return successJson($items, 'ok');
        }
        return errorJson('Undefined Element', 404);
    }


    public function show(Request $request,$id)
    {
        $lang = $request->header('lang', 'oz');
        $items = FilmAnalysis::where('id', $id)->orderBy('id', 'desc')
            ->with(['translates' => function ($q) use ($lang){
                $q->where('translates', $lang);
            }])
            ->first();
        if ($items)
        {
            $ip = $request->ip();
            $cache = "view_count_{$id}_ip_{$ip}";
            $count = $items->view_count + 1;
            if (!Cache::has($cache)) {
                $items->update([
                    'view_count' => $count
                ]);
                Cache::put($cache, true, now()->addMinutes(3));
            }
            return successJson($items, 'ok');
        }
        return errorJson('Undefined Element!', 404);
    }

}
