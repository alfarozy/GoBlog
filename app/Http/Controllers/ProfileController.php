<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        // $articles = Article::with('category')->orderBy('id', 'DESC')->paginate(15);
        $user = User::where('id', auth()->user()->id)->first();
        return view('dashboard.profile', compact('user'));
    }
    public function edit()
    {
        $user = User::where('id', auth()->user()->id)->first();
        return view('dashboard.editProfile', compact('user'));
    }
    public function update(Request $request)
    {
        $attr = $request->validate([
            'name'  => 'required',
            'bio'  => 'required',
        ]);


        $user = Auth()->user();
        if (Hash::check($request->konfirm_password, $user->password)) {

            $img = $request->file('img');
            if ($request->hasFile('img')) {
                // hapus file di storage
                if ($user->img != 'images/users/user-goblog.png') {
                    Storage::delete($user->img);
                }

                $attr['img'] = $img->store('images/users');
            } else {
                $attr['img'] = $user->img;
            }
            $user->update($attr);
            return redirect()->route('profile')->with('msg', '<div class="msg rounded bg-success shadow">
            <span class="mx-3" ><i class="fas fa-check-circle" ></i> Profile Berhasil diupdate</span>
          </div>');
        } else {
            return redirect()->back()->with('msg', '<div class="msg rounded bg-danger shadow">
            <span class="mx-3" > <i class="fas fa-exclamation-triangle mr-2" ></i> Password salah</span>
          </div>');
        }
    }

    public function addSosialMedia(Request $request, $sosmed)
    {

        if ($sosmed == 'facebook') {

            User::where('id', Auth()->user()->id)->update(['fb' => $request->facebook]);
            return redirect()->back()->with('msg', '<div class="msg rounded bg-success shadow">
            <span class="mx-3" ><i class="fas fa-check-circle" ></i> Facebook Berhasil diupdate</span>
            </div>');
        } elseif ($sosmed == 'instagram') {

            User::where('id', Auth()->user()->id)->update(['ig' => $request->instagram]);
            return redirect()->back()->with('msg', '<div class="msg rounded bg-success shadow">
            <span class="mx-3" ><i class="fas fa-check-circle" ></i> Instagram Berhasil diupdate</span>
          </div>');
        } elseif ($sosmed == 'github') {

            User::where('id', Auth()->user()->id)->update(['git' => $request->github]);
            return redirect()->back()->with('msg', '<div class="msg rounded bg-success shadow">
            <span class="mx-3" ><i class="fas fa-check-circle" ></i> Github Berhasil diupdate</span>
          </div>');
        } else {
            return redirect()->back()->with('msg', '<div class="msg rounded bg-danger shadow">
            <span class="mx-3" > <i class="fas fa-exclamation-triangle mr-2" ></i> Terjadi kesalahan</span>
          </div>');
        }
    }

    public function show($email)
    {
        $user = User::where('email', $email)->first();

        return view('home.profile', compact('user'));
    }
}
