@extends('back.layouts.master')
@section('title','Tüm Sayfalar')

@section('content')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary float-left"><strong>{{$pages->count() }}</strong> sayfa bulundu.</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Fotoğraf</th>
                        <th>Sayfa Başlığı</th>
                        <th>Durum</th>
                        <th>İşlemler</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>Fotoğraf</th>
                        <th>Sayfa Başlığı</th>
                        <th>Durum</th>
                        <th>İşlemler</th>
                    </tr>
                    </tfoot>
                    <tbody>
                        @foreach($pages as $page)
                            <tr>
                                <td>
                                    <img src="{{asset($page->imagePath)}}" width="150px">
                                </td>
                                <td>{{$page->title}}</td>
                                <td>
                                    <input class="switch" page-id="{{$page->id}}" type="checkbox" data-on="Aktif" data-off="Pasif" data-offstyle="danger" data-onstyle="success" data-toggle="toggle" @if($page->status==1) checked @endif>
                                </td>
                                <td>
                                    <a href="{{route('page',$page->slug)}}" target="_blank" title="Görüntüle" class="btn btn-sm btn-success"><i class="fa fa-eye"></i></a>
                                    <a href="{{route('admin.makaleler.edit',$page->id)}}" title="Düzenle" class="btn btn-sm btn-primary"><i class="fa fa-pen"></i></a>
                                    <a href="" title="Sil" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
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
                id = $(this)[0].getAttribute('page-id');
                statu=$(this).prop('checked');
                $.get("{{route('admin.page.switch')}}", {id: id, statu:statu}, function (data, status) {

                });
            })
        })
    </script>
@endsection