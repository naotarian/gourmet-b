<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Route;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */


    // protected function unauthenticated($request, array $guards)
    // {
    //     \Log::info('kkk');
    //     return redirect()->route('adminLogin');
    //     throw new AuthenticationException(
    //         'Unauthenticated.', $guards, $this->redirectTo($request, $guards) // $guardsを第二引数に追加
    //     );
    // }
    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {
            // if ($request->is('admin/*')) return redirect('/');
            return route('login');
            return redirect('/');
        }
    }
}
