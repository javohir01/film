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
                    <form action="{{route('categories.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                            <input type="hidden" name="translates" value="{{request('translates', 'oz')}}">
                            <div class="form-group">
                                <label for="">Menu</label>
                                <select name="menu" id="menu" class="form-control">
                                    <option value="">---</option>
                                    <option value="film_digests">Kinodayjest</option>
                                    <option value="film_grids">Kinogid</option>
                                    <option value="film_catalogs">Kinokatalog</option>
                                    <option value="film_diagnostics">Kinotashxis</option>
                                    <option value="books">Kinomutolaa</option>
                                    {{--                                        <option value="news">Yangiliklar</option>--}}
                                    {{--                                        <option value="dictionary">Kino Lug'at</option>--}}
                                    {{--                                        <option value="fact">Kino Fakt</option>--}}
                                    {{--                                        <option value="filmography">Filmografiya</option>--}}
                                </select>
                                <small class="text-danger">{{$errors->first('menu')}}</small>
                            </div>

                            <div class="form-group">
                                <label>Kategoriya Nomi</label>
                                <input type="text" class="form-control" name="name" placeholder="Name">
                                <small class="text-danger">{{$errors->first('name')}}</small>
                            </div>

                            <div class="form-group">
                                <label for="">Status</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="1" selected>Active</option>
                                    <option value="2">No Active</option>
                                </select>
                                <small class="text-danger">{{$errors->first('status')}}</small>
                            </div>

                            <div class="form-group">
                                <label for="">Order</label>
                                <input type="text" class="form-control" name="order" placeholder="Order"
                                       value="{{$order}}">
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
