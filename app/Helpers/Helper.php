<?php

use App\Models\Access_menu;
use App\Models\Menu;
use App\Models\Sub_menu;

function check_access($role_id, $sub_menu_id)
{
    $result = Access_menu::where('role_id', $role_id)
        ->where('sub_menu_id', $sub_menu_id)->count();

    if ($result > 0) {
        return "checked";
    }
}

function menu()
{
    $menu = Menu::all();
    return  $menu;
}

function sub_menu()
{
    $sub_menu = Sub_menu::all();
    return $sub_menu;
}

function menu_access($role_id, $menu_id)
{
    $result = Access_menu::where('role_id', $role_id)
        ->where('menu_id', $menu_id)->count();
    if ($result <= 0) {
        return "hidden";
    }
}
function sub_menu_access($role_id, $sub_menu_id)
{
    $result = Access_menu::where('role_id', $role_id)
        ->where('sub_menu_id', $sub_menu_id)
        ->count();

    if ($result <= 0) {
        return "hidden";
    }
}
