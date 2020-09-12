@include('varbox::validation')

@if($item->exists)
{!! form_admin()->model($item, ['url' => $url, 'method' => 'put', 'class' => 'frm row row-cards', 'files' => true]) !!}
@else
{!! form_admin()->open(['url' => $url, 'method' => 'post', 'class' => 'frm row row-cards', 'files' => true]) !!}
@endif
<div class="col-md-12">
    <div class="card">
        <div class="card-status bg-blue"></div>
        <div class="card-header">
            <h3 class="card-title">Basic Info</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    {!! form_admin()->text('title', 'Title', null, ['required']) !!}
                </div>
                <div class="col-md-12">
                    {!! form_admin()->select('user_id', 'User', ['' => 'Please select'] + $users->pluck('email',
                    'id')->toArray(), null, ['required']) !!}
                </div>
                <div class="col-md-12">
                    {!! form_admin()->text('subtitle', 'Subtitle') !!}
                </div>
                <div class="col-md-12">
                    {!! form_admin()->editor('description', 'Description') !!}
                </div>
                <div class="col-md-12">
                    {!! uploader()->field('image')->label('Image')->model($item)->types('image')->accept('jpg',
                    'png')->manager() !!}
                </div>
                <div class="col-md-12">
                    {!! uploader()->field('pdf')->label('Pdf')->model($item)->types('file')->accept('pdf')->manager()
                    !!}
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <div class="d-flex text-left">
                @include('varbox::buttons.cancel', ['url' => route('admin.posts.index')])

                @if($item->exists)
                @include('varbox::buttons.save_stay')
                @else
                @include('varbox::buttons.save_new')
                @include('varbox::buttons.save_continue', ['route' => 'admin.posts.edit'])
                @endif

                @include('varbox::buttons.save')
            </div>
        </div>
    </div>
</div>
{!! form_admin()->close() !!}