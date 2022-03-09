<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


 // Models
use App\Models\Article;
use App\Models\Category;
use App\Models\Page;
use App\Models\Contact;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;


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

    public function contact(){
        return view('front.contact');
    }

    public function contactpost(Request $request){
        $rules=[
            'name'=>'required|min:5',
            'email'=>'required|email',
            'topic'=>'required',
            'message'=>'required|min:10'
        ];
        $validate=Validator::make($request->post(),$rules);
        if ($validate->fails()){

            return redirect()->route('contact')->withErrors($validate)->withInput();
        }
            Mail::send([],[],function ($message) use($request){
                $message->from('iletisim@blogsitesi.com','Blog Sitesi');
                $message->to('bipurpie.exe@gmail.com');
                $message->setBody(' Mesajı gönderen: '.$request->name.'<br/>
                                    Mesajı gönderen mail: '. $request->email.'<br/>
                                    Mesaj Konusu: '.$request->topic.'<br/>
                                    Mesaj: '.$request->message.'<br/><br/>
                                    Mesaj gönderilme tarihi '.now(),'text/html');
                $message->subject($request->name.'iletişimden mesaj gönderdi');
            });

        //    $contact = new Contact;
        //    $contact->name=$request->name;
        //    $contact->email=$request->email;
        //    $contact->topic=$request->topic;
        //    $contact->message=$request->message;
        //    $contact->save();
            return redirect()->route('contact')->with('success','Mesajınız iletilmiştir.');


    }
}
