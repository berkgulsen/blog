<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use App\Models\Category;

class Homepage extends Controller
{
    public function index(){
        $data['articles']=Article::orderBy('created_at','DESC')->get();
        $data['categories']=Category::get();
        return view('front.homepage',$data);
    }

    public function single($category,$slug){
        $category=Category::whereSlug($category)->first() ?? abort(403,'Boyle bir kategori bulunamadi');
        $article=Article::whereSlug($slug)->whereCategoryid($category->id)->first() ?? abort(403,'Boyle bir yazi bulunamadi');
        $article->increment('hit');
        $data['article']=$article;
        $data['categories']=Category::get();
        return view('front.single',$data);
    }

    public function category($slug){
        $category=Category::whereSlug($slug)->first() ?? abort(403,'Boyle bir kategori bulunamadi');
        $data['category']=$category;
        $data['articles']=Article::where('categoryId',$category->id)->orderBy('created_at','DESC')->get();
        $data['categories']=Category::get();

        return view('front.category',$data);

    }
}
