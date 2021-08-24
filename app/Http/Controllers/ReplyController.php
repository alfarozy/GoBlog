<?php

namespace App\Http\Controllers;

use App\Models\Reply;
use Illuminate\Http\Request;

class ReplyController extends Controller
{
    //
    public function store(Request $request)
    {
        $attr = $request->validate([
            'text'  => 'required',
            'comment_id' => 'required',
        ]);
        // dd($attr);
        $comment = auth()->user()->replies()->create($attr);

        return redirect()->back()->with('msg', '<div class="msg rounded">
        <span class="mx-3" >Komentar berhasil disubmit <b><a class="bt btn-sm btn-light" href="#bottom-comment">Lihat</a></b> </span>
      </div>');
    }
}
