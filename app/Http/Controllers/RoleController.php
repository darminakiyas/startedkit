<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Cviebrock\EloquentSluggable\Services\SlugService;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.konfigurasi.role.index', [
            "title" => "Role",
            "form" => "Role",
            "program" => Role::all(),
            "url" => "konfigurasi/role",
            "url_hak_akses" => "konfigurasi/role/access_menu",
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
        return view('admin.konfigurasi.role.create', [
            'title' => 'Tambah Role',
            'form' => 'Role',
            "url" => "konfigurasi/role",
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
        $validateData = $request->validate([
            'nama' => 'required|max:255',
            'slug' => 'required|unique:roles',
        ]);

        Role::create($validateData);
        return redirect('/konfigurasi/role')->with('success', 'Data Sukses Di Inputkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        return view('admin.konfigurasi.role.edit', [
            "title" => "Edit Role",
            'form' => 'Role',
            "program" => $role,
            "url" => "konfigurasi/role",
            "breadcrumb" => "Konfigurasi"
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $rules = [
            'nama' => 'required|max:255',
        ];
        if ($request->slug != $role->slug) {
            $rules['slug'] = 'required|unique:roles';
        }
        $validateData = $request->validate($rules);
        Role::where('id', $role->id)
            ->update($validateData);

        return redirect('/konfigurasi/role')->with('success', 'Data Sukses Di Update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        Role::destroy($role->id);
        return redirect('/konfigurasi/role')->with('success', 'Data sukses di hapus!');
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Role::class, 'slug', $request->nama);
        return response()->json(['slug' => $slug]);
    }
}
