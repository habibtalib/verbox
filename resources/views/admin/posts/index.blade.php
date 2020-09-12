@extends('varbox::layouts.default')

@section('title', $title)

@section('content')
<div class="row row-cards">
    <div class="col-lg-3">
        @include('admin.posts._filter')
        <div class="card">
            <div class="card-body">
                @permission('posts-add')
                @include('varbox::buttons.add', ['url' => route('admin.posts.create')])
                @endpermission
            </div>
        </div>
    </div>
    <div class="col-lg-9">
        @include('admin.posts._table')

        @if(count(request()->all()))
        {!! $items->links('varbox::pagination', request()->query()) !!}
        @endif
    </div>
</div>
@endsection