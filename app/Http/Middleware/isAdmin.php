<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use App\Models\Sub_menu;
use App\Models\Access_menu;
use Illuminate\Http\Request;

class isAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->guest()) {
            return redirect('/login');
        }
        $url_sub_menu = request()->segment(2);
        $email = auth()->user()->email;
        $user =  User::where('email', $email)->first();
        $role_id = $user->role_id;

        $submenu = Sub_menu::where('slug',  $url_sub_menu)->first();
        $submenu_id = $submenu->id;
        $userAccess = Access_menu::where('role_id', $role_id)->where('sub_menu_id', $submenu_id)->count();

        if ($userAccess < 1) {
            abort(403);
        }

        return $next($request);
    }
}
