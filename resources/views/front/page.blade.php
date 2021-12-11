@extends('front.layouts.master')
@section('title',$page->title)
@section('bg',$page->imagePath)
@section('content')


    <div class="col-md-10 col-lg-8 mx-auto">
        {!! $page->content !!}
    </div>
@endsection

