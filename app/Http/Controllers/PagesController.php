<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Playlist;
use App\Models\User;
use App\Models\Video;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index()
    {
        $search = htmlspecialchars(request()->search);
        $type = htmlspecialchars(request()->type);

        if ($search) {
            if ($type == 'article') {
                return redirect('/blog?search=' . $search);
            } else {
                return redirect('/video?search=' . $search);
            }
        } else {

            $videos = Video::inRandomOrder()->limit(3)->get();
            $articles = Article::Latest()->paginate(6);
        }

        return view('home.index', ['articles' => $articles, 'videos' => $videos]);
    }
    public function playlist()
    {

        $playlists = Playlist::Latest()->paginate(6);

        return view('home.playlist', compact('playlists'));
    }
    public function blog()
    {
        $articles = Article::Latest()->paginate(6);

        return view('home.blog', ['articles' => $articles]);
    }
    public function about()
    {
        $videos = Video::inRandomOrder()->limit(3)->get();
        return view('home.about', compact('videos'));
    }
    public function contact()
    {
        return view('home.contact');
    }
    public function video()
    {
        $search = htmlspecialchars(request()->search);
        $type = htmlspecialchars(request()->type);

        if ($search) {
            if ($type == 'video') {
                $videos = Video::where('title', 'like', '%' . $search . '%')->inRandomOrder()->limit(3)->paginate(6);
                $playlists = [];
            } else {
                // playlist
                $playlists = Playlist::where('title', 'like', '%' . $search . '%')->inRandomOrder()->limit(3)->get();
                $videos = Video::inRandomOrder()->limit(3)->paginate(3);
            }
        } else {

            $videos = Video::inRandomOrder()->limit(3)->paginate(6);
            $playlists = Playlist::inRandomOrder()->limit(3)->get();
        }

        return view('home.video', compact('videos', 'playlists'));
    }
}
