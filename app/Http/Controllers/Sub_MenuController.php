<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Sub_menu;
use Illuminate\Http\Request;
use Cviebrock\EloquentSluggable\Services\SlugService;

class Sub_MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.konfigurasi.sub_menu.index', [
            "title" => "Sub Menu",
            "form" => "Sub Menu",
            "program" => Sub_Menu::with('menu')->oldest()->get(),
            "url" => "konfigurasi/sub_menu",
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
        return view('admin.konfigurasi.sub_menu.create', [
            'title' => 'Tambah Sub Menu',
            'form' => 'Sub Menu',
            "program_menu" => Menu::all(),
            "url" => "konfigurasi/sub_menu",
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
            'menu_id' => 'required',
            'nama' => 'required|max:255|unique:sub_menus',
            'slug' => 'required|unique:sub_menus',
            'url' => 'required',
        ]);

        Sub_menu::create($validateData);
        return redirect('/konfigurasi/sub_menu')->with('success', 'Data Sukses Di Inputkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sub_menu  $sub_menu
     * @return \Illuminate\Http\Response
     */
    public function show(Sub_menu $sub_menu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sub_menu  $sub_menu
     * @return \Illuminate\Http\Response
     */
    public function edit(Sub_menu $sub_menu)
    {
        return view('admin.konfigurasi.sub_menu.edit', [
            "title" => "Edit Sub Menu",
            'form' => 'Sub Menu',
            "program" => $sub_menu,
            "program_menu" => Menu::all(),
            "url" => "konfigurasi/sub_menu",
            "breadcrumb" => "Konfigurasi"
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sub_menu  $sub_menu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sub_menu $sub_menu)
    {
        $rules = [
            'menu_id' => 'required|max:255',
            'url' => 'required|max:255',
        ];
        if ($request->nama != $sub_menu->nama) {
            $rules['nama'] = 'required|unique:sub_menus';
        }
        if ($request->slug != $sub_menu->slug) {
            $rules['slug'] = 'required|unique:sub_menus';
        }
        $validateData = $request->validate($rules);

        Sub_menu::where('id', $sub_menu->id)
            ->update($validateData);
        return redirect('/konfigurasi/sub_menu')->with('success', 'Data Sukses Di Update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sub_menu  $sub_menu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sub_menu $sub_menu)
    {
        Sub_menu::destroy($sub_menu->id);
        return redirect('/konfigurasi/sub_menu')->with('success', 'Data sukses di hapus!');
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Sub_menu::class, 'slug', $request->nama);
        return response()->json(['slug' => $slug]);
    }
}
