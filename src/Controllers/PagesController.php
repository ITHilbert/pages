<?php

namespace ITHilbert\Pages\Controllers;

use App\Helpers\Breadcrumb;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use ITHilbert\Pages\Models\Page;
use ITHilbert\LaravelKit\Helpers\HButton;
use Yajra\DataTables\Facades\DataTables;

class PagesController extends Controller
{

    public function show($url){
        //dd($url);
        $page = Page::where('url', $url)->first();

        $breadcrumb = new Breadcrumb();
        $breadcrumb->add($page->title);

        return view('pages::show')->with(compact('breadcrumb', 'page'));
    }

    public function index(Request $request){
        $data = Page::latest()->get();

        if ($request->ajax()) {
            return Datatables::of($data)
                ->addColumn('action', function ($row) { //use ($user) {
                    $ausgabe = '<div style="white-space: nowrap;">';
                    //$ausgabe .= HButton::show(route('permission.show', $row->id), '');
                    //if($user->hasPermission('user_edit')){
                        $ausgabe .= HButton::edit(route('pages.edit', $row->id), '');
                    //}
                    //if($user->hasPermission('user_delete')){
                        $ausgabe .= HButton::delete($row->id, '');
                    //}
                    $ausgabe .= '</div>';

                    return $ausgabe;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        $breadcrumb = new Breadcrumb();
        $breadcrumb->add('Seiten');

        return view('pages::index')->with(compact('breadcrumb'));
    }



    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $breadcrumb = new Breadcrumb();
        $breadcrumb->add('Seiten', route('pages'));
        $breadcrumb->add('Neue Seite erstellen');

        //Neue Page erstellen und mit Standarwertem vorbelegen
        $page = new Page();
        $page->category = config('pages.default_category');
        $page->group = config('pages.default_group');
        $page->layout_view = config('pages.default_layout');
        $page->robots = config('pages.default_robots');

        $page->sitemap_show = config('pages.sitemap_default_show');
        $page->sitemap_priority = config('pages.sitemap_default_priority');
        $page->sitemap_changefreq = config('pages.sitemap_default_changefreq');

        $formroute = route('pages.store');

        return view('pages::page_edit')->with(compact('breadcrumb', 'page', 'formroute'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'url' => 'required|string|max:255|unique:pages',
            'category' => 'required|string|max:20',
            'group' => 'required|string|max:20',
            'layout_view' => 'required|string|max:255',
            'robots' => 'required|string|max:50',
            'content' => '',
            'sitemap_show' => 'boolean',
            'sitemap_priority' => 'numeric|max:1',
            'sitemap_changefreq' => 'required|string|max:20',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:255',
            'meta_keywords' => 'nullable|string|max:255',
        ]);

        $page = Page::create($validatedData);

        // Weitere Logik für die Erstellung der Seite

        return redirect()->route('pages')
            ->with('success', 'Seite erfolgreich erstellt.');
    }



    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $page = page::find($id);

        $breadcrumb = new Breadcrumb();
        $breadcrumb->add('Seiten', route('pages'));
        $breadcrumb->add('Seite bearbeiten');

        $formroute = route('pages.update', $id);

        return view('pages::page_edit')->with(compact('page', 'breadcrumb', 'formroute'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'url' => 'required|string|max:255|unique:pages,url,' . $id,
            'category' => 'required|string|max:20',
            'group' => 'required|string|max:20',
            'layout_view' => 'required|string|max:255',
            'robots' => 'required|string|max:50',
            'content' => '',
            'sitemap_show' => 'boolean',
            'sitemap_priority' => 'numeric|max:1',
            'sitemap_changefreq' => 'required|string|max:20',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:255',
            'meta_keywords' => 'nullable|string|max:255',
        ]);


        $page = Page::findOrFail($id);
        $page->update($validatedData);

        // Weitere Logik für die Aktualisierung der Seite

        return redirect()->route('pages')
            ->with('success', 'Seite erfolgreich aktualisiert.');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function delete($id)
    {
        $page = Page::find($id);
        $page->delete();

        return redirect()->route('pages.index')->with([
            'message'    => 'Die Seite wurde erfolgreich gelöscht',
            'alert-type' => 'success',
        ]);
    }
}
