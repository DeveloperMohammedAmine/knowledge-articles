<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Profile;
use App\Models\Category;
use App\Traits\saveImage;
use Auth;
class ArticlesController extends Controller
{

    use saveImage;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $articles = Article::with('user') -> with('category') -> orderBy('id', 'desc') -> paginate(12);
        return view('articles.index') -> with('articles', $articles);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::get();
        return view('articles.create') -> with('categories', $categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request -> validate([
            'title' => 'required',
            'text' => 'required',
            'image' => 'required|File::image()->smallerThan(1000)',
            'category_id' => 'required',
        ], [
            'image' => 'tried to upload image that has size small than 1 mb'
        ]);


        $image = $this -> saveImage($request -> image, 'assets/img/blog');
        
        $user_id = Auth::user() -> id;
        
        Article::create([
            'title' => $request -> title, 
            'text' => $request -> text, 
            'user_id' => $user_id, 
            'image' => $image, 
            'category_id' => $request -> category_id,
        ]);




        return redirect() -> route('user-dashboard.index') -> with('success', 'Article Published Successfully');





    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $article = Article::with('user') -> with('category') ->find($id);
        $articles = Article::
        with('category') ->
        orderBy('id', 'desc')->take(5) -> get();
        $categories = Category::with('articles') -> get();
        return view('articles.show') 
        -> with('article', $article)
        -> with('categories', $categories)
        -> with('articles', $articles);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article = Article::find($id);
        $categories = Category::get();
        return view('articles.edit') 
        -> with('article', $article)
        -> with('categories', $categories);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request -> validate([
            'title' => 'required|min:40|max:80',
            'text' => 'required|max:5000',
            'category_id' => 'required',
        ]);
        $article = Article::find($request -> id);

        if($request -> image)
            $image = $this -> saveImage($request -> image, 'assets/img/blog');
        else
            $image = $article -> image;


        $article -> update([
            'title' => $request -> title, 
            'text' => $request -> text,
            'image' => $image,
            'category_id' => $request -> category_id,
        ]);



        return redirect() -> route('user-dashboard.index') -> with('success', 'Article Updated Successfully');
        
    }


    public function getArticlesByCategory($category) {
        
        $category_id = Category::select('id') -> where('name', $category) -> get() -> first();

        $articles = Article::with(['user' => function($q) {
            $q -> select('id', 'name');
        }]) -> with(['category' => function($q) {
            $q -> select('id', 'name');
        }]) -> where('category_id', $category_id -> id) -> paginate(12);
        return view('articles.by-category') -> with('articles', $articles);

    }


    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article = Article::find($id) -> delete();
        
        return redirect() -> back() -> with('success-delete', 'Article Deleted Successfully');
    }
}
