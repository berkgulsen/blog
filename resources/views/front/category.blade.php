@extends('front.layouts.master')
@section('title',$category->name.' Kategorisi')
@section('content')

    <div class="col-md-9 mx-auto">
        @if(count($articles)>0)
    @foreach($articles as $article)
        <!-- Post preview-->
            <div class="post-preview">
                <a href="{{route('single',[$article->getCategory->slug,$article->slug])}}">
                    <h2 class="post-title">{{$article->title}}</h2>
                    <h3 class="post-subtitle">{!!$article->content!!}</h3>
                </a>
                <p class="post-meta">Kategori:
                    <a href="#!">{{$article->getCategory->name}}
                        <span class="float-end">{{$article->created_at->diffForHumans()}}</span></a>

                </p>
            </div>
        @if(!$loop->last)
            <!-- Divider-->
                <hr class="my-4" />
            @endif
        @endforeach
            @else
        <div class="alert">
            <h3>Bu kategoriye ait yazi bulunamadi</h3>
        </div>
            @endif
    </div>
    @include('front.widget.categorywidget')
@endsection
