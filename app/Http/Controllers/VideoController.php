<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Playlist;
use App\Models\Tag;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller
{
    public function index()
    {
        $videos = Video::where('user_id', auth()->id())->latest()->paginate(15);
        return view('dashboard.video.index', compact('videos'));
    }

    public function create()
    {
        $categories = Category::get();
        return view('dashboard.video.create', compact('categories'));
    }
    public function store(Request $request)
    {
        $attr = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'code_video' => 'required|min:4',
            'img'   =>  'required|image|mimes:png,jpg,jpeg',
            'tags' => 'required'
        ]);
        $tags = mb_split(',', $request->tags); //return ['tags1','tags2', ...] 

        $tagsId = [];
        // cek tags dan insert into database
        foreach ($tags as $tag) {
            $tagSlug = str_replace(' ', '', $tag); //remove spasi di tag
            $cekTags = Tag::where('slug', $tagSlug)->where('status', 1)->first();
            if (!$cekTags) {
                $data['name']   = $tagSlug;
                $data['user_id'] = auth()->user()->id;
                $data['slug'] = $tagSlug;
                $data['status'] = 1; // 1 untuk video 0 untuk artikel
                Tag::create($data);
            }
            $dataTagsId = Tag::where('slug', $tagSlug)->where('status', 1)->select('id')->first();
            $tagsId[] .= $dataTagsId->id;
        }

        $attr['slug'] = \Str::slug($request->title) . '-' . \Str::random(4); //kasih random string biar nga bentrok kalo ada judulnya yang sama
        $file = $request->file('img');
        $img = $file->store('images/videos');

        $attr['img'] =   $img;
        $video = auth()->user()->videos()->create($attr);
        $video->tags()->attach($tagsId);
        return redirect()->route('videos.index')->with('msg', '<div class="msg rounded">
        <span class="mx-3" >Video Berhasil diUpload</span>
      </div>');
    }
    public function show($slug)
    {
        $video = Video::where('slug', $slug)->firstOrFail();
        $views = $video->views + 1;
        $video->update(['views' => $views]);
        $videoRandom = Video::inRandomOrder()->take(2)->get();
        return view('dashboard.video.show', compact('video', 'views', 'videoRandom'));
    }
    public function destroy($slug)
    {
        $video = Video::where('slug', $slug)->firstOrFail();
        $video->tags()->detach();
        Storage::delete($video->img);
        $video->delete();
        return redirect()->route('videos.index')->with('msg', '<div class="msg rounded">
        <span class="mx-3" >Video Berhasil dihapus/span>
      </div>');
    }

    public function showVideoPlaylist($slug, $playlist)
    {
        $video = Video::where('slug', $slug)->firstOrFail();
        $views = $video->views + 1;
        $video->update(['views' => $views]);
        $videoRandom = Video::inRandomOrder()->take(2)->get();
        $playlist = Playlist::where('slug', $playlist)->first();
        if (!$playlist) {
            return redirect()->route('videos.show', $slug);
        }
        return view('dashboard.video.showVideoPlaylist', compact('video', 'views', 'videoRandom', 'playlist'));
    }
    public function edit($slug)
    {
        $video = Video::where('slug', $slug)->firstOrFail();
        return view('dashboard.video.edit', compact('video'));
    }

    public function update(Request $request, $slug)
    {
        $video = Video::where('slug', $slug)->first();
        $attr = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'code_video' => 'required|min:4',
            'img'   =>  'image|mimes:png,jpg,jpeg',
        ]);
        $tags = mb_split(',', $request->tags); //return ['tags1','tags2', ...] 
        $tagsId = [];
        if (!$tags) {
            foreach ($video->tags as $index => $tag) {
                $tagsId .= $tag->id;
            }
        } else {
            $video->tags()->detach();

            // cek tags dan insert into database
            foreach ($tags as $tag) {
                $tagSlug = str_replace(' ', '', $tag); //remove spasi di tag
                $cekTags = Tag::where('slug', $tagSlug)->where('status', 1)->first();
                if (!$cekTags) {
                    $data['name']   = $tagSlug;
                    $data['user_id'] = auth()->user()->id;
                    $data['slug'] = $tagSlug;
                    $data['status'] = 1; // 1 untuk video 0 untuk artikel
                    Tag::create($data);
                }
                $dataTagsId = Tag::where('slug', $tagSlug)->where('status', 1)->select('id')->first();
                $tagsId[] .= $dataTagsId->id;
            }
        }

        $file = $request->file('img');
        if ($file) {
            Storage::delete($video->img);
            $img = $file->store('images/videos');
        } else {
            $img = $video->img;
        }

        $attr['img'] =   $img;
        $video->tags()->attach($tagsId);
        $video = auth()->user()->videos()->update($attr);
        return redirect()->route('videos.index')->with('msg', '<div class="msg rounded">
        <span class="mx-3" >Video Berhasil diUpload</span>
      </div>');
    }
}
