<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function createAbort()
    {
        return abort(404);
    }

    public function store(Request $request, $article_slug)
    {
        $article = Article::where('slug', $article_slug)->get('id')->first();

        $attr = $request->validate([
            'text'  => 'required',
        ]);
        $attr['article_id'] = $article->id;

        $comment = auth()->user()->comments()->create($attr);
        return redirect()->back()->with('msg', '    <div class="msg rounded">
        <span class="mx-3" >Komentar berhasil disubmit <b><a class="bt btn-sm btn-light" href="#bottom-comment">Lihat</a></b> </span>
      </div>');
    }
}
