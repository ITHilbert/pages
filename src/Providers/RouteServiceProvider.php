<?php

namespace ITHilbert\Pages\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Route::fallback(function () {
            $url = request()->getPathInfo();
            $url = ltrim($url, '/'); //Führendes / entfernen

            //Wenn Präfix vorhanden ist, aus route entfernen
            $prefix = config('pages.route_show_pages_prefix') ."/";
            if($prefix != '' && $prefix != '/'){
                $url = str_replace($prefix, "", $url);
            }
            $url = urldecode($url); // URL decodieren
            $page = \ITHilbert\Pages\Models\Page::where('url', $url)->first();

            if (!$page) {
                abort(404); // Seite nicht gefunden, wirft einen 404-Fehler
            }

            $breadcrumb = new \ITHilbert\LaravelKit\Helpers\Breadcrumb();
            $breadcrumb->add($page->title);

            return view('pages::show')->with(compact('breadcrumb', 'page'));
        });
    }
}
