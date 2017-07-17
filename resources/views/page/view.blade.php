<h1>{{$page->title}}</h1>

<dl>
    <dt>Created</dt>
    <dd>{{$page->created_at}}</dd>
    <dt>Updated</dt>
    <dd>{{$page->updated_at}}</dd>
    <dt>Type</dt>
    <dd>{{$page->page_type}}</dd>
    <dt>Published</dt>
    <dd>{{$page->published ? 'Yes' : 'No'}}</dd>
    <dt>Promoted</dt>
    <dd>{{$page->promoted ? 'Yes' : 'No'}}</dd>
    {{-- <dt>Created by</dt>
    <dd>{{$created_by->name}} ({{$created_by->id}})</dd>
    <dt>Updated by</dt>
    <dd></dd>
    <dd>{{$updated_by->name}} ({{$updated_by->id}})</dd>
    <dd></dd> --}}
</dl>
