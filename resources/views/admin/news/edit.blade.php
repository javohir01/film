@extends('admin.layouts.admin')

@section('title', 'Yangilikni O\'zgartirish')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Yangiliklar</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('news.index')}}">Home</a></li>
                        <li class="breadcrumb-item active">News</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="col-11  ml-auto mr-auto">
            @if(session()->has('error'))
                <div class="alert alert-danger position-relative">
                    {{session()->get('error')}}
                    <button class="btn btn-danger position-absolute cancel">&times;</button>
                </div>
            @endif
            <div class="card card-primary card-outline">
                <div class="card-header">
                </div>
                <div class="card-body">
                    @php
                        $translation = $model->translations->first();
                        $ph = fn($key) => $translation ? '' : labels($key);
                    @endphp
                    <form action="{{route('news.update', $model->id)}}" method="post" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="tab-content" id="custom-tabs-three-tabContent">
                            <div class="tab-pane fade show active" id="custom-tabs-three-home" role="tabpanel">
                                <div class="form-group">
                                    <label>{{ labels('category') }}</label>
                                    <select name="category_id" class="form-control @error('category_id') border-danger @enderror">
                                        <option>----</option>
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}" {{$category->id == $model->category_id?'selected':''}}>{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                    <small class="text-danger">{{$errors->first('category_id')}}</small>
                                </div>
                                <div class="form-group">
                                    <label>{{ labels('name') }}</label>
                                    <input type="text"
                                           class="form-control @error('name') border-danger @enderror"
                                           name="name"
                                           value="{{$translation?->name}}"
                                           placeholder="{{$ph('name')}}"
                                    >
                                    <small class="text-danger">{{$errors->first('name')}}</small>
                                </div>

                                <div class="form-group">
                                    <label>{{ labels('images') }}</label>
                                    @if($model->image)
                                        <div id="imageBox" style="width: 200px; height: 200px; margin-bottom: 30px">
                                            <img src="{{getInFolder($model->image, 'news')}}" alt="" style="width: 100%; height: 100%">
                                            <small class="text-danger">{{$errors->first('images')}}</small>
                                            <p>
                                                <a href="#" id="changeImage">O'zgartiring</a>
                                            </p>

                                        </div>
                                        <div id="fileInput" style="display: none">
                                            <input type="file" class="form-control" name="images" accept="image/jpeg,png,jpg">
                                            <p>
                                                <a href="" id="cancelChangeImage">Bekor qilish</a>
                                            </p>
                                        </div>
                                    @else
                                        <input type="file" class="form-control" name="images" accept="image/jpeg,png,jpg">
                                        <small class="text-danger">{{$errors->first('images')}}</small>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label>{{ labels('description') }}</label>
                                    <textarea name="description"
                                              cols="30"
                                              rows="5"
                                              class="form-control @error('description') border-danger @enderror"
                                              placeholder="{{$ph('description')}}"
                                    >
                                        {{$translation?->description}}
                                    </textarea>
                                    <small class="text-danger">{{$errors->first('description')}}</small>
                                </div>

                                <div class="form-group">
                                    <label>{{ labels('content') }}</label>
                                    <textarea name="content"
                                              class="textarea form-control summernote @error('content') border-danger @enderror"
                                              id="summernote"
                                              placeholder="{{$ph('content')}}"
                                    >
                                        {{$translation?->content}}
                                    </textarea>
                                    <small class="text-danger">{{$errors->first('content')}}</small>
                                </div>

                                <div class="form-group">
                                    <label>{{ labels('status') }}</label>
                                    <select name="status" class="form-control form-control-sm">
                                        <option value="1" {{$model->status == 1?'selected':''}}>Active</option>
                                        <option value="0" {{$model->status == 0?'selected':''}}>No Active</option>
                                    </select>
                                </div>
                            </div>
                            <div class="text-right">
                                <button class="btn btn-success">&check;Saqlash</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
