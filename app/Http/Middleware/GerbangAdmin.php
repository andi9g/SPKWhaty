<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class GerbangAdmin
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
        $posisi = $request->session()->get('posisi');
        $login = $request->session()->get('login');

        if($posisi === 'admin' && $login === true ) {
            return $next($request);
        }else {
            return redirect('login')->with('toast_error', 'Silahkan login');
        }

    }
}
