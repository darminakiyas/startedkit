<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Cviebrock\EloquentSluggable\Services\SlugService;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('admin.konfigurasi.user.index', [
            'title' => 'User',
            'form' => 'User',
            'program' => User::with('role')->oldest()->get(),
            "url" => "konfigurasi/user",
            "breadcrumb" => "Konfigurasi"
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.konfigurasi.user.create', [
            'title' => 'Tambah User',
            'form' => 'User',
            'program' => Role::oldest()->get(),
            "url" => "konfigurasi/user",
            "breadcrumb" => "Konfigurasi"
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request;
        $validateData = $request->validate([
            'nama' => 'required|max:255|unique:users',
            'slug' => 'required|unique:users',
            'email' => 'required|max:255|unique:users',
            'password' => 'required|max:255',
            'role_id' => 'required|max:255',
            'status_aktif' => 'required|max:255',
        ]);


        if ($request->file('image')) {
            $validateData['image'] = $request->file('image')->store('users-image');
        }

        $validateData['password'] = Hash::make($request->password);
        User::create($validateData);
        return redirect('/konfigurasi/user')->with('success', 'Data Sukses Di Inputkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('admin.konfigurasi.user.edit', [
            "title" => "Edit User",
            'form' => 'User',
            "program" => $user,
            'program_role' => Role::oldest()->get(),
            "url" => "konfigurasi/user",
            "breadcrumb" => "Konfigurasi"
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $rules = [
            'role_id' => 'required|max:255',
            'status_aktif' => 'required|max:255',
        ];
        if ($request->nama != $user->nama) {
            $rules['nama'] = 'required|unique:users';
        }

        if ($request->slug != $user->slug) {
            $rules['slug'] = 'required|unique:users';
        }

        if ($request->email != $user->email) {
            $rules['email'] = 'required|unique:users';
        }

        $validateData = $request->validate($rules);

        if ($request->file('image')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $validateData['image'] = $request->file('image')->store('users-image');
        }

        if ($request->password) {
            $validateData['password'] = Hash::make($request->password);
        }

        // $validateData['user_id'] = auth()->user()->id;


        User::where('id', $user->id)
            ->update($validateData);

        return redirect('/konfigurasi/user')->with('success', 'Data Sukses Di Update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if ($user->image) {
            Storage::delete($user->image);
        }

        User::destroy($user->id);
        return redirect('/konfigurasi/user')->with('success', 'Data sukses di hapus!');
    }

    public function user_update_status_sukses()
    {
        return redirect('/konfigurasi/user')->with('success', 'Data Sukses Di Update');
    }
    public function user_update_status_aktif(Request $request)
    {
        $id = $request;
        $user = User::find($id)->first();

        if ($user->status_aktif == 1) {
            User::where('id', $user->id)
                ->update(['status_aktif' => 0]);
        } else {
            User::where('id', $user->id)
                ->update(['status_aktif' => 1]);
        }
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(User::class, 'slug', $request->nama);
        return response()->json(['slug' => $slug]);
    }
}
