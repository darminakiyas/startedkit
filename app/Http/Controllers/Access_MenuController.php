<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Role;
use App\Models\Access_menu;
use Illuminate\Http\Request;

class Access_MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($request)
    {
        $slug_role = $request;
        $role = Role::where('slug', $slug_role)->first();

        return view('admin.konfigurasi.role.access_menu.index', [
            "title" => "Access Menu",
            "form" => "Access Menu",
            "program_role" => $role,
            "program_menu" => Menu::with('sub_menu')->oldest()->get(),
            "url" => "konfigurasi/role",
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Access_menu  $access_menu
     * @return \Illuminate\Http\Response
     */
    public function show(Access_menu $access_menu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Access_menu  $access_menu
     * @return \Illuminate\Http\Response
     */
    public function edit(Access_menu $access_menu)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Access_menu  $access_menu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Access_menu $access_menu)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Access_menu  $access_menu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Access_menu $access_menu)
    {
        //
    }

    public function update_access_menu(Request $request)
    {
        // return $request;
        $result = Access_menu::where('role_id', $request->role_id)
            ->where('sub_menu_id', $request->sub_menu_id)->count();

        if ($result == 0) {
            Access_menu::create([
                'role_id' => $request->role_id,
                'sub_menu_id' => $request->sub_menu_id,
                'menu_id' => $request->menu_id
            ]);
        } else if ($result == 1) {
            Access_menu::where('role_id', $request->role_id)
                ->where('sub_menu_id', $request->sub_menu_id)
                ->delete();
        }
        // return $request;
    }
}
