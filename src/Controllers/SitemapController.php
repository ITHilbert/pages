<?php

namespace ITHilbert\Pages\Controllers;

use App\Http\Controllers\Controller;
use ITHilbert\Pages\Models\Page;

class SitemapController extends Controller
{
    public function sitemap($category = 'all'){
        if($category == 'all'){
            $pages = Page::where('sitemap_show', true)->select('url', 'sitemap_priority', 'sitemap_changefreq')->orderBy('title', 'ASC')->get();
        }else{
            $pages = Page::where('sitemap_show', true)->where('category', $category)->orderBy('sitemap_priority','DESC')->select('url', 'sitemap_priority', 'sitemap_changefreq')->orderBy('title', 'ASC')->get();
        }

        return response()->view('pages::sitemap', compact('pages'))
          ->header('Content-Type', 'text/xml');
    }
}
