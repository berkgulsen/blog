@extends('back.layouts.master')
@section('title','Tüm Kategoriler')

@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Yeni Kategori Oluştur</h6>
            </div>
            <div class="card-body">
                dd
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">@yield('title')</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Kategori Adı</th>
                            <th>Makale Sayısı</th>
                            <th>Durum</th>
                            <th>İşlemler</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>Kategori Adı</th>
                            <th>Makale Sayısı</th>
                            <th>Durum</th>
                            <th>İşlemler</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @foreach($categories as $category)
                            <tr>
                                <td>{{$category->name}}</td>
                                <td>{{$category->articleCount()}}</td>
                                <td>
                                    <input class="switch" article-id="{{$category->id}}" type="checkbox" data-on="Aktif" data-off="Pasif" data-offstyle="danger" data-onstyle="success" data-toggle="toggle" {!! $category->status==0 ? "" : "checked" !!}>
                                </td>
                                <td>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('css')
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
@endsection
@section('js')
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <script>
        $(function() {
            $('.switch').change(function () {
                id = $(this)[0].getAttribute('category-id');
                statu=$(this).prop('checked');
                $.get("{{route('admin.category.switch')}}", {id: id, statu:statu}, function (data, status) {

                });
            })
        })
    </script>
@endsection
