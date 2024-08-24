<?php

namespace App\Http\Middleware;

use App\Models\Page;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class PreloadSessionData
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        //recuperer les infos sur la sessions et definir ce qui va rester en entete et en bas de page
        // $session = $request->session();
        $pages = [
            'headPages' =>  Page::where("isHead", "true")->get(),
            'footPages' => Page::where("isFoot", "true")->get()
        ];
        Session::put('pages', $pages);
        return $next($request);
    }
}
