@extends(config('pages.layout'))

@section('content')
    <card-main>
        <card-main-header>
            <h1>Seite bearbeiten</h1>
            @include('components.breadcrumb')
        </card-main-header>
        <card-body>
            @include('include.message')
            <div>
                <hform action="{{ $formroute }}">
                    {{-- Seiten Tittel --}}
                    <div class="form-group row mb-2">
                        <label for="title" class="col-md-1 col-form-label text-md-right">Titel</label>
                        <div class="col-md-6">
                            <input-text name="title" value="{{ old('title', $page->title) }}" @error('title') class="is-invalid" @enderror required />
                        </div>
                    </div>


                    {{-- URL --}}
                    <div class="form-group row mb-2">
                        <label for="url" class="col-md-1 col-form-label text-md-right">URL</label>
                        <div class="col-md-6">
                            <input-text name="url" value="{{ old('url', $page->url) }}" @error('url') class="is-invalid" @enderror required />
                        </div>
                    </div>

                    <div class="form-group row mb-2">
                        {{-- Kategory --}}
                        <label for="category" class="col-md-1 col-form-label text-md-right">Kategory</label>
                        <div class="col-md-1">
                            <vue-select name="category" value="{{ old('category', $page->category) }}" @error('category') class="is-invalid" @enderror>
                                @foreach (config('pages.categories') as $category)
                                    <vue-select-item value="{{$category}}">{{$category }}</vue-select-item>
                                @endforeach
                            </vue-select>
                        </div>
                        {{-- Gruppe --}}
                        <label for="group" class="col-md-1 col-form-label text-md-right">Gruppe</label>
                        <div class="col-md-1">
                            <vue-select name="group" value="{{ old('group', $page->group) }}" @error('group') class="is-invalid" @enderror>
                                @foreach (config('pages.groups') as $group)
                                    <vue-select-item value="{{$group}}">{{$group }}</vue-select-item>
                                @endforeach
                            </vue-select>
                        </div>
                        {{-- View Layout --}}
                        <label for="group" class="col-md-1 col-form-label text-md-right">View Layout</label>
                        <div class="col-md-2">
                            <vue-select name="layout_view" value="{{ old('layout_view', $page->layout_view) }}" @error('layout_view') class="is-invalid" @enderror>
                                @foreach (config('pages.layouts') as $layout)
                                    <vue-select-item value="{{$layout}}">{{$layout }}</vue-select-item>
                                @endforeach
                            </vue-select>
                        </div>
                        {{-- View Layout --}}
                        <label for="robots" class="col-md-1 col-form-label text-md-right">Robots</label>
                        <div class="col-md-2">
                            <vue-select name="robots" value="{{ old('robots', $page->robots) }}" @error('robots') class="is-invalid" @enderror>
                                @foreach (config('pages.robots') as $robo)
                                    <vue-select-item value="{{$robo}}">{{$robo }}</vue-select-item>
                                @endforeach
                            </vue-select>
                        </div>
                    </div>

                    {{-- Content --}}
                    <div class="form-group row mb-2">
                        <div class="col-md-12">
                            <strong>Content</strong><br>
                            <html-editor name="content" value="{{ old('content', $page->content) }}" :rows="30" @error('content') class="is-invalid" @enderror></html-editor>
                        </div>
                    </div>

                    <accordion>
                        <accordion-item>
                            <accordion-header name="sitemap">Sitemap</accordion-header>
                            <accordion-body name="sitemap">
                                {{-- Show on Sitemap --}}
                                <div class="form-group row mb-2">
                                    <div class="col-md-12">
                                        <checkbox name="sitemap_show" value="{{ old('sitemap_show', $page->sitemap_show) }}" @error('pages.sitemap_show') class="is-invalid" @enderror>In der Sitemap.xml anzeigen?</checkbox>
                                    </div>
                                </div>

                                {{-- Sitemap priority --}}
                                <div class="form-group row mb-2">
                                    <label for="sitemap_priority" class="col-md-4 col-form-label text-md-right">Sitemap Priority</label>
                                    <div class="col-md-6">
                                        <input-number name="sitemap_priority" value="{{ old('sitemap_priority', $page->sitemap_priority) }}" max="1.00" @error('sitemap_priority') class="is-invalid" @enderror required />
                                    </div>
                                </div>

                                {{-- sitemap_changefreq	 --}}
                                <div class="form-group row mb-2">
                                    <label for="sitemap_changefreq" class="col-md-4 col-form-label text-md-right">Sitemap changefreq</label>
                                    <div class="col-md-6">
                                        <vue-select name="sitemap_changefreq" value="{{ old('sitemap_changefreq', $page->sitemap_changefreq) }}" @error('sitemap_changefreq') class="is-invalid" @enderror>
                                            @foreach (config('pages.sitemap_changefreqs') as $freq)
                                                <vue-select-item value="{{$freq}}">{{$freq }}</vue-select-item>
                                            @endforeach
                                        </vue-select>
                                    </div>
                                </div>
                            </accordion-body>
                        </accordion-item>

                        <accordion-item>
                            <accordion-header name="meta">Meta</accordion-header>
                            <accordion-body name="meta">

                                {{-- Meta Titel --}}
                                <div class="form-group row mb-2">
                                    <label for="meta_title" class="col-md-4 col-form-label text-md-right">Meta Titel</label>
                                    <div class="col-md-6">
                                        <input-text name="meta_title" value="{{ old('meta_title', $page->meta_title) }}" @error('meta_title') class="is-invalid" @enderror />
                                    </div>
                                </div>

                                {{-- meta_discription --}}
                                <div class="form-group row mb-2">
                                    <label for="meta_discription" class="col-md-4 col-form-label text-md-right">Meta Discription</label>
                                    <div class="col-md-6">
                                        <input-text name="meta_discription" value="{{ old('meta_discription', $page->meta_discription) }}" @error('meta_discription') class="is-invalid" @enderror />
                                    </div>
                                </div>

                                {{-- meta_keywords --}}
                                <div class="form-group row mb-2">
                                    <label for="meta_keywords" class="col-md-4 col-form-label text-md-right">Meta Keywords</label>
                                    <div class="col-md-6">
                                        <input-text name="meta_keywords" value="{{ old('meta_keywords', $page->meta_keywords) }}" @error('meta_keywords') class="is-invalid" @enderror/>
                                    </div>
                                </div>
                            </accordion-body>
                        </accordion-item>
                    </accordion>
                    <row class="pt-3">
                        <col-6>
                            <button-back route="{{ route('pages')}}">Zurück</button-back>
                        </col-6>
                        <col-6 align="right">
                            <button-submit>Speichern</button>
                        </col-6>
                    </row>
                </hform>

            </div>

        </card-body>
    </card-main>
