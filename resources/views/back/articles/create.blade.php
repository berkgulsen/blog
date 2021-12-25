@extends('back.layouts.master')
@section('title','Makale Oluştur')

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
            <form method="POST" action="{{route('admin.makaleler.store')}}"  enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="">Makale Başlığı</label>
                    <input type="text" name="title" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="">Makale Kategorisi</label>
                    <select type="text" name="category" class="form-control" required>
                        <option value="">Seçim Yapınız</option>
                        @foreach($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Makale Fotoğrafı</label>
                    <input type="file" name="image" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="">Makale İçeriği</label>
                    <textarea type="text" name="content" id="editor" class="form-control" required></textarea>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block">Makaleyi Oluştur</button>
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
