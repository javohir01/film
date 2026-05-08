<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AphorismRequest;
use App\Models\Aphorism;
use App\Models\Calendar;
use App\Repositories\AphorismRepository;
use Illuminate\Http\Request;

class AphorismController extends Controller
{
    public function __construct(protected Request $request, protected AphorismRepository $repo){}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $models = $this->repo->index($this->request);
        return view('admin.aphorism.index', compact('models'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $model = Aphorism::query()->max('order');
        $order = $model + 1;
        return view('admin.aphorism.create', compact('order'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AphorismRequest $request)
    {
        $model = $this->repo->create($request->validated());
        if ($model){
            $request->session()->flash('success', 'Success');
            return redirect()->route('aphorism.index');
        }else{
            $request->session()->flash('error', 'Errors');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        $translates = $request->all();
        $lang = $translates['translates']??'oz';
        $model = $this->repo->findById($id, $lang);
        return view('admin.aphorism.edit', compact('model'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AphorismRequest $request, $id)
    {
        $model = $this->repo->update($request->validated(), $id);

        if ($model)
        {
            $request->session()->flash('success', 'Success');
            return redirect()->route('aphorism.index');
        }else{
            $request->session()->flash('error', 'Errors');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $translate = $request->all();
        $this->repo->delete($id, $translate);

        return redirect()->route('aphorism.index');

    }
}