@stop


@section('js')
<script>
function slugify(text) {
    return text
        .toString()
        .toLowerCase()
        .replace(/\s+/g, '-')     // Leerzeichen durch Bindestriche ersetzen
        //.replace(/[^\w-]+/g, '')  // Sonderzeichen entfernen
        .replace(/[^\w\s-äöüß]/g, '')  // Sonderzeichen entfernen, außer Bindestriche und Umlaute
        .replace(/--+/g, '-')     // Doppelte Bindestriche entfernen
        .replace(/^-+/, '')       // Bindestriche am Anfang entfernen
        .replace(/-+$/, '');      // Bindestriche am Ende entfernen
        /* .replace(/[ä]/g, 'ae')    // ä durch ae ersetzen
        .replace(/[ö]/g, 'oe')    // ö durch oe ersetzen
        .replace(/[ü]/g, 'ue')    // ü durch ue ersetzen
        .replace(/[ß]/g, 'ss');   // ß durch ss ersetzen */
    }

    // Element auswählen, das das Titel-Feld repräsentiert
    const titleField = document.getElementById('title');

    // Eventlistener hinzufügen, um die updated-Funktion aufzurufen, wenn sich der Inhalt des Titel-Feldes ändert
    titleField.addEventListener('input', function() {
        // Aktualisiere die Werte der DOM-Elemente
        document.getElementById('url').value = slugify(titleField.value);
        document.getElementById('meta_title').value = titleField.value;
        document.getElementById('meta_keywords').value = titleField.value;
    });
</script>
@stop
