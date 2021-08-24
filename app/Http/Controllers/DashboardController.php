<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function articles()
    {
        $articles = Article::with('category')->where('user_id', auth()->user()->id)->orderBy('id', 'DESC')->paginate(15);
        return view('dashboard.article.index', compact('articles'));
    }
    // tidak diperlukan
    public function categories()
    {
        // jika admin tampilkan semuanya jika user biasa tampilkan milikya sendiri
        $categories = Category::where('user_id', auth()->user()->id)->orderBy('id', 'DESC')->paginate(15);
        return view('dashboard.category.index', compact('categories'));
    }
    public function users()
    {
        $users = User::latest()->paginate(15);
        return view('dashboard.user.index', compact('users'));
    }
}
