@extends(config('pages.layout'))

@section('content')
<card-main>
    <card-main-header>
        <h1>Seiten</h1>
        @include('components.breadcrumb')
    </card-main-header>
    <card-body>
        @include('include.message')
        <table class="table table-bordered" id="pages-table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Titel</th>
                <th>Kategorie</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th width="160px">
                    <button-create route="{{ route('pages.create') }}">Neue Seite</button-create>
                </th>
            </tr>
            </thead>
        </table>
    </card-body>
</card-main>
@stop



@section('js')
<script>
    $(document).ready(function() {
        $('#pages-table').DataTable({
            processing: true,
            serverSide: true,
            language: { url: "{{ asset("DataTable_DE.json") }}" },
            ajax: "{{ route('pages') }}",
            columns: [
                { data: 'id', name: 'id' },
                { data: 'title', name: 'title' },
                { data: 'category', name: 'category' },
                { data: 'created_at', name: 'created_at' },
                { data: 'updated_at', name: 'updated_at' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ]
        });
    });
</script>
@stop
