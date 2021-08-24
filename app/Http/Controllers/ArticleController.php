<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpParser\Node\Expr\PostDec;
use App\Models\Article;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Reply;
use App\Models\Tag;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{

    public function create()
    {
        $categories = Category::get();
        $tags = Tag::orderByDesc('name')->get();
        return view('article.create', ['categories' => $categories, 'tags' => $tags]);
    }

    public function store(Request $request)
    {
        $attr = $request->validate([
            'title'     => 'required',
            'content'   => 'required',
            'description' => 'required',
            'img'       => 'mimes:png,jpg,jpeg',
            'category' => 'required',
            'tags'      => 'required',
        ]);

        DB::beginTransaction();
        try {

            // note
            // jangan tiru coding ini dirumah :v
            $tags = mb_split(',', $request->tags); //return ['tags1','tags2', ...] 
            $tagsId = [];
            // cek tags dan insert into database
            foreach ($tags as $tag) {
                $tagSlug = \Str::slug($tag);
                $cekTags = Tag::where('slug', $tagSlug)->where('status', 0)->first();

                if (!$cekTags) {
                    $data['name']   = trim($tag);
                    $data['user_id'] = auth()->user()->id;
                    $data['slug'] = $tagSlug . random_int(1, 3);
                    Tag::create($data);
                }
                // duplicate entry for primary
                $dataTagsId = Tag::where('slug', $data['slug'])->where('status', 0)->select('id')->first();
                $tagsId[] .= $dataTagsId->id;
            }

            $category = Category::where('name', $request->category)->first();
            if (!$category) {
                $attr['name']   = $request->category;
                $attr['user_id'] = auth()->user()->id;
                $attr['slug'] = \Str::slug($request->category);
                Category::create($attr);
            }

            $category = Category::where('name', $request->category)->first();

            if ($category) {
                $attr['category_id'] = $category->id;
            }
            $attr['slug'] = \Str::slug($request->title) . '.html';
            $file = $request->file('img');
            if ($file) {
                $img = $file->store('images/articles');
            } else {
                $img = 'images/articles/default-img-article.png';
            }
            $attr['img'] =   $img;
            $article = auth()->user()->articles()->create($attr);
            $article->tags()->attach($tagsId);
            DB::commit();
            return redirect()->route('article.index')->with('msg', '<div class="msg rounded">
    <span class="mx-3" >Berhasil menambah Artikel</span>
  </div>');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('article.create')->with('msg', '<div class="msg rounded">
            <span class="mx-3" >Terjadi kesalahan </span>
            </div>');
        }
    }

    public function show($slug)
    {
        $article = Article::where('slug', $slug)->firstOrFail();
        $tags    = Tag::where('status', 0)->orderBy('name')->get();
        $categories = Category::orderBy('name')->get();
        $similar_posts = Article::where('category_id', $article->category->id)->inRandomOrder()->take(2)->get();

        $views = $article->views + 1;

        Article::where('slug', $slug)->update(['views' => $views]);
        return view('article.show', [
            'article'       => $article,
            'tags'          => $tags,
            'categories'    => $categories,
            'similar_posts' => $similar_posts,
            'views'         => $views,
            // 'comments_count' => $comments_count,
        ]);
    }
    public function destroy($slug)
    {
        $article = Article::where('user_id', auth()->id())->where('slug', $slug)->firstOrFail();
        if ($article) {

            Storage::delete($article->img);
            $article->tags()->detach();
            $article->delete();
            return redirect()->back()->with('msg', '<div class="msg rounded">
            <span class="mx-3" >Berhasil menghapus artikel</span>
          </div>');
        } else {
            return redirect()->back()->with('msg', '<div class="msg rounded">
            <span class="mx-3" >Gagal menghapus Artikel, Silahkan cobalagi</span>
          </div>');
        }
    }
}
