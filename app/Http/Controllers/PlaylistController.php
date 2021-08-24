<?php

namespace App\Http\Controllers;

use App\Models\Playlist;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PlaylistController extends Controller
{
    public function index()
    {
        $playlists = Playlist::where('user_id', auth()->id())->latest()->paginate(10);
        return view('dashboard.playlist.index', compact('playlists'));
    }
    public function create()
    {
        return view('dashboard.playlist.create');
    }

    public function store(Request $request)
    {
        $attr = $request->validate([
            'title'  => ['required']
        ]);
        $attr['slug'] = \Str::slug($request->title);
        $attr['user_id'] = auth()->id();

        Playlist::create($attr);

        return redirect()->route('playlists.index')->with('msg', '<div class="msg rounded">
            <span class="mx-3" >Berhasil membuat playlist</span>
          </div>');
    }
    public function edit($slug)
    {
        $playlist = Playlist::where('user_id', auth()->id())->where('slug', $slug)->firstOrFail();
        return view('dashboard.playlist.edit', compact('playlist'));
    }

    public function update(Request $request, $slug)
    {
        $playlist = Playlist::where('user_id', auth()->id())->where('slug', $slug)->firstOrFail();
        $attr = $request->validate([
            'title'  => ['required']
        ]);
        $attr['slug'] = \Str::slug($request->title);
        $playlist->update($attr);
        return redirect()->route('playlists.index')->with('msg', '<div class="msg rounded">
            <span class="mx-3" >Playlist berhasil diupdate</span>
          </div>');
    }

    public function show($slug)
    {

        $playlist = Playlist::where('user_id', auth()->id())->where('slug', $slug)->firstOrFail();
        $videos  = Video::where('user_id', auth()->id())->get();
        return view('dashboard.playlist.show', compact('playlist', 'videos'));
    }
    public function destroy(Request $request, $slug)
    {
        $playlist = Playlist::where('user_id', auth()->id())->where('slug', $slug)->firstOrFail();

        $playlist->delete();
        return redirect()->route('playlists.index')->with('msg', '<div class="msg rounded">
            <span class="mx-3" >Playlist berhasil dihapus</span>
          </div>');
    }

    public function addVideo(Request $request, $slug)
    {
        DB::beginTransaction();
        try {

            $playlist = Playlist::where('user_id', auth()->id())->where('slug', $slug)->firstOrFail();
            $playlist->videos()->attach($request->video_id);
            DB::commit();
            return redirect()->route('playlists.show', $slug)->with('msg', '<div class="msg rounded">
            <span class="mx-3" >Video berhasil ditambah ke playlist</span>
          </div>');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('playlists.show', $slug)->with('msg', '<div class="msg rounded">
            <span class="mx-3" >Terjadi kesalahan, salah satu video sudah tersedia diplaylist</span>
          </div>');
        }
    }

    public function removeVideo($videoId, $slug)
    {
        $playlist = Playlist::where('user_id', auth()->id())->where('slug', $slug)->firstOrFail();

        $playlist->videos()->detach($videoId);
        return redirect()->route('playlists.show', $slug)->with('msg', '<div class="msg rounded">
        <span class="mx-3" >Video Berhasil dihapus dari playlist</span>
      </div>');
    }
}
