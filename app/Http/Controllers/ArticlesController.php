<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Profile;
use App\Models\Category;
use App\Services\DBService;
use Illuminate\Http\Request;
use App\Services\ArticleService;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\UpdateArticleUpdate;
use App\Http\Requests\UpdateArticleRequest;


class ArticlesController extends Controller
{


    public function __construct(protected DBService $DBService) {}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::with('user')->with('category')->orderBy('id', 'desc')->paginate(12);
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
        return view('articles.create')->with('categories', $categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePostRequest $request)
    {

        $image = uploadFile($request -> img, 'assets/img/blog');

        $request['image'] = $image;
        $request['user_id'] = Auth::user() -> id;

        
        $this->DBService->create(new Article, $request->except('_token'));

        return redirect() -> route('user-dashboard.index') -> with('success', 'Article Published Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        
        $articles = $this->DBService->getSome(new Article, 5, ['category']);
        
        $categories = $this->DBService->getCategoriesWithArticles();

        return view('articles.show', compact('article', 'articles', 'categories'));

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
        
        return view('articles.edit', compact('article', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateArticleRequest $request)
    {
        $article = Article::find($request -> id);

        // check if user upload an image set it , if not just keep the old image
        if($request -> img) {
            $image = uploadFile($request -> img, 'assets/img/blog');
            unlinkFile("assets/img/blog/".$article -> image);
        }
        else {
            $image = $article->image;
        }

        $request['image'] = $image;

        $this->DBService->update($article, $request->except('_token', '_method'));

        return redirect() -> route('user-dashboard.index') -> with('success', 'Article Updated Successfully');
        
    }


    public function getArticlesByCategory($category) {
        
        $category_id = Category::select('id') -> where('name', $category) -> get() -> first();

        $articles = $this->DBService->getArticlesByCategory($category_id);

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
