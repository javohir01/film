@extends('admin.layouts.admin')


@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Kategoriyalar</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('categories.index')}}">Home</a></li>
                        <li class="breadcrumb-item active">Category</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="col-11 mr-auto ml-auto">
            <div class="card card-info card-outline">
                <div class="card-body">
                    <form action="{{route('categories.update',$model->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="translates" value="{{request('translates', 'oz')}}">
                        <div class="form-group">
                            <label for="">Menu</label>
                            <select name="menu" id="menu" class="form-control">
                                <option value="">---</option>
                                {{--                                        <option value="news" {{$model->type == 'news'?'selected':''}}>Yangiliklar</option>--}}
                                {{--                                        <option value="premiere" {{$model->type == 'premiere'?'selected':''}}>Premyaerlar</option>--}}
                                {{--                                        <option value="analysis" {{$model->type == 'analysis'?'selected':''}}>Kino Tahlil</option>--}}
                                {{--                                        <option value="interview" {{$model->type == 'interview'?'selected':''}}>Suxbatlar</option>--}}
                                {{--                                        <option value="person" {{$model->type == 'person'?'selected':''}}>Shaxsiyatlar</option>--}}
                                {{--                                        <option value="dictionary" {{$model->type == 'dictionary'?'selected':''}}>Kino Lug'at</option>--}}
                                {{--                                        <option value="fact" {{$model->type == 'fact'?'selected':''}}>Kino Fakt</option>--}}
                                {{--                                        <option value="filmography" {{$model->type == 'filmography'?'selected':''}}>Filmografiya</option>--}}
                                {{--                                        <option value="books" {{$model->type == 'books'?'selected':''}}>Kitoblar</option>--}}

                                <option value="film_digests" {{$model->type == 'film_digests'? 'selected' : ''}}>
                                    Kinodayjest
                                </option>
                                <option value="film_grids" {{$model->type == 'film_grids'? 'selected' : ''}}>Kinogid
                                </option>
                                <option value="film_catalogs" {{$model->type == 'film_catalogs'? 'selected' : ''}}>
                                    Kinokatalog
                                </option>
                                <option value="film_diagnostics" {{$model->type == 'film_diagnostics'? 'selected' : ''}}>
                                    Kinotashxis
                                </option>
                                <option value="books" {{$model->type == 'books'? 'selected' : ''}}>Kinomutolaa</option>
                            </select>
                            <small class="text-danger">{{$errors->first('menu')}}</small>
                        </div>

                        <div class="form-group">
                            <label>Kategoriya Nomi</label>
                            <input type="text" class="form-control" name="name" value="{{$model->translates->first()?->name}}">
                            <small class="text-danger">{{$errors->first('name')}}</small>
                        </div>

                        <div class="form-group">
                            <label for="">Status</label>
                            <select name="status" id="status" class="form-control">
                                <option value="1" {{$model->status == 1?'selected':''}}>Active</option>
                                <option value="2" {{$model->status == 2?'selected':''}}>No Active</option>
                            </select>
                            <small class="text-danger">{{$errors->first('status')}}</small>
                        </div>

                        <div class="form-group">
                            <label for="">Order</label>
                            <input type="text" class="form-control" name="order" placeholder="Order"
                                   value="{{$model->order}}">
                            <small class="text-danger"{{$errors->first('order')}}></small>
                        </div>

                        <div class="text-right">
                            <button class="btn btn-success">&check;Saqlash</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('js')
    <script>
        {{--$(document).ready(function () {--}}
        {{--    $('#menu').on('change', function () {--}}
        {{--        let menu = $(this).val();--}}
        {{--        console.log(menu);--}}
        {{--        $.ajax({--}}
        {{--            url: '{{route('order_category')}}',--}}
        {{--            method: 'GET',--}}
        {{--            data: {menu: menu},--}}
        {{--            success: function (res){--}}
        {{--                let order = res.data.order + 1;--}}
        {{--                $('#order').val(order);--}}
        {{--            },--}}
        {{--        })--}}
        {{--    })--}}
        {{--})--}}
    </script>
@endpush
