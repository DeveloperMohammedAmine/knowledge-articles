<?php 

namespace App\Services;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class ArticleService {

    public function create($data) {

        $user_id = Auth::user() -> id;
        
        $article = new Article;

        $article->title = $data['title']; 
        $article->text = $data['text']; 
        $article->user_id = $user_id;
        $article->image = $data['imageName'];
        $article->category_id = $data['category_id'];

        $article->save();

    }

    public function getFiveArticles() {
        $articles = Article::with('category') 
        -> orderBy('id', 'desc')->take(5) -> get();
        
        return $articles;
    }
    
    public function getCategoriesWithArticles() {
        $categories = Category::with('articles') -> get();

        return $categories;
    }
    
    public function show($article_id) {
        $article = Article::with('user') -> with('category') ->find($article_id);
        return $article;
    }

    public function update($article, $data) {
        $article -> update([
            'title' => $data['title'],
            'text' => $data['text'],
            'image' => $data['imageName'],
            'category_id' => $data['category_id'],
        ]);
    }

    public function getArticlesByCategory($category_id) {
        $articles = Article::with(['user' => function($q) {
            $q -> select('id', 'name');
        }]) -> with(['category' => function($q) {
            $q -> select('id', 'name');
        }]) -> where('category_id', $category_id -> id) -> paginate(12);

        return $articles;
    }

}


?>