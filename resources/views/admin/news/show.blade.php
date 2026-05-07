@extends('admin.layouts.admin')

@section('title', 'Yangiliklar')

@push('css')
    <style>
        img{
            width: 250px;
            height: 200px;
        }
    </style>
@endpush

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
        <div class="col-11 mr-auto ml-auto">
            @if(session()->has('success'))
                <div class="alert alert-success position-relative">
                    {{session()->get('success')}}
                    <p class="cancel mb-0">&times;</p>
                </div>
            @endif
            <div class="card card-outline card-info">
                <div class="card-body">
                    <div class="tab-content" id="custom-tabs-three-tabContent">
                        {{----- oz -----}}
                        <div class="tab-pane fade show active" id="custom-tabs-three-home" role="tabpanel">
                            <table class="table table-bordered table-striped table-hover">
                                <tbody>
                                    <tr>
                                        <th>{{labels('name')}}</th>
                                        <td>{{(is_object($model) && $model->translations->first()) ? $model->translations->first()->name : ''}}</td>
                                    </tr>
                                    <tr>
                                        <th>{{labels('image')}}</th>
                                        <td><img src="{{(count($model['translations']) > 0 && $model->image) ? getInFolder($model->image, 'news') : ''}}" alt="error"></td>
                                    </tr>
                                    <tr>
                                        <th>{{labels('description')}}</th>
                                        <td>{{(is_object($model) && $model->translations->first()) ? $model->translations->first()->description : ''}}</td>
                                    </tr>
                                    <tr>
                                        <th>{{labels('date')}}</th>
                                        <td>{{(count($model['translations']) > 0 && $model->created_at) ? $model->created_at->format('d-m-Y') : ''}}</td>
                                    </tr>
                                    <tr>
                                        <th>{{labels('status')}}</th>
                                        <td>{{(count($model['translations']) > 0 && $model->status) ? $model->status==1?'Active':'No Active' : ''}}</td>
                                    </tr>
                                    <tr>
                                        <th>{{labels('content')}}</th>
                                        <td>{!! (is_object($model) && $model->translations->first()) ? $model->translations->first()->content : '' !!}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="d-flex align-items-center float-right">
                        <a href="{{route('news.edit', $model->id)}}" class="btn btn-info mr-1">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('news.destroy', $model->id) }}" method="post"
                              id="deleteItem-{{$model->id}}">
                            @csrf

                        </form>
                        <a type="submit" class="btn btn-danger"
                           onclick="if (confirm('Siz rostdan ham ushbu ma\'lumotni o\'chirishni xoxlaysizmi ?')){
                               document.getElementById('deleteItem-<?= $model->id ?>').submit();
                               }">
                            <span class="fa fa-trash-alt"></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
