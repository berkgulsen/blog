@isset($categories)
<div class="col-md-3">
    <div class="card">
        <div class="card-header">
            Kategoriler
        </div>
        <div class="list-group">
            @foreach($categories as $category)
                <a href="{{route('category',$category->slug)}}" class="list-group-item @if(Request::segment(1)==$category->slug) active @endif">{{$category->name}}
                    <span class="badge bg-black float-end">{{$category->articleCount()}}</span></a>
            @endforeach
        </div>
    </div>
</div>
@endif
