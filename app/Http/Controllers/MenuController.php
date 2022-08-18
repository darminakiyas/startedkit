<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Cviebrock\EloquentSluggable\Services\SlugService;


class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.konfigurasi.menu.index', [
            "title" => "Menu",
            "form" => "Menu",
            "program" => Menu::all(),
            "url" => "konfigurasi/menu",
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
        return view('admin.konfigurasi.menu.create', [
            'title' => 'Tambah Menu',
            'form' => 'Menu',
            "url" => "konfigurasi/menu",
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
            'slug' => 'required|unique:menus',
            'icon' => 'required|max:255'
        ]);

        Menu::create($validateData);
        return redirect('/konfigurasi/menu')->with('success', 'Data Sukses Di Inputkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function show(Menu $menu)
    {
        abort(404);
        //return $menu;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menu)
    {
        return view('admin.konfigurasi.menu.edit', [
            "title" => "Edit Menu",
            'form' => 'Menu',
            "program" => $menu,
            "url" => "konfigurasi/menu",
            "breadcrumb" => "Konfigurasi"
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Menu $menu)
    {
        $rules = [
            'nama' => 'required|max:255',
            'icon' => 'required|max:255',
        ];
        if ($request->slug != $menu->slug) {
            $rules['slug'] = 'required|unique:menus';
        }
        $validateData = $request->validate($rules);
        Menu::where('id', $menu->id)
            ->update($validateData);

        return redirect('/konfigurasi/menu')->with('success', 'Data Sukses Di Update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu)
    {
        Menu::destroy($menu->id);
        return redirect('/konfigurasi/menu')->with('success', 'Data sukses di hapus!');
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Menu::class, 'slug', $request->nama);
        return response()->json(['slug' => $slug]);
    }
}
