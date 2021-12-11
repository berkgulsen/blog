@extends('front.layouts.master')
@section('title',$category->name.' Kategorisi')
@section('content')

    <div class="col-md-9 mx-auto">
        @include('front.widget.articlewidget')
    </div>
    @include('front.widget.categorywidget')
@endsection
