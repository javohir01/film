<?php

namespace App\Http\Controllers;

use App\Models\PersonCategory;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index(Request $request)
    {
        $lang = $request->header('lang', 'oz');
        $categories = PersonCategory::where('status', 1)->with(['translates' => function ($q) use ($lang){
            $q->where('translates', $lang);
        }])
            ->orderBy('created_at', 'asc')
            ->get();
        return response()->json(['success' => true, 'data' => $categories, 'message' => 'ok']);
    }
}

