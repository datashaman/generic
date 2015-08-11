@extends('layout')

@section('content')
<div class="page-header">
    <h1>Things</h1>
</div>

<div data-index="generic" data-type="thing">
    <div data-id="category" data-definition='{"terms":{"field":"category.id"}}' data-type="category"></div>
</div>

<table data-index="generic" data-type="thing" class="table table-striped table-bordered" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th data-data="title">Title</th>
            <th data-data="description">Description</th>
        </tr>
    </thead>
</table>
@stop

@section('scripts')
<script src="/scripts/things.js"></script>
@stop
