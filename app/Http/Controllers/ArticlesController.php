<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Article;
use App\Models\Profile;
use App\Models\Category;
use App\Traits\saveImage;
use Illuminate\Http\Request;
use App\Services\ArticleService;
use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\UpdateArticleUpdate;

class ArticlesController extends Controller
{

    use saveImage;

    protected $articleService;

    public function __construct(ArticleService $articleService) {
        $this->articleService = $articleService;
    }
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
    public function store(CreatePostRequest $request)
    {

        $image = $this -> saveImage($request -> image, 'assets/img/blog');

        $request['imageName'] = $image;
        
        $this->articleService->create($request->all());

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
        
        $article = $this->articleService->show($id);
        
        $articles = $this->articleService->getFiveArticles();
        
        $categories = $this->articleService->getCategoriesWithArticles();

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
    public function update(UpdateArticleUpdate $request)
    {
        $article = Article::find($request -> id);
        
        $image = $request -> image ? 
        $this -> saveImage($request -> image, 'assets/img/blog')
        : $article -> image;

        $request['imageName'] = $image;

        $this->articleService->update($article, $request->all());

        return redirect() -> route('user-dashboard.index') -> with('success', 'Article Updated Successfully');
        
    }


    public function getArticlesByCategory($category) {
        
        $category_id = Category::select('id') -> where('name', $category) -> get() -> first();

        $articles = $this->articleService->getArticlesByCategory($category_id);

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
