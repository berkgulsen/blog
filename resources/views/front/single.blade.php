@extends('front.layouts.master')
@section('title',$article->title)
@section('bg',asset($article->imagePath))
@section('content')


    <div class="col-md-9  mx-auto">
        {!!$article->content!!}
        <br><br>
        <span class="text-danger">Okuma Sayisi: <b>{{$article->hit}}</b> </span>
    </div>
    @include('front.widget.categorywidget')
@endsection
