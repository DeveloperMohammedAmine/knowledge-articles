<?php 

namespace App\Services;

use App\Models\Article;
use App\Models\Category;

class DBService {

    public function create($model, $data) {


        $data = array_filter($data, function ($item) {
            return !($item instanceof \Illuminate\Http\UploadedFile); // Exclude UploadedFile instances
        });
        
        foreach($data as $key => $value) {
            $model->$key = $value;
        }

        $model->save();

    }

    public function getSome($model, $howMuch, $with) {
        $some = $model->with($with)->orderBy('id', 'desc')->take($howMuch)->get();
        return $some;
    }
    
    public function getCategoriesWithArticles() {
        $categories = Category::with('articles') -> get();
        return $categories;
    }
    
    public function update($model, $data) {

        $data = array_filter($data, function ($item) {
            return !($item instanceof \Illuminate\Http\UploadedFile); // Exclude UploadedFile instances
        });

        foreach($data as $key=> $value) {
            $model->$key = $value;
        }
        
        $model->save();

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