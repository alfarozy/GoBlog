<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::where('user_id', auth()->user()->id)->orderBy('id', 'DESC')->paginate(15);
        return view('dashboard.category.index', compact('categories'));
    }

    public function create()
    {
        return view('dashboard.category.create');
    }

    public function store(Request $request)
    {
        $attr = $request->validate([
            'name'  => 'required|unique:categories',

        ]);
        $attr['user_id'] = auth()->user()->id;
        $attr['slug'] = \Str::slug($request->name);
        $attr['class'] = $request->class;

        Category::create($attr);
        return redirect()->route('category.index')->with('msg', '<div class="msg rounded">
        <span class="mx-3" >Berhasil Menambah Kategori <b>' . $request->name . '</b></span>
      </div>');
    }
    public function get(Category $category)
    {
        // $slug = $request->slug;
        $articles =  $category->article()->paginate(6);
        $videos = Video::inRandomOrder()->limit(3)->get();

        return view('home.index', ['articles' => $articles, 'category' => $category, 'videos' => $videos]);;
    }

    public function edit(Category $category)
    {
        return view('dashboard.category.edit', compact('category'));
    }
    public function update(Request $request, Category $category)
    {
        $attr = $request->validate([
            'name'  => ['required', Rule::unique('categories', 'name')->ignore($category->id)],

        ]);;
        $attr['slug'] = \Str::slug($request->name);
        $attr['class'] = $request->class;

        $category->update($attr);
        return redirect()->route('category.index')->with('msg', '<div class="msg rounded">
        <span class="mx-3" >Berhasil Update Kategori <b>' . $request->name . '</b></span>
      </div>');
    }

    public function show(Category $category)
    {
        return redirect()->route('category.show', $category->slug);
    }

    public function destroy(Category $category)
    {
        $categoryName = $category->name;
        $category->delete();
        return redirect()->route('category.index')->with('msg', '<div class="msg rounded">
        <span class="mx-3" >Berhasil Menghapus Kategori <b>' . $categoryName . '</b></span>
      </div>');
    }
}
