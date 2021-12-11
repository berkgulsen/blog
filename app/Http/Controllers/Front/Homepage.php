<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;

 // Models
use App\Models\Article;
use App\Models\Category;
use App\Models\Page;

class Homepage extends Controller
{
    public function __construct(){
        view()->share('pages',Page::orderBy('order','ASC')->get());
        view()->share('categories',Category::get());
    }

    public function index(){
        $data['articles']=Article::orderBy('created_at','DESC')->paginate(5);
        return view('front.homepage',$data);
    }

    public function single($category,$slug){
        $category=Category::whereSlug($category)->first() ?? abort(403,'Boyle bir kategori bulunamadi');
        $article=Article::whereSlug($slug)->whereCategoryid($category->id)->first() ?? abort(403,'Boyle bir yazi bulunamadi');
        $article->increment('hit');
        $data['article']=$article;
        return view('front.single',$data);
    }

    public function category($slug){
        $category=Category::whereSlug($slug)->first() ?? abort(403,'Boyle bir kategori bulunamadi');
        $data['category']=$category;
        $data['articles']=Article::where('categoryId',$category->id)->orderBy('created_at','DESC')->paginate(5);
        return view('front.category',$data);
    }

    public function page($slug){
        $page=Page::whereSlug($slug)->first() ?? abort(403,'Böyle bir sayfa bulunamadı');
        $data['page']=$page;
        return view('front.page',$data);
    }
}
