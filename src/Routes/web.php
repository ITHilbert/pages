<?php

use ITHilbert\Pages\Controllers\PagesController;
use Illuminate\Support\Facades\Route;
use ITHilbert\Pages\Controllers\SitemapController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*########################################
# Manage Pages
########################################*/
Route::middleware(config('pages.route_manage_pages_middleware'))
    ->prefix(config('pages.route_manage_pages_prefix'))
    ->group(function () {

    Route::any( '/',                [PagesController::class, 'index'])->name('pages');
    Route::get( 'create',           [PagesController::class, 'create'])->name('pages.create');
    Route::post( 'create/store',    [PagesController::class, 'store'])->name('pages.store');
    Route::get( 'edit/{id}',        [PagesController::class, 'edit'])->name('pages.edit');
    Route::post('edit/{id}/update', [PagesController::class, 'update'])->name('pages.update');
    Route::post('delete/{id}',      [PagesController::class, 'delete'])->name('pages.delete');
});


/*########################################
# Sitemaps
########################################*/
Route::prefix('sitemap')
    ->group(function () {

    Route::get('/',          [SitemapController::class, 'sitemap'])->name('sitemap.all');
    Route::any('{category}', [SitemapController::class, 'sitemap'])->name('sitemap.category');

});


/*########################################
# Show Page
########################################*/
/* //Wird erst aufgerufen, wenn keine andere Route gefunden wurde
$show_pages_prefix = config('pages.route_show_pages_prefix');
Route::middleware(config('pages.route_show_pages_middleware'))
    ->group(function () use ($show_pages_prefix) {

        // Andere Routen hier definieren

        Route::fallback(function () use ($show_pages_prefix) {
            if ($show_pages_prefix != '' && $show_pages_prefix != '/') {
                Route::prefix($show_pages_prefix)->group(function () {
                    Route::get('{url}', [PagesController::class, 'show'])->name('page.show');
                });
            } else {
                Route::get('{url}', [PagesController::class, 'show'])->name('page.show');
            }
        });
    }); */
