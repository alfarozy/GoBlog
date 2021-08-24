<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function store(Request $request)
    {
        $attr = $request->validate([
            'name'  => 'required',

        ]);
        $attr['user_id'] = 1;
        $attr['slug'] = \Str::slug($request->name);
        Tag::create($attr);
        return redirect('/article/create')->with('msg', '<div class="msg rounded">
        <span class="mx-3" >Berhasil Menambah Tag <b>' . $request->name . '</b></span>
      </div>');
    }
}
