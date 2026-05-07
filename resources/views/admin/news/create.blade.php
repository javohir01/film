@extends('admin.layouts.admin')

@section('title', 'Yangililar qo\'shish')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Yangiliklar</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('news.index') }}">Home</a></li>
                        <li class="breadcrumb-item active">News</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="col-11 mr-auto ml-auto">

            @if(session()->has('error'))
                <div class="alert alert-danger position-relative">
                    {{ session()->get('error') }}
                    <button class="btn btn-danger position-absolute cancel">&times;</button>
                </div>
            @endif

            <div class="card card-primary card-outline">
                <div class="card-body">
                    <form action="{{ route('news.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="translates" value="{{request('translates', 'oz')}}">
                        <div class="form-group">
                            <label>{{ labels('category') }}</label>
                            <select name="category_id"
                                    class="form-control @error('category_id') border-danger @enderror">
                                <option>----</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name_oz }}
                                    </option>
                                @endforeach
                            </select>
                            <small class="text-danger">{{ $errors->first('category_id') }}</small>
                        </div>

                        <div class="form-group">
                            <label>{{ labels('name') }}</label>
                            <input type="text" name="name"
                                   class="form-control @error('name') border-danger @enderror"
                                   placeholder="Nomi" value="{{ old('name') }}">
                            <small class="text-danger">{{ $errors->first('name') }}</small>
                        </div>

                        <div class="form-group">
                            <label>{{labels('image')}}</label>
                            <input type="file" name="images"
                                   class="form-control @error('images') border-danger @enderror"
                                   accept="image/jpeg,image/png,image/jpg">
                            <small class="text-danger">{{ $errors->first('images') }}</small>
                        </div>

                        <div class="form-group">
                            <label>{{labels('description')}}</label>
                            <textarea name="description" rows="5"
                                      class="form-control @error('description') border-danger @enderror"
                                      placeholder="Qisqacha ma'lumot">{{ old('description') }}</textarea>
                            <small class="text-danger">{{ $errors->first('description') }}</small>
                        </div>

                        <div class="form-group">
                            <label>{{labels('content')}}</label>
                            <textarea name="content"
                                      class="textarea form-control summernote @error('content') border-danger @enderror"
                                      id="summernote" placeholder="To'liq ma'lumot">{{ old('content') }}</textarea>
                            <small class="text-danger">{{ $errors->first('content') }}</small>
                        </div>

                        <div class="form-group">
                            <label>{{labels('status')}}</label>
                            <select name="status" class="form-control form-control-sm">
                                <option value="1" {{ old('status', 1) == 1 ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>No Active</option>
                            </select>
                        </div>

                        <div class="form-check">
                            <label>
                                <input type="checkbox" class="form-check-input"
                                       name="telegram_status" value="true"
                                    {{ old('telegram_status') ? 'checked' : '' }}>
                                <span class="telegram-label">{{labels('telegram')}}</span>
                            </label>
                        </div>

                        <div class="text-right mt-3">
                            <button class="btn btn-success">&check; Saqlash</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('js')

@endpush
