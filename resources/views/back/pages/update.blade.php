@extends('back.layouts.master')
@section('title',$page->title.' sayfasını güncelle')

@section('content')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            @yield('title')
        </div>
        <div class="card-body">
            @if($errors->any())
                <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                         <li>{{$error}}</li>
                    @endforeach
                </div>
            @endif
            <form method="POST" action="{{route('admin.page.edit.post', $page->id)}}"  enctype="multipart/form-data">
                @method('POST')
                @csrf
                <div class="form-group">
                    <label for="">Sayfa Başlığı</label>
                    <input type="text" name="title" value="{{$page->title}}" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="">Makale Kategorisi</label>
                    <select type="text" name="category" class="form-control" >
                        <option value="">Seçim Yapınız</option>

                    </select>
                </div>
                <div class="form-group">
                    <label for="">Sayfa Fotoğrafı</label> <br>
                    <img src="{{asset($page->image)}}" class="mb-3 img-thumbnail rounded" width="300px" alt="">
                    <input type="file" name="image" class="form-control" >
                </div>
                <div class="form-group">
                    <label for="">Sayfa İçeriği</label>
                    <textarea type="text" name="content" id="editor"  class="form-control" required>{!! $page->content !!}</textarea>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block">Sayfayı Güncelle</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@endsection
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#editor').summernote({
                'height':300
            });
        });
    </script>
@endsection
