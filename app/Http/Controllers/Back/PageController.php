<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class PageController extends Controller
{
    public function index(){
        $pages=Page::orderBy('order','DESC')->get();
        return view('back.pages.index',compact('pages'));
    }

    public function create(){
        return view('back.pages.create');
    }

    public function update($id){
        $page=Page::findOrFail($id);
        return view('back.pages.update',compact('page'));
    }

    public function updatePost(Request $request, $id){
        $request->validate([
            'title'=>'min:3',
            'image'=>'image|mimes:jpeg,png,jpg|max:2048'
        ]);
        $page = Page::findOrFail($id);
        $page->title=$request->title;
        $page->content=$request->content;
        $page->slug=str::slug($request->title);
        if ($request->hasFile('image')){
            $imageName=str::slug($request->title).'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads'),$imageName);
            $page->image='uploads/'.$imageName;
        }
        $page->save();
        return view('back.pages.update',compact('page'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'=>'min:3',
            'image'=>'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $last=Page::orderBy('order','DESC')->first();
        $page = new Page;
        $page->title=$request->title;
        $page->content=$request->content;
        $page->order=$last->order + 1;
        $page->slug=str::slug($request->title);
        if ($request->hasFile('image')){
            $imageName=str::slug($request->title).'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads'),$imageName);
            $page->image='uploads/'.$imageName;
        }
        $page->save();
        toastr()->success('Sayfa başarıyla oluşturuldu');
        return redirect()->route('admin.page.index');
    }

    public function switch(Request $request){
        $page=Page::findOrFail($request->id);
        $page->status=$request->statu=="true" ? 1 : 0;
        $page->save();
    }

    public function orders(Request $request){
        print_r($request->get('page'));
        foreach ($request->get('page') as $key => $order){
            Page::where('id',$order)->update(['order'=>$key]);
        }
    }

    public function delete($id){
        $page=Page::findOrFail($id);
        if (File::exists($page->image)){
            File::delete(public_path($page->image));
        }
        $page->forceDelete();
        toastr()->success('Sayfa başarıyla silindi');
        return redirect()->back();
    }

}
